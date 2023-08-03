<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Services\ExportService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return inertia()->render('Dashboard', [
            'products' => Product::with('category', 'matiere', 'media')
                ->orderBy('updated_at', 'desc')
                ->paginate(10),
        ]);
    })->name('dashboard');

    Route::get('/orders/export', [ExportService::class, 'exportOrders'])->name('orders.export');
    Route::get('/products/export', [ExportService::class, 'exportProducts'])->name('products.export');
});

Route::resources([
    'categories' => CategoryController::class,
    'products'   => ProductController::class,
    'matieres'   => MatiereController::class,
    'orders'     => OrderController::class,
]);

require __DIR__.'/auth.php';
