<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth");
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            "email" => "required|email",
            "password" => "required|min:6"
        ]);
        // dd($data, Auth::attempt($data, true));

        if (Auth::attempt($data, true)) {
            $user = Auth::user();
            if ($user) {
                switch ($user->role) {
                    case 'Admin':
                        return Redirect::route("admin.home");
                    case 'Manager':
                        return Redirect::route("admin.home");
                    case 'Teacher':
                        return Redirect::route("user.home");
                    default:
                        dd("Other");
                        break;
                }
            } else {
                return Redirect::back()->withErrors(["error" => "Credênciais inválidas."]);
            }
        }
        return Redirect::back()->withErrors(["error" => "Credênciais inválidas."]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'password' => "required|min:6",
            'new-password' => "required|min:6",
            'confirm-password' => "required|min:6",
        ]);

        if (Hash::check($data["password"], $user->password)) {
            if ($data['new-password'] === $data['confirm-password']) {
                $user['password'] = Hash::make($data['new-password']);
                $user->save();
                Auth::logout();
                return Redirect::route('login');
            }
        }
        return Redirect::back()->withErrors(['error' => 'Erro inesperado.']);
    }


    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');
    }
}
