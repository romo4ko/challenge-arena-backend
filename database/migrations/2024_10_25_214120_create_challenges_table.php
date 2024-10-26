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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->text('result')->nullable();
            $table->timestamps();
            $table->foreignId('achievement_id')->nullable()->constrained('achievements')->onDelete('set null');
            $table->string('image')->nullable();
            $table->string('type')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges');
    }
};
