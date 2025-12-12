<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $videos = Video::where('status', 'public')->orderBy("created_at", "desc")->paginate(10);
        $categorias = Category::limit(10)->get();
        return view("welcome", [
            'videos' => $videos,
            'categorias' => $categorias
        ]);
    }

    public function show(string $id)
    {
        $video = Video::find($id);
        $video["views"] += 1;
        $video->save();

        $user = $video->user;
        $related_videos = $user->videos()
            ->where("status", "public")
            ->whereNot('id', $video->id)
            ->latest()   // igual a orderByDesc("created_at")
            ->get();


        $other_related = Video::where("status", "public")
            ->where("category", "like", "%$video->category%")
            ->where("user_id", "!=", $video->user_id)
            ->where("id", "!=", $video->id)
            ->where("title", "like", "%$video->title%")
            ->where("description", "like", "%$video->description%")
            ->orderByDesc("created_at")
            ->limit(6)
            ->get();

        $user = $video->user;
        // dd($user->bio);

        return view('video', [
            'video' => $video,
            'related_videos' => $related_videos,
            'other_related' => $other_related
        ]);
    }

    public function search(Request $request)
    {
        $query = $request['q'];

        $videos = Video::where('status', 'public')
            ->where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orderBy("created_at", "desc")
            ->paginate(10);
        $categorias = Category::limit(10)->get();
        return view("welcome", [
            'videos' => $videos,
            'categorias' => $categorias
        ]);
    }
}
