<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class ProductsExport implements FromCollection
{
    public function collection(): Collection
    {
        $headers = collect([
            [
                'reference' => 'Reference',
                'designation' => 'Designation',
                'category' => 'Category',
                'matiere' => 'Material',
                'buy_price' => 'Buy Price',
                'sell_price' => 'Sell Price',
                'weight' => 'Weight',
                'discount' => 'Discount',
                'quantity' => 'Quantity',
                'last_updated' => 'Last Updated',
            ]
        ]);

        $data = Product::with('category', 'matiere')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function (Product $product) {
                return [
                    'reference' => $product->reference,
                    'designation' => $product->designation,
                    'category' => $product->category->name,
                    'matiere' => $product->matiere->name,
                    'buy_price' => $product->buy_price,
                    'sell_price' => $product->sell_price,
                    'weight' => $product->weight,
                    'discount' => $product->discount,
                    'quantity' => $product->quantity,
                    'last_updated' => $product->updated_at->format('Y/m/d H:i'),
                ];
            });

        return $headers->merge($data);
    }
}
