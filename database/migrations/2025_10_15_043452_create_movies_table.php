<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('tmdb_id')->unique()->comment('The Movie Database ID');
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->date('release_date')->nullable();
            $table->unsignedTinyInteger('tomatometer_score')->nullable()->default(0);
            $table->string('thumbnail')->nullable();
            $table->string('trailer')->nullable();
            $table->timestamps();
        });
    }

   
    public function down(): void
{
  
    Schema::disableForeignKeyConstraints();

    Schema::dropIfExists('movies');


    Schema::enableForeignKeyConstraints();
}
};