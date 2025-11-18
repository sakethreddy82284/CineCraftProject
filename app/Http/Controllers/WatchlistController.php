<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\TvShow;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
   public function index()
   {
    $user = Auth::id();


    $movies = Watchlist::where('user_id', $user)
                ->whereNotNull('movie_id')
                ->with('movie')
                ->get();

    $tv_shows = Watchlist::where('user_id', $user)
                ->whereNotNull('tv_show_id')
                ->with('tv_show')
                ->get();

    return view('user.watchlist', compact('movies', 'tv_shows'));
   }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request, string $id)
   {
    $user = Auth::user();
    $movieId   = $request->input('movie_id');
    $tvShowId  = $request->input('tv_show_id');

    if (!$movieId && !$tvShowId) {
        $movieId = $id; 
    }

    if (!$movieId && !$tvShowId) {
        return redirect()->back()->with('error', 'Movie ID or TV Show ID is required');
    }


    if ($movieId) {
        $exists = Watchlist::where('user_id', $user->id)
                           ->where('movie_id', $movieId)
                           ->first();
    } else {
        $exists = Watchlist::where('user_id', $user->id)
                           ->where('tv_show_id', $tvShowId)
                           ->first();
    }

    if ($exists) {
        return redirect()->back()->with('error', 'Already added to watchlist');
    }

    $data = Watchlist::create([
        'user_id'    => $user->id,
        'movie_id'   => $movieId,
        'tv_show_id' => $tvShowId
    ]);

    return redirect()->back()->with('success', 'Added to watchlist successfully');
   }


   
    public function show(Watchlist $watchlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Watchlist $watchlist)
    {
        //
    }


    public function update(Request $request, Watchlist $watchlist)
    {
        //
    }

  
   public function destroy($id)
   {
    $user = Auth::user();


    $item = Watchlist::where('user_id', $user->id)
                     ->where('movie_id', $id)
                     ->first();

    if (!$item) {
        $item = Watchlist::where('user_id', $user->id)
                         ->where('tv_show_id', $id)
                         ->first();
    }

    if (!$item) {
        return redirect()->back()->with('error', 'Item not found in watchlist');
    }

    $item->delete();

    return redirect()->back()->with('success', 'Removed from watchlist');
}


}
