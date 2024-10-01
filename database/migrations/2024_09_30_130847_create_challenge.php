<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('challenge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('badge_id')->constrained('badge');
            $table->string('challenge_name');
            $table->text('description');
            $table->integer('reward_credits');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challange');
    }
};
