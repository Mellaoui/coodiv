<?php

namespace App\Services;

use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Excel;

class ExportService
{
    public function exportOrders(Excel $excel)
    {
        return $excel->download(new OrdersExport, 'orders.xlsx');
    }

    public function exportProducts(Excel $excel)
    {
        return $excel->download(new ProductsExport, 'products.xlsx');
    }
}
