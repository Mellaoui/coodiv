<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Matiere;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(): InertiaResponse
    {
        $this->authorize('viewAny', Product::class);


        return inertia()->render('Product/ProductIndex', [
            'products' => Product::with('category', 'matiere', 'media')
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): InertiaResponse
    {
        $this->authorize('create', Product::class);

        return inertia()->render('Product/CreateProduct', [
            'categories' => Category::all(),
            'matieres' => Matiere::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->authorize('create', Product::class);

        $product = Product::create($request->validated());

        return redirect()->route('products.show', $product)
            ->with('success', 'Product created');
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Product $product): InertiaResponse
    {
        $this->authorize('view', $product);

        return inertia()->render('Product/ShowProduct', [
            'product' => $product
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Product $product): InertiaResponse
    {
        $this->authorize('update', $product);

        return inertia()->render('Product/EditProduct', [
            'product' => $product,
            'categories' => Category::all(),
            'matieres' => Matiere::all(),
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        $product->fresh();

        return redirect()->route('products.show', $product)
            ->with('success', 'Product updated');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted');
    }
}
