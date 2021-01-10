<?php

namespace BoostNet\Http\Controllers\Admin;

use BoostNet\Models\Order;
use Illuminate\Http\Request;
use BoostNet\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('status', 'asc')->paginate(5);
        $statuses = Order::STATUSES;
        return view('admin.catalog.order.index', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \BoostNet\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $statuses = Order::STATUSES;
        return view('admin.catalog.order.show', compact('order', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BoostNet\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $statuses = Order::STATUSES;
        return view('admin.catalog.order.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BoostNet\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    /**
     * Обновляет заказ покупателя
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()
            ->route('admin.catalog.order.show', ['order' => $order->id])
            ->with('success', 'Заказ был успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BoostNet\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
