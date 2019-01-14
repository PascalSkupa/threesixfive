<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'create',
            'login'
        ]]);
    }

    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:3',
            'password' => 'required|min:8',
        ]);

        $data = $request->only('username', 'password');

        if (($user = User::where('username', '=', $data['username'])->first()) != [] & password_verify($data['password'], User::where('username', '=', $data['username'])->value('password'))) {

            return response()->json($user);
        }

        return response()->json(['User not found' => 404], 404);
    }

    public function create(Request $request)
    {
        if ($request->header('create') == 'allowed') {

            $this->validate($request, [
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|max:255',
                'username' => 'required|min:3|unique:users',
                'password' => 'required|min:8'
            ]);

            $input = $request->all();

            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['api_token'] = Str::random(60);

            $user = User::create($input);
            return response()->json($user, 201);
        }

        return response()->json(['Not acceptable' => 406], 406);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
