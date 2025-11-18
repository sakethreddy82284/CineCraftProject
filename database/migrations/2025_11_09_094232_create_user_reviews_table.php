<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('movie_id')->nullable()->constrained('movies')->onDelete('cascade');
            $table->foreignId('tv_show_id')->nullable()->constrained('tv_shows')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned()->nullable();
            $table->text('review_text')->nullable();
            $table->enum('type', ['fresh', 'rotten']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user_reviews');
    }
};