<?php

namespace App\Http\Controllers;

use App\Http\Requests\GolfCourseRequest;
use Illuminate\Http\Request;
use App\Models\GolfCourse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
        $golfCourse = GolfCourse::create($request->validated());

        // 可変変数を使用
        foreach (['image1', 'image2', 'image3'] as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)
                    ->store('golf-courses/' . $golfCourse->id, 'public');
                $golfCourse->update([$field => $path]);
            }
        }

        return redirect()->route('golf-courses.index')
            ->with('success', '登録しました。');
    }

    public function edit(GolfCourse $golfCourse)
    {
        return view('golf-courses.edit', compact('golfCourse'));
    }

    public function update(GolfCourseRequest $request, GolfCourse $golfCourse)
    {
        $validated = $request->validated();

        // 可変変数を使用
        foreach (['image1', 'image2', 'image3'] as $field) {
            // 削除チェックがある場合
            if ($request->boolean('delete_' . $field) && $golfCourse->$field) {
                Storage::disk('public')->delete($golfCourse->$field);
                $validated[$field] = null;
            }

            // 新規アップロードがある場合
            if ($request->hasFile($field)) {
                if ($golfCourse->$field) {
                    Storage::disk('public')->delete($golfCourse->$field);
                }
                $validated[$field] = $request->file($field)
                    ->store('golf-courses/' . $golfCourse->id, 'public');
            }
        }

        $golfCourse->update($validated);

        return redirect()->route('golf-courses.index')
            ->with('success', '更新しました。');
    }

    public function delete(GolfCourse $golfCourse)
    {
        return view('golf-courses.delete', compact('golfCourse'));
    }

    public function destroy(GolfCourse $golfCourse)
    {
        $course_name = $golfCourse->course_name;
        $golfCourse->delete();

        return redirect()->route('golf-courses.index')
            ->with('success', "【{$course_name}】を削除しました");
    }

    public function trashed(Request $request)
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

        $golfCourses = GolfCourse::onlyTrashed()
            ->keyword($keyword)
            ->locale($locale)
            ->statePrefecture($statePrefecture)
            ->kind($kind)
            ->orderByDesc('id')
            ->paginate(20);

        return view('golf-courses.trashed', compact('golfCourses', 'keyword'));
    }
}
