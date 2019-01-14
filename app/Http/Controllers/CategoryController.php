<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllCategories()
    {
        return response()->json(Category::all());
    }
    
    public function getCategory($id)
    {
        return response()->json(Category::find($id));
    }
}
