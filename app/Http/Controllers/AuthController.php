<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(){
        return view('signin');
    }

    public function login(AuthRequest $request){
        $user = User::where('email', $request->input('email'))->first();
        $password = Hash::check($request->input('password'), $user->password);

        if(!$password){
            throw ValidationException::withMessages([
                'password' => ['Неверный пароль']
            ]);
        }

        Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);

        //return redirect()->route('admin.index');
    }
}
