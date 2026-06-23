<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GolfCourse;

class GolfCourseController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
            'prefecture' => ['nullable', 'string', 'max:255'],
            'locale' => ['nullable', 'in:ja,en'],
            'kind' => ['nullable', 'in:indoor,outdoor,short,long'],
        ]);

        $keyword = $request->input('keyword');
        $locale  = $request->input('locale');

        // dump($locale);
        $golf_courses = GolfCourse::query()
            ->keyword($keyword)
            ->locale($locale)
            ->get();

        return view('golf-courses.index', compact('golf_courses', 'keyword'));
    }
}
