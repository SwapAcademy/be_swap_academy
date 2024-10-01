<?php

use App\Enum\Course\CategoryEnum;
use App\Enum\Course\DiffEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->enum('category', CategoryEnum::getValues())->default(CategoryEnum::TECHNOLOGY);
            $table->text('description');
            $table->enum('difficulty_level', DiffEnum::getValues())->default(DiffEnum::BEGINNER);
            $table->integer('duration');
            $table->integer('credits_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
