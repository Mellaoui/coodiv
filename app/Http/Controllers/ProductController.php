<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Matiere;
use App\Models\Product;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(): InertiaResponse
    {
        $this->authorize('viewAny', Product::class);


        return inertia()->render('Product/ProductIndex', [
            'products' => Product::with('category', 'matiere', 'media')
                ->orderBy('updated_at', 'desc')
                ->paginate(5)
        ]);
    }

    public function create(): InertiaResponse
    {
        $this->authorize('create', Product::class);

        return inertia()->render('Product/CreateProduct', [
            'categories' => Category::all(),
            'matieres' => Matiere::all(),
        ]);
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->authorize('create', Product::class);

        $product = Product::create($request->validated());

        return redirect()->route('products.show', $product)
            ->with('success', 'Product created');
    }

    public function show(Product $product): InertiaResponse
    {
        $this->authorize('view', $product);

        return inertia()->render('Product/ShowProduct', [
            'product' => $product
        ]);
    }

    public function edit(Product $product): InertiaResponse
    {
        $this->authorize('update', $product);

        return inertia()->render('Product/EditProduct', [
            'product' => $product,
            'categories' => Category::all(),
            'matieres' => Matiere::all(),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        $product->fresh();

        return redirect()->route('products.show', $product)
            ->with('success', 'Product updated');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted');
    }
}
