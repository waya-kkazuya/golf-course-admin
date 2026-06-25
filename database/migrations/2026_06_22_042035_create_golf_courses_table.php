<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('golf_courses', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->string('locale', 2);
            $table->string('country_code', 2);
            $table->string('state_prefecture', 255)->nullable(); //省略しても255文字
            $table->string('course_name', 255);
            $table->integer('kinds')->nullable(); //unsigned(正の数)である必要はない？
            $table->text('web')->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->boolean('indoor')->nullable()->default(false); // nullable??
            $table->boolean('outdoor')->nullable()->default(false); // nullable??
            $table->boolean('short_course')->nullable()->default(false); // nullable??
            $table->boolean('long_course')->nullable()->default(false); // nullable??
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('form_email', 255)->nullable();
            $table->string('reservation', 255)->nullable();
            $table->string('reservation_method', 255)->nullable();
            $table->text('remarks')->nullable();
            $table->string('image1', 255)->nullable();
            $table->string('image2', 255)->nullable();
            $table->string('image3', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('golf_courses');
    }
};
