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
        Schema::create('video_games', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('description');
            $table->date('release');
            $table->string('cover');
            $table->string('box_art');
            $table->json('genres');
            $table->float('rating')->nullable();
            $table->json('platform');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_games');
    }
};
