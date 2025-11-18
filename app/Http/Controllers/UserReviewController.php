<?php

namespace App\Http\Controllers;

use App\Models\User_Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\TvShow;
use Illuminate\Validation\Rule; 

class UserReviewController extends Controller
{

    public function index()
    {
        $data=User_Review::all();
        return response()->json(["data"=>$data]);

    }
    public function create()
    {
        //
    }

   public function store(Request $request)
   {

    $validatedData = $request->validate([
        'movie_id'    => 'required|integer|exists:movies,id',
        'review_text' => 'nullable|string|max:5000',
        'rating'      => 'required|integer|min:1|max:5',
        'type'        => ['required', Rule::in(['fresh', 'rotten'])],
    ]);


    $validatedData['user_id'] = Auth::id();

  
    User_Review::create($validatedData);
   
    $movie = Movie::findOrFail($validatedData['movie_id']);

    $count=User_Review::where('movie_id',$movie->id)->count();
    
    $oldCount = $count - 1;

    $newAverageRating = (($movie->tomatometer_score * $oldCount) + $validatedData['rating']) / $count;

    $movie->update(['tomatometer_score' => round($newAverageRating, 1)]);
         
    return redirect()->back()->with('success','movie added successfully');
}
   

 public function storetvshowreview(Request $request)
   {

  $validatedData = $request->validate([
    'tv_show_id'    => 'required|integer|exists:tv_shows,id',
    'review_text' => 'nullable|string|max:5000',
    'rating'      => 'required|integer|min:1|max:5',
    'type'        => ['required', Rule::in(['fresh', 'rotten'])],
]);

$validatedData['user_id'] = Auth::id();
User_Review::create($validatedData);

   
    $movie = TvShow::findOrFail($validatedData['tv_show_id']);

    $count=User_Review::where('tv_show_id',$movie->id)->count();

if ($count == 0) {
  
    $newAverageRating = $validatedData['rating'];
} else {
    $oldCount = $count - 1;
    $newAverageRating = (($movie->tomatometer_score * $oldCount) + $validatedData['rating']) / $count;
}

$movie->update(['tomatometer_score' => round($newAverageRating, 1)]);
         

//    return response()->json(["data"=>$movie]);
    return redirect()->back()->with('success','movie added successfully');
}
    public function show(string $id)
    {
        //
    }

  
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
