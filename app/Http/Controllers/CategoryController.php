<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories',
        ]);

        try {
            Category::create([
                'name' => $request->name,
            ]);
            Alert::success('Success', 'Category created successfully');
            return to_route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to create category');
            return back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $category->id,
        ]);

        try {
            $category->update([
                'name' => $request->name,
            ]);
            Alert::success('Success', 'Category updated successfully');
            return to_route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to update category');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Category::destroy($id);
            Alert::success('Success', 'Category deleted successfully');
            return to_route('category.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Failed to delete category');
            return back();
        }
    }
}
