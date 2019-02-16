<?php

namespace App\Http\Controllers;

use App\UserDiet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDietController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'pk_fk_d_user_id'  => 'required',
            'pk_fk__user_id' => 'required'
        ]);
    
        $user_diet = UserDiet::create($request->all());
            return response()->json($user_diet, 201);
    }
    
    public function update(Request $request)
    {
        $user_diet = UserDiet::findOrFail(Auth::id());
        $user_diet->update($request->all());
            return response()->json($user_diet, 200);
    }
    
    public function delete()
    {
        UserDiet::findOrFail(Auth::id())->delete();
        return response('Deleted Successfully', 200);
    }
}
