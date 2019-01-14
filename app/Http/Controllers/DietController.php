<?php

namespace App\Http\Controllers;

use App\Diet;
use Illuminate\Http\Request;

class DietController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllDiets()
    {
        return response()->json(Diet::all());
    }
    
    public function getDiet($id)
    {
        return response()->json(Diet::find($id));
    }
}
