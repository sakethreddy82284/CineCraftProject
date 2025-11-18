<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    public $fillable = ['movie_id','tv_show_id','user_id'];
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function tv_show(){
        return $this->belongsTo(Movie::class);
    }
}
