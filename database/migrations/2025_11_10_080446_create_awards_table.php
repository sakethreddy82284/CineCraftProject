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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('awardname')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('movie_id')->nullable()->constrained('movies')->onDelete('cascade');
            $table->foreignId('tv_show_id')->nullable()->constrained('tv_shows')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
