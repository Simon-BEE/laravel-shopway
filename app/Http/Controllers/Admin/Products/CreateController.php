<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function create()
    {
        return view('admin.products.create');
    }

    public function store()
    {
        dd(request()->all());
    }
}
