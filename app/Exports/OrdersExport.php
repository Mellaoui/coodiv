<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    public function collection(): Collection
    {
        $headers = collect([
            [
                'identifier'      => 'Order ID',
                'tracking_number' => 'Tracking Number',
                'customer'        => 'Customer',
                'product'         => 'Product',
                'status'          => 'Status',
                'quantity'        => 'Quantity',
                'total_price'     => 'Total Price',
                'last_updated'    => 'Last Updated',
            ],
        ]);

        $data = Order::with('product', 'user')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function (Order $order) {
                return [
                    'identifier'      => $order->id,
                    'tracking_number' => $order->tracking_number,
                    'customer'        => $order->user->name,
                    'product'         => $order->product->reference,
                    'status'          => $order->status,
                    'quantity'        => $order->quantity,
                    'total_price'     => $order->total_price,
                    'last_updated'    => $order->updated_at->format('Y/m/d H:i'),
                ];
            });

        return $headers->merge($data);
    }
}
