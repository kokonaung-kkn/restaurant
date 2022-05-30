<?php

namespace App\Http\Controllers;

use App\Http\Requests\DishCreateRequest;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dishes = Dish::all();
        return view('kitchen.dish',compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('kitchen.dish_create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishCreateRequest $request)
    {
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->category_id = $request->category;

        $imageName = date('dmyhms') . '.' . request()->dishimage->getClientOriginalExtension();
        request()->dishimage->move(public_path('images'),$imageName);

        $dish->image = $imageName;
        $dish->save();
        return redirect('/dish')->with('success','New dish is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $categories = Category::all();
        return view('kitchen.dish_edit',compact('dish','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        request()->validate([
            'name' => 'required',
            'category' => 'required',
            'dishimage' => 'image'
        ]);

        $dish->name = $request->name;
        $dish->category_id = $request->category;

        if($request->dishimage){
            $imageName = date('dmyhms') . '.' . request()->dishimage->getClientOriginalExtension();
            request()->dishimage->move(public_path('images'),$imageName);
            $dish->image = $imageName;
        }

        $dish->save();
        return redirect('/dish')->with('info','Dish updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete($dish);
        return redirect('/dish')->with('delete','Dish has been deleted.');
    }

    public function order(){
        $rawstatus = config('res.order_status');
        $status = array_flip($rawstatus);
        $orders = Order::whereIn('status',[1,2])->get();
        return view('kitchen.order',compact('orders','status'));
    }

    public function approve(Order $order){
        $order->status = config('res.order_status.processing');
        $order->save();
        return redirect('/order')->with('info','Order is approved');
    }

    public function cancel(Order $order){
        $order->status = config('res.order_status.cancel');
        $order->save();
        return redirect('/order')->with('info','Order is rejected');
    }

    public function ready(Order $order){
        $order->status = config('res.order_status.ready');
        $order->save();
        return redirect('/order')->with('info','Order is ready');
    }

    public function done(Order $order){
        
    }
}
