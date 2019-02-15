<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;

class PlansController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'pk_date' => 'required',
            'pk_fk_user_id' => 'required',
            'weekday' => 'required',
            'breakfast' => 'required',
            'lunch' => 'required',
            'dinner' => 'required',
            'snack' => 'required'
        ]);
    
        $plan = Plan::create($request->all());
            return response()->json($plan, 201);
    }
    
    public function update($id, Request $request)
    {
        $plan = Plan::findOrFail($id);
        $plan->update($request->all());
            return response()->json($plan, 200);
    }
    
    public function delete($id)
    {
        Plan::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
