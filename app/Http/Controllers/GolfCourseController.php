<?php

namespace App\Http\Controllers;

use App\Http\Requests\GolfCourseRequest;
use Illuminate\Http\Request;
use App\Models\GolfCourse;
use Illuminate\View\View;

class GolfCourseController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
            'prefecture' => ['nullable', 'string', 'max:255'],
            'locale' => ['nullable', 'in:ja,en'],
            'kind' => ['nullable', 'in:indoor,outdoor,short,long'],
        ]);

        $keyword = $request->input('keyword');
        $locale  = $request->input('locale');
        $statePrefecture = $request->input('state_prefecture');
        $kind = $request->input('kind');

        $golfCourses = GolfCourse::query()
            ->keyword($keyword)
            ->locale($locale)
            ->statePrefecture($statePrefecture)
            ->kind($kind)
            ->orderByDesc('id')
            ->paginate(20);

        return view('golf-courses.index', compact('golfCourses', 'keyword'));
    }

    public function show(GolfCourse $golfCourse)
    {
        return view('golf-courses.show', compact('golfCourse'));
    }

    public function create()
    {
        return view('golf-courses.create');
    }

    public function store(GolfCourseRequest $request)
    {
        GolfCourse::create($request->validated());

        return redirect()->route('golf-courses.index')
            ->with('success', '登録しました。');
    }
}
