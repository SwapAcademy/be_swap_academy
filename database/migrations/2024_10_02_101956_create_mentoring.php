<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enum\Course\CategoryEnum;
use App\Enum\Course\StatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentoring', function (Blueprint $table) {
            $table->id();
            $table->string('link')->nullable();
            $table->string('mentoring_name');
            $table->enum('category', CategoryEnum::getValues())->default(CategoryEnum::TECHNOLOGY);
            $table->text('description');
            $table->enum('status', StatusEnum::getValues())->default(StatusEnum::COMPLETED);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring');
    }
};
