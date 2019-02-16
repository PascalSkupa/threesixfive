<?php

namespace App\Http\Controllers;

use App\NoGo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoGoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'fk_n_user_id' => 'required',
            'fk_object' => 'required',
            'which' => 'required'
        ]);
    
        $nogo = NoGo::create($request->all());
            return response()->json($nogo, 201);
    }
    
    public function update(Request $request)
    {
        $nogo = NoGo::findOrFail(Auth::id());
        $nogo->update($request->all());
            return response()->json($nogo, 200);
    }
    
    public function delete()
    {
        NoGo::findOrFail(Auth::id())->delete();
        return response('Deleted Successfully', 200);
    }
}
