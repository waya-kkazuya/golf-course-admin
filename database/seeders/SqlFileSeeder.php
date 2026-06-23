<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SQLファイルのパスを指定
        $path = database_path('seeders/sql/golf_courses.sql');

        if (File::exists($path)) {
            // ファイルの中身を取得
            $sql = File::get($path);

            // データベースに一括実行
            DB::unprepared($sql);
            
            $this->command->info('SQLファイルのインポートが完了しました！');
        } else {
            $this->command->error('SQLファイルが見つかりません。');
        }
    }
}
