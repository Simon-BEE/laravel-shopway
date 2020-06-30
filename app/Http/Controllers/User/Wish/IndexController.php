<?php

namespace App\Http\Controllers\User\Wish;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('users.wish.index');
    }
}
