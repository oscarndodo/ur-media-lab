<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function teachers(Request $request)
    {
        return view("admin.teachers");
    }

    public function teacherStore(Request $request)
    {
        if ($request->method() == "GET") {
            return view("admin.new-teacher");
        }
        $data = $request->validate([
            "name" => "required|min:3",
            "email" => "required|email",
            "phone" => "required|min:9",
            "bi"    => "nullable|min:11",
            "description" => "required|min:10",
            "formation" => "required",
            "area" => "required",
            "institute" => "required",
        ]);

        if (User::where("email", $data["email"])->first()) return Redirect::back()->withErrors(['error' => 'Email em uso.']);
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "role" => "Teacher",
            "password" => "123456"
        ]);

        if (isset($request['file'])) {
            $photo = $request['file']->store("profiles");
        }
        dd($user->bio);
        $user->bio()->create([
            "phone" => $data['phone'],
            "photo" => $photo ?? null,
            "num_doc" => $data['bi'],
            "description" => $data['description'],
            "formation" => $data['formation'],
            "area" => $data['area'],
            "institute" => $data['institute'],
        ]);
        return Redirect::route("admin.teachers");
    }


    public function categories()
    {
        $categories = Category::orderByDesc('id')->paginate();

        foreach ($categories as $item) {
            $item["videos"] = Video::where("category", $item["id"])->count();
        }

        return view("admin.categories", compact("categories"));
    }
    public function categoryStore(Request $request)
    {
        $data = $request->validate([
            "name" => "required|min:3",
            "color" => "required",
        ]);
        Category::create($data);
        return Redirect::back();
    }
    public function categoryDelete(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return Redirect::back();
    }
}
