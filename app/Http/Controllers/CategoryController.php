<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use mysql_xdevapi\Exception;

use Inertia\Response as InertiaResponse;

class CategoryController extends Controller
{
    public function index(): InertiaResponse
    {
        return inertia()->render('Category/CategoryIndex', [
            'categories' => Category::all()
        ]);
    }

    public function create(): InertiaResponse
    {
        return inertia()->render('Category/CreateCategory');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', Category::class);

        $category = Category::create($request->validated());

        return redirect()->route('categories.show', $category)
            ->with('success', 'Category created');
    }

    public function show(Category $category): InertiaResponse
    {
        $this->authorize('view', $category);

        return inertia()->render('Category/ShowCategory', [
            'category' => $category
        ]);
    }

    public function edit(Category $category): InertiaResponse
    {
        $this->authorize('update', $category);

        return inertia()->render('Category/EditCategory', [
            'category' => $category
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $this->authorize('update', $category);

        $category->update($request->validated());

        $category->fresh();

        return redirect()->route('categories.show', $category)
            ->with('success', 'Category updated');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted');
    }
}
