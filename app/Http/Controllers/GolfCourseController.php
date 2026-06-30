<?php

namespace App\Http\Controllers;

use App\Http\Requests\GolfCourseRequest;
use App\Models\GolfCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GolfCourseController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
            'state_prefecture' => ['nullable', 'string', 'max:255'],
            'locale' => ['nullable', 'in:ja,en'],
            'kind' => ['nullable', 'in:indoor,outdoor,short,long'],
        ]);

        $keyword = $request->input('keyword');
        $locale = $request->input('locale');
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
                    ->store('golf-courses/'.$golfCourse->id, 'public');
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
            if ($request->boolean('delete_'.$field) && $golfCourse->$field) {
                Storage::disk('public')->delete($golfCourse->$field);
                $validated[$field] = null;
            }

            // 新規アップロードがある場合
            if ($request->hasFile($field)) {
                if ($golfCourse->$field) {
                    Storage::disk('public')->delete($golfCourse->$field);
                }
                $validated[$field] = $request->file($field)
                    ->store('golf-courses/'.$golfCourse->id, 'public');
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
            ->with('success', "【{$course_name}】を削除しました。");
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
        $locale = $request->input('locale');
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

    public function restore(GolfCourse $golfCourse)
    {
        $course_name = $golfCourse->course_name;
        $golfCourse->restore();

        return redirect()->route('golf-courses.index')
            ->with('success', "【{$course_name} 】を復元しました。");
    }

    public function forceDelete(GolfCourse $golfCourse)
    {
        $course_name = $golfCourse->course_name;

        // フォルダごと削除
        Storage::disk('public')->deleteDirectory('golf-courses/'.$golfCourse->id);

        $golfCourse->forceDelete();

        return redirect()->route('golf-courses.trashed')
            ->with('success', "{$course_name} を完全に削除しました。");
    }

    public function export(Request $request): StreamedResponse
    {
        $keyword = $request->input('keyword');
        $locale = $request->input('locale');
        $statePrefecture = $request->input('state_prefecture');
        $kind = $request->input('kind');

        $golfCourses = GolfCourse::query()
            ->keyword($keyword)
            ->locale($locale)
            ->statePrefecture($statePrefecture)
            ->kind($kind)
            ->get();

        $fileName = 'golf_courses_'.now()->format('YmdHis').'.csv';

        return response()->streamDownload(function () use ($golfCourses) {
            $stream = fopen('php://output', 'w');

            // BOMを付与（Excelで文字化けを防ぐ）
            fwrite($stream, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($stream, [
                'ID', '言語', '国コード', '都道府県・州', '施設名', '種別', '公式サイトURL',
                '代表電話', '住所', 'インドア', 'アウトドア', 'ショートコース', 'ロングコース',
                '緯度', '経度', '問い合わせメール', '予約先URL／番号', '予約手段', '備考',
            ]);

            // データ行
            foreach ($golfCourses as $golfCourse) {
                fputcsv($stream, [
                    $golfCourse->id,
                    $golfCourse->locale,
                    $golfCourse->country_code,
                    $golfCourse->state_prefecture,
                    $golfCourse->course_name,
                    $golfCourse->kinds,
                    $golfCourse->web,
                    $golfCourse->phone,
                    $golfCourse->address,
                    $golfCourse->indoor ? '1' : '0',
                    $golfCourse->outdoor ? '1' : '0',
                    $golfCourse->short_course ? '1' : '0',
                    $golfCourse->long_course ? '1' : '0',
                    $golfCourse->lat,
                    $golfCourse->lng,
                    $golfCourse->form_email,
                    $golfCourse->reservation,
                    $golfCourse->reservation_method,
                    $golfCourse->remarks,
                ]);
            }

            fclose($stream);
        }, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
