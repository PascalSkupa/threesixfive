<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function showOneUser()
    {
        return response()->json(User::find(Auth::id()));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $data = $request->only('email', 'password');

        if (($user = User::where('email', '=', $data['email'])->first()) != []) {
            if (password_verify($data['password'], User::where('email', '=', $data['email'])->value('password'))) {
                return response()->json($user);
            } else {
                return response()->json(['Incorrect password' => 406], 406);
            }
        }

        return response()->json(['User not found' => 404], 404);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'

        ]);

        $data = $request->only('email');
    }

    public function create(Request $request)
    {
        if ($request->header('Accept-Create') == 'Allowed') {

            $this->validate($request, [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:users|max:255',
                'password' => 'required|min:8'
            ]);

            $input = $request->all();

            $input['password'] = password_hash($input['password'], PASSWORD_ARGON2I);
            $input['api_token'] = Str::random(60);

            $user = User::create($input);
            return response()->json($user, 201);
        }

        return response()->json(['Not acceptable' => 406], 406);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if (isset($request['password'])) {
            if (password_verify($request['old_password'], User::where('pk_user_id', '=', Auth::id())->value('password'))) {
                $request['password'] = password_hash($request['password'], PASSWORD_ARGON2I);
                $user->update($request->all());
                return response()->json($user, 200);
            } else {
                return response()->json(['Old password not set or false' => 406], 406);
            }
        } else {
            $user->update($request->all());
            return response()->json($user, 200);
        }
    }

    public function delete()
    {
        User::findOrFail(Auth::id())->delete();
        return response('Deleted Successfully', 200);
    }
}
