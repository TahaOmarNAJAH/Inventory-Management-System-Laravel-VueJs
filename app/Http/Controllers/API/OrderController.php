<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function allOrders(){
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function saveOrder(Request $request){
        $validateData = $request->validate([
            'customer_id' => 'required',
            'pay' => 'required | not_in:0 |numeric ',
            'due' => 'required',
            'pay_by' => 'required',
            'total' => 'required | not_in:0 |numeric ',
        ]);
        
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->total = $request->total;
        $order->pay = $request->pay;
        $order->pay_by = $request->pay_by;
        $order->due = $request->due;
        $order->date = Carbon::now()->toDateTimeString();
        $order->save();

    }
}
