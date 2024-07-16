<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Payment as ModelsPayment;
use Illuminate\Http\Request;
use Moyasar\Facades\Payment;
use Moyasar\Moyasar;

class pymentController extends Controller
{
    public function create(Request $request) {
        abort_if(!$request->has(['amount' , 'id']), 404);
        $amount = $request->integer('amount');
        $id = $request->integer('id');
        $title = $request->string('title');
        return view('site.payments.create', compact(['amount', 'title', 'id']));
    }

    public function procicing(Request $request) {
        $apiKey = 'sk_test_KJYTDdA7G6QBUGzF7kJoCRATQiWYXb6hHUjHrZyk';

        // تعيين مفتاح API
        Moyasar::setApiKey($apiKey);

        $paymentService = new \Moyasar\Providers\PaymentService();

        $payment = $paymentService->fetch($request->id);
        $itemId = $payment->metadata['item_id'];

        $item = Item::findOrFail($itemId);
        $payment_status = $payment->source->message;

        if($item) {
            $item_all = Item::select(
                'amount',
            )->where(['id' => $itemId])->first();
        } else {
            abort(404);
        }



        if( intval($request->amount) != ($payment->amount) && $payment->amount != ( intval($item_all->amount) * 100) ||
            $payment->currency !== 'SAR'||
            $payment->status!== 'paid' ||
            $payment_status !== "APPROVED" ) {
            return to_route('payment.index')->with('failed','The amount paid is not equal to the amount requested in the shopping cart');
        }
        // dd([$payment]);

        // dd([$request->all(), $payment]);
        $payment_create = ModelsPayment::create([
            'payment_id' => $payment->id,
            'item_id' => $itemId,
            'user_id' => auth()->id(),
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
            return to_route('payment.index' )->with('success','Payment completed successfully');

        }



    }

    public function index() {
        $payments = ModelsPayment::with(['item' => function($q) {
            $q->select('id', 'image_url'); // تحديد الحقول التي تريد استعادتها من العلاقة 'item'

        }])
        ->where('user_id', auth()->id())
        ->get();

        return view('site.payments.index', compact(['payments']));
    }

    public function show(ModelsPayment $id) {
        return view('site.payments.show', compact('payment'));
    }
}
