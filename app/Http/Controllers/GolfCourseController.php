<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GolfCourse;

class GolfCourseController extends Controller
{
    public function index()
    {
        return view('golf-courses.index', ['golf_courses' => GolfCourse::all() ]);
    }
}
