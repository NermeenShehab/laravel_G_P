<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $catagories=Category::all();

        return  $catagories;
    }

    public function show()
    {
        $catagory = User::all();
        return  $catagory ;
    }
}
