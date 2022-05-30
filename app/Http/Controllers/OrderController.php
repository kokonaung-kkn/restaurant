<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $dishes = Dish::latest()->get();
        $tables = Table::all();

        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::where('status',4)->get();
        return view('order_form', compact('dishes','tables','orders','status'));
    }

    public function submit(Request $request){
        $data = array_filter($request->except('_token','table'));
        $orderID = rand();
        foreach($data as $key=>$value){
            if($value > 1){
                for($i = 0; $i < $value; $i++){
                    $this->saveOrder($orderID,$key,$request);
                }
            }else{
                $this->saveOrder($orderID,$key,$request);
            }
        }
        return redirect('/')->with('message','Order submitted.');
    }

    public function saveOrder($orderID,$key,$request){
        $order = new Order();
        $order->order_id = $orderID;
        $order->dish_id = $key;
        $order->table_id = $request->table;
        $order->status = config('res.order_status.new');

        $order->save();
    }

    public function serve(Order $order){
        $order->status = config('res.order_status.done');
        $order->save();
        return redirect('/')->with('message','Order is served');
    }
}
