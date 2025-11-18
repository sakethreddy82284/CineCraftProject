<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Review extends Model
{
   
    protected $table = 'user_reviews'; 
   

    protected $fillable = [
        'user_id',
        'movie_id',
        'tv_show_id',
        'rating',
        'review_text',
        'type',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }    
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
     public function tv_show(){
        return $this->belongsTo(Movie::class);
    }
}