<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function home(Request $request)
    {

        $totalVideos   = Video::count();
        $totalTeachers = User::where('role', 'Teacher')->count();

        $activeUsers = User::where("status", true)->where("role", "Teacher")->orWhere("role", "Other")->count();

        $pendingVideos = Video::where('status', 'private')->count();


        $videosThisMonth = Video::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $videosLastMonth = Video::whereBetween('created_at', [
            now()->subMonthNoOverflow()->startOfMonth(),
            now()->subMonthNoOverflow()->endOfMonth()
        ])->count();

        $videoGrowthPct = $videosLastMonth > 0
            ? (int) round((($videosThisMonth - $videosLastMonth) / $videosLastMonth) * 100)
            : ($videosThisMonth > 0 ? 100 : 0);

        $teachersThisMonth = User::where('role', 'Teacher')
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $teachersLastMonth = User::where('role', 'Teacher')
            ->whereBetween('created_at', [
                now()->subMonthNoOverflow()->startOfMonth(),
                now()->subMonthNoOverflow()->endOfMonth()
            ])
            ->count();

        $teacherGrowthPct = $teachersLastMonth > 0
            ? (int) round((($teachersThisMonth - $teachersLastMonth) / $teachersLastMonth) * 100)
            : ($teachersThisMonth > 0 ? 100 : 0);


        $latestVideos = Video::orderByDesc('created_at')
            ->take(7)
            ->get();


        $hasViews = Schema::hasColumn('videos', 'views');

        $start = now()->subMonths(11)->startOfMonth();
        $end   = now()->endOfMonth();


        $monthlyRaw = Video::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, " . ($hasViews ? "SUM(views)" : "COUNT(*)") . " as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('ym')
            ->orderBy('ym')
            ->pluck('total', 'ym');


        $labels = [];
        $series = [];

        $cursor = $start->copy();
        $monthNames = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        while ($cursor <= $end) {
            $ym = $cursor->format('Y-m');
            $labels[] = $monthNames[((int)$cursor->format('n')) - 1];
            $series[] = (int) ($monthlyRaw[$ym] ?? 0);
            $cursor->addMonthNoOverflow();
        }


        $categories = Video::all();

        return view('admin.home', [
            'totalVideos'      => $totalVideos,
            'totalTeachers'    => $totalTeachers,
            'activeUsers'      => $activeUsers,
            'pendingVideos'    => $pendingVideos,

            'videosThisMonth'  => $videosThisMonth,
            'videoGrowthPct'   => $videoGrowthPct,
            'teacherGrowthPct' => $teacherGrowthPct,

            'latestVideos'     => $latestVideos,

            'chartLabels'      => $labels,
            'chartSeries'      => $series,
            'chartIsViews'     => $hasViews, // útil para ajustar o título no Blade

            'categories'       => $categories,
        ]);
    }

    public function teachers(Request $request)
    {
        $teachers = User::where("role", "Teacher")->orderByDesc("created_at")->paginate();
        return view("admin.teachers", [
            "teachers" => $teachers
        ]);
    }

    public function teacherStore(Request $request)
    {
        if ($request->method() == "GET") {
            return view("admin.new-teacher");
        }
        $data = $request->validate([
            "name" => "required|min:3",
            "email" => "required|email",
            "description" => "nullable|min:10",
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

        $user->bio()->create([
            "photo" => $photo ?? null,
            "description" => $data['description'],
            "formation" => $data['formation'],
            "area" => $data['area'],
            "institute" => $data['institute'],
        ]);
        return Redirect::route("admin.teachers");
    }

    public function teacherEdit(string $id)
    {
        $teacher = User::find($id);
        return view("admin.edit-teacher", [
            'teacher' => $teacher
        ]);
    }

    public function teacherUpdate(string $id, request $request)
    {
        $teacher = User::find($id);
        $data = $request->validate([
            "name" => "required|min:3",
            "description" => "nullable|min:10",
            "formation" => "required",
            "area" => "required",
            "institute" => "required",
        ]);


        $teacher['name'] = $data['name'];
        $teacher->save();

        if (isset($request['file'])) {
            if ($teacher->bio->photo != null) {
                Storage::delete($teacher->bio->photo);
            }
            $photo = $request['file']->store("profiles");
        }

        $teacher->bio()->update([
            "photo" => $photo ?? null,
            "description" => $data['description'],
            "formation" => $data['formation'],
            "area" => $data['area'],
            "institute" => $data['institute'],
        ]);
        return Redirect::route("admin.teachers");
    }

    public function teacher(string $id, Request $request)
    {
        $teacher = User::find($id);
        $categories = Category::all();

        $perPage = $request->get('per_page', 10);
        $videos = $teacher->videos()->orderByDesc("created_at")->paginate($perPage);

        $private = $teacher->videos()->where('status', 'private')->get()->count();
        $public = $teacher->videos()->where('status', 'public')->get()->count();

        return view("admin.teacher", [
            'teacher' => $teacher,
            'categories' => $categories,
            'videos' => $videos,
            'private' => $private,
            'public' => $public
        ]);
    }

    public function teacherBlock(string $id)
    {
        $teacher = User::find($id);
        foreach ($teacher->videos as $item) {
            $item['status'] = 'private';
            $item->save();
        }
        $teacher['status'] = false;
        $teacher->save();
        return Redirect::back()->withErrors(['success' => 'Docente bloqueado.']);
    }


    public function teacherActive(string $id)
    {
        $teacher = User::find($id);
        $teacher['status'] = true;
        $teacher->save();
        return Redirect::back()->withErrors(['success' => 'Docente activo.']);
    }


    public function videoUpload(Request $request)
    {
        $id = $request->id;
        $teacher = User::find($id);
        if (!$teacher) return Redirect::back()->withErrors(['error' => 'Docente nao encontrado.']);

        $data = $request->validate([
            "title" => "required|min:6",
            "description" => "required|min:30",
            "category" => "required",
            "duration" => "nullable"
        ]);

        $url = $request->file("video")->store("videos");
        $data['url'] = $url;
        $video = $teacher->videos()->create($data);
        if (!$video) {
            return Redirect::back()->withErrors(['error' => 'Erro desconhecido.']);
        }
        return Redirect::back()->withErrors(['success' => 'Video adicionado.']);
    }


    public function categories()
    {
        $categories = Category::orderByDesc('id')->paginate();

        foreach ($categories as $item) {
            $item["videos"] = Video::where("category", $item["name"])->count();
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
