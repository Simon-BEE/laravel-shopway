<?php

namespace App\Http\Controllers\Admin\Products\Category;

use App\Models\Category;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|between:3,150|unique:categories,name',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.products.categories.index')->with([
                'type' => 'error',
                'message' => 'Please fill the form correctly.'
            ]);
        }

        Category::create([
            'name' => request()->name,
        ]);

        return redirect()->route('admin.products.categories.index')->with([
            'type' => 'success',
            'message' => 'Category has been created.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.products.categories.index')->with([
            'type' => 'success',
            'message' => 'Category has been removed.'
        ]);
    }
}
