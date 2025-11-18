<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TvShow;
use Illuminate\Validation\Rule;


class TvshowController extends Controller
{
     public function index()
    {
       
        $movies = Tvshow::all();
        
    
        return view('admin.movie.showalltvshow', compact('movies'));
    }

    
    public function create()
    {
        return view('admin.movie.addtvshow');
    }

   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer|unique:tv_shows,tmdb_id',
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'release_date' => 'nullable|date',
            'tomatometer_score' => 'nullable|integer|min:0|max:100',
        ]);

        $data = TvShow::create($validatedData);

        return redirect()->route('showtvshow')->with('success', 'Tv sopw added successfully' );
    }

    public function show(string $id)
    {
 
        $data = TvShow::where( 'tmdb_id', $id)->firstOrFail();
        
        return response()->json(["data" => $data]);
    }

  
    public function edit($id)
    {
        $movie = TvShow::findOrFail($id);
        return view('admin.movie.edittvshow', compact('movie'));
        
    }

    

     public function update(Request $request, string $id)
    {
        $movie = TvShow::findOrFail($id);

    
        $validatedData = $request->validate([
            'tmdb_id' => [
                'required',
                'integer',
                Rule::unique('movies')->ignore($movie->id),
            ],
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['nullable', 'string'],
            'release_date' => ['nullable', 'date'], 
            'tomatometer_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'awardname'=> ['nullable', 'string', 'max:255'], 
            'awarddate' => ['nullable', 'date'], 
        ]);
      

        $awardName = $validatedData['awardname'] ?? null;
        $awardDate = $validatedData['awarddate'] ?? null;

        unset($validatedData['awardname']);
        unset($validatedData['awarddate']);

        $movie->update($validatedData);

        if ($awardName && $awardDate) {
            $movie->award()->create([
                'awardname' => $awardName,
                'date' => $awardDate
            ]);
        }

        return redirect()->route('showmovies')->with('success', 'Movie updated successfully!');
    }
    public function destroy(string $id)
    {
        $movie = TvShow::findOrFail($id);
        $movie->delete();
        return redirect()->back()->with('success', 'Movie deleted successfully!');
    }
}
