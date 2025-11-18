<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
       public $timestamps = false;
    protected $table = 'tv_shows';

    protected $fillable = [
        'tmdb_id',
        'title',
        'synopsis',
        'release_date',
        'tomatometer_score',
        
    ];

    protected $casts = [
        'release_date' => 'date',
    ];
  
    public function user_review(){
        return $this->hasMany(User_review::class);
    }
    public function award(){
        return $this->hasMany(Award::class);
    }
     public function watchlist(){
       return $this->hasMany(Watchlist::class);
   }
}
