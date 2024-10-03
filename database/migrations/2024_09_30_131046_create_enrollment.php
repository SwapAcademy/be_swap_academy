<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\Course\StatusEnum;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('course_id')->nullable()->constrained('course');
            $table->foreignId('mentor_id')->nullable()->constrained('users');
            $table->date('enrollment_at');
            $table->integer('progress')->default(0);
            $table->enum('status', StatusEnum::getValues())->default(StatusEnum::COMPLETED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
