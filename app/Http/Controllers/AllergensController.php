<?php

namespace App\Http\Controllers;

use App\Allergen;
use Illuminate\Http\Request;

class AllergensController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllAllergens()
    {
        return response()->json(Allergen::all());
    }
    
    public function getAllergen($id)
    {
        return response()->json(Allergen::find($id));
    }
}
