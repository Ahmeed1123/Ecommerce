<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Payment as ModelsPayment;
use App\Trait\ApiKeyMoyasar;
use Illuminate\Http\Request;
use Moyasar\Facades\Payment;
use Moyasar\Moyasar;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class paymentController  extends Controller
{
    use ApiKeyMoyasar;
    public function create(Request $request) {
        $request->validate([
            'amount' => 'required',
            'id' => 'required|exists:items,id',
            'title' => 'required',
        ]);

        $title = $request->string('title');

        $order = Order::create([
            'user_id' => auth()->id(),
            'item_id' => $request->integer('id'),
            'amount' =>  $request->integer('amount'),
            'status' => 'pending',
        ]);
        if($order) {

            return view('site.payments.create', compact(['order', 'title']));
        }
        return to_route('home')
        ->with('failed','Error, try again later.');

    }

    public function processPayment(Request $request) {
        // use trait to check api key
        $payment = $this->useApiKey($request->id);

        $orderId = $payment->metadata['order_id'];

        $order = Order::findOrFail($orderId);

        if( intval($request->amount) != $payment->amount && $payment->currency !== 'SAR') {
            return to_route('payment.index')->with('failed','The amount paid is not equal to the amount requested in the shopping cart');
        }
        if($order->status === 'paid') {
            return to_route('payment.index')->with('failed','The request has already been executed');
        }
        if($payment->status !== 'paid') {
            return to_route('payment.index')->with('failed','You have a problem with the card');
        }

        $payment_create = auth()->user()->payment()->create([
            'payment_id' => $payment->id,
            'status' => $payment->status,
            'amount' => $payment->amount / 100,
            'amount_format' => $payment->amountFormat,
            'fee' => $payment->fee,
            'fee_format' => $payment->feeFormat,
            'description' => $payment->description,
            'ip' => $payment->ip,
            'company' => $payment->source->company,
            'meta_data' => json_encode($payment->metadata),
            'created_at' => $payment->createdAt,
            'updated_at' => $payment->updatedAt,
        ]);

        if($payment_create) {
            $order_update = $order->update([
                'status' => 'paid',
                'payment_id' => $payment_create->id,
            ]);
            return to_route('payment.index' )->with('success','Payment completed successfully');
        }

        return to_route('payment.index')->with('failed','Error, try again later.');

    }

    public function index() {
        $orders = Order::with([
            'payment',
            'item' => function($q) {
                $q->select([
                    'id',
                    'image_url',
                ]);
            }
        ])
        ->where('user_id', auth()->id())
        ->get();

        return view('site.payments.index', compact(['orders']));
    }

    public function show(ModelsPayment $id) {
        return view('site.payments.show', compact('payment'));
    }
}
