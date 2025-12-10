<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                        dd("Teacher");
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
}
