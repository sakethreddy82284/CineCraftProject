<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Award extends Model
{
    public $fillable=['awardname','date','movie_id'];


    public function movie(){
        return $this->BelongsTo(Movie::class);
    }
}
