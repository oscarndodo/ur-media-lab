<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pending = $user->videos()->where("status", "private")->orderByDesc('created_at')->get();
        $published = $user->videos()->where("status", "public")->orderByDesc('created_at')->get();
        $views = 0;
        foreach ($published as $item) {
            $views += $item->views;
        }
        return view("home.index", [
            'user' => $user,
            'published' => $published,
            'pending' => $pending,
            "views" => $views
        ]);
    }

    public function publish(string $id)
    {
        $video = Video::find($id);
        $video['status'] = 'public';

        $video->save();
        return Redirect::back()->withErrors(['success' => "Video publicado."]);
    }
}
