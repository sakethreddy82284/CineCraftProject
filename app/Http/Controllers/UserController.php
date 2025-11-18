<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User_Review;
use App\Models\Award;
use App\Models\TvShow;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        $movies=Movie::all();
        $tv_shows=TvShow::all();
           return view('user.dash',compact('movies','tv_shows'));
    }
    public function movie_card($id){
        $user=Auth::user()->id;
        $movie = Movie::findOrFail($id);
        $awards=Award::where("movie_id",$id)->get();
        $samecastmovies=Movie::all();
        $reviews=User_Review::where("movie_id",$id)->get();   
        $exists=Watchlist::where(['movie_id'=>$id,'user_id'=>$user])->exists();   
        $status = $exists ? 1 : 0;
        return view('user.moviecard',compact('movie','awards','samecastmovies','reviews','status'));
        
    }
    public function tvshow_card($id){
        $user=Auth::user()->id;
        $movie = TvShow::findOrFail($id);
        $awards=Award::where("tv_show_id",$id)->get();
        $samecastmovies=Tvshow::all();
        $reviews=User_Review::where("tv_show_id",$id)->get();
        $exists=Watchlist::where(['tv_show_id'=>$id,'user_id'=>$user])->exists();   
        $status = $exists ? 1 : 0;
        return view('user.tvshowcard',compact('movie','awards','samecastmovies','reviews','status'));
        
    }

    public function search(Request $request){
        $query=$request->input('query');
        $movies = Movie::where('title', 'like', "%{$query}%")->get();
        $tvShows = TvShow::where('title', 'like', "%{$query}%")->get();
        return view('user.search', compact('query', 'movies', 'tvShows'));    
    }

    public function alltvshows(){
        $tv_shows = TvShow::paginate(9); 
        return view('user.alltvshows', compact('tv_shows'));
    }
    public function allmovies(){
        $movies = Movie::paginate(9); 
        return view('user.allmovies', compact('movies'));
    }
}
