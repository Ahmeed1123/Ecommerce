<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\itemRequest;
use App\uploadImgTrait;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use uploadImgTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(itemRequest $request)
    {


        $file_name = $this->saveImage($request->image_url, 'items');

        $request['user_id'] = auth()->id();



        $item = Item::create([
            'user_id' => $request['user_id'],
            'title' => $request['title'],
            'description' => $request['description'],
            'amount' => $request['amount'],
            'image_url' => $file_name,
        ]);

        if($item) {
            return response()->json([
                'status' => true,
                'msg' => 'Saved successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'msg' => 'Save failed, please try again',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
