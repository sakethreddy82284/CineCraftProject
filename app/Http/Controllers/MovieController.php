<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Validation\Rule;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class MovieController extends Controller
{
    protected $uploadApi;

    public function __construct()
    {
        Configuration::instance(env('CLOUDINARY_URL'));
        $this->uploadApi = new UploadApi();

        
        // Create the configuration object
        // $config = new Configuration([
        //     'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        //     'api_key'    => env('CLOUDINARY_API_KEY'),
        //     'api_secret' => env('CLOUDINARY_API_SECRET'),
        //     'secure'     => true,
        // ]);

        // // Disable SSL verification at cURL level (development only)
        // $config->url->curl_options = [
        //     CURLOPT_SSL_VERIFYPEER => false,
        //     CURLOPT_SSL_VERIFYHOST => false,
        // ];

        // // Pass configuration object into UploadApi
        // $this->uploadApi = new UploadApi($config);
    }

   
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movie.showallmovies', compact('movies'));
    }

    public function create()
    {
        return view('admin.movie.addmovie');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tmdb_id' => 'required|integer|unique:movies,tmdb_id',
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'release_date' => 'nullable|date',
            'tomatometer_score' => 'nullable|integer|min:0|max:100',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $uploadedFile = $request->file('thumbnail');

            $uploadResult = $this->uploadApi->upload(
                $uploadedFile->getRealPath(),
                [
                    'folder' => 'profiles',
                    'resource_type' => 'image',
                    'transformation' => [
                        [
                            'width' => 300,
                            'height' => 300,
                            'crop' => 'fill'
                        ]
                    ]
                ]
            );

            $validatedData['thumbnail'] = $uploadResult['secure_url'];

            Movie::create($validatedData);

            return redirect()->route('showmovies')->with('success', 'Movie added successfully!');
        } catch (\Exception $e) {
            \Log::error('Cloudinary upload failed: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['thumbnail' => 'Failed to upload image: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show(string $id)
    {
        $data = Movie::where('tmdb_id', $id)->firstOrFail();
        return response()->json(['data' => $data]);
    }

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movie.editmovie', compact('movie'));
    }

    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

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

        unset($validatedData['awardname'], $validatedData['awarddate']);

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
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->back()->with('success', 'Movie deleted successfully!');
    }
}
