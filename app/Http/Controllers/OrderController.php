<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response as InertiaResponse;

class OrderController extends Controller
{
    public function index(): InertiaResponse
    {
        $this->authorize('viewAny', Order::class);

        $orders = Order::with('product.media', 'user')
            ->orderBy('updated_at', 'desc')
            ->paginate(5);

        foreach ($orders as $order) {
            $order['total_price'] = $order->total_price;
        }

        return inertia()->render('Order/OrderIndex', [
            'orders' => $orders,
        ]);
    }

    public function create(): InertiaResponse
    {
        $this->authorize('create', Order::class);

        return inertia()->render('Orders/CreateOrder');
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $this->authorize('create', Order::class);

        $order = Order::create($request->validated());

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order created.');
    }

    public function show(Order $order): InertiaResponse
    {
        $this->authorize('view', $order);

        $order->load('product.media', 'user');

        return inertia()->render('Orders/ShowOrder', [
            'order' => $order
        ]);
    }

    public function edit(Order $order): InertiaResponse
    {
        $this->authorize('update', $order);

        return inertia()->render('Orders/EditOrder', [
            'order' => $order
        ]);
    }

    public function update(UpdateOrderRequest $request, Order $order): RedirectResponse
    {
        $this->authorize('update', $order);

        $order->update($request->validated());

        $order->fresh();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order updated.');
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted.');
    }
}
