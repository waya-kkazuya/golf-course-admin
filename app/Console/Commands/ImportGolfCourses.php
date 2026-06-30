<?php

namespace App\Console\Commands;

use App\http\Requests\GolfCourseRequest;
use App\Models\GolfCourse;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

#[Signature('golf-courses:import {file : CSVファイルのパス}')]
#[Description('Command description')]
class ImportGolfCourses extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = $this->argument('file');

        if (! file_exists($path)) {
            $this->error("ファイルが見つかりません: {$path}");

            return self::FAILURE;
        }

        $stream = fopen($path, 'r');

        // BOMをスキップ
        $bom = fread($stream, 3);
        if ($bom !== "\xEF\xBB\xBF") {
            rewind($stream);
        }

        // ヘッダー行を読み飛ばす
        $header = fgetcsv($stream);

        // エラー行を書き出すファイルを準備
        $errorFilePath = storage_path('app/import_errors_'.now()->format('YmdHis').'.csv');
        $errorStream = fopen($errorFilePath, 'w');
        fwrite($errorStream, "\xEF\xBB\xBF"); // // BOMを追加
        fputcsv($errorStream, array_merge($header, ['エラー内容']));

        $insertData = [];
        $successCount = 0;
        $errorCount = 0;
        $rowNumber = 1;
        $chunkSize = 500; // バルクインサートで一括取込するサイズ

        while (($row = fgetcsv($stream)) !== false) {
            $rowNumber++;

            // データの存在チェック
            $data = [
                'locale' => $row[1] ?? null,
                'country_code' => $row[2] ?? null,
                'state_prefecture' => $row[3] ?? null,
                'course_name' => $row[4] ?? null,
                'kinds' => $row[5] ?? null,
                'web' => $row[6] ?? null,
                'phone' => $row[7] ?? null,
                'address' => $row[8] ?? null,
                'indoor' => $row[9] ?? null,
                'outdoor' => $row[10] ?? null,
                'short_course' => $row[11] ?? null,
                'long_course' => $row[12] ?? null,
                'lat' => $row[13] ?? null,
                'lng' => $row[14] ?? null,
                'form_email' => $row[15] ?? null,
                'reservation' => $row[16] ?? null,
                'reservation_method' => $row[17] ?? null,
                'remarks' => $row[18] ?? null,
            ];

            $validationError = $this->validateRow($data);

            if ($validationError) {
                fputcsv($errorStream, array_merge($row, [$validationError]));
                $errorCount++;

                continue;
            }

            $insertData[] = [
                'locale' => $data['locale'],
                'country_code' => $data['country_code'],
                'state_prefecture' => $data['state_prefecture'],
                'course_name' => $data['course_name'],
                'kinds' => $data['kinds'] !== '' ? $data['kinds'] : null,
                'web' => $data['web'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'indoor' => $data['indoor'] === '1',
                'outdoor' => $data['outdoor'] === '1',
                'short_course' => $data['short_course'] === '1',
                'long_course' => $data['long_course'] === '1',
                'lat' => $data['lat'] !== '' ? $data['lat'] : null,
                'lng' => $data['lng'] !== '' ? $data['lng'] : null,
                'form_email' => $data['form_email'],
                'reservation' => $data['reservation'],
                'reservation_method' => $data['reservation_method'],
                'remarks' => $data['remarks'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // 500件ごとにまとめてinsert
            if (count($insertData) >= $chunkSize) {
                GolfCourse::insert($insertData);
                $successCount += count($insertData);
                $insertData = [];
            }
        }

        // 残りのデータをinsert
        if (count($insertData) > 0) {
            GolfCourse::insert($insertData);
            $successCount += count($insertData);
        }

        fclose($stream);
        fclose($errorStream);

        $this->info("登録完了: {$successCount}件");

        if ($errorCount > 0) {
            $this->warn("エラー: {$errorCount}件 → {$errorFilePath}");
        } else {
            // エラーがなければ空のエラーファイルを削除
            unlink($errorFilePath);
        }

        return self::SUCCESS;
    }

    private function validateRow(array $data): ?string
    {
        $rules = (new GolfCourseRequest)->rules();

        $validator = Validator::make($data, $rules);

        // afterクロージャの内容を手動で実行
        $lat = $data['lat'] ?? null;
        $lng = $data['lng'] ?? null;

        if (($lat === null || $lat === '') !== ($lng === null || $lng === '')) {
            $validator->errors()->add(
                'lat',
                'Please enter both latitude and longitude, or leave both empty.'
            );
        }

        if ($validator->fails()) {
            return implode(' / ', $validator->errors()->all());
        }

        return null;
    }
}
