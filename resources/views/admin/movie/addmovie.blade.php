    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Movie</title>
        <link rel="stylesheet" href="{{ asset('css/admin/addmovie.css') }}"> 
    </head>
    <body>

        <div class="movie-form-container">

            <h1 class="form-title">Add New Movie</h1>
            
            <form action="{{ route("addingmovie") }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="tmdb_id">TMDB ID</label>
                    <input type="number" id="tmdb_id" name="tmdb_id" 
                        class="form-input @error('tmdb_id') is-invalid @enderror" 
                        placeholder="Enter movie TMDB ID" value="{{ old('tmdb_id') }}" />
                    
                    @error('tmdb_id')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" 
                        class="form-input @error('title') is-invalid @enderror" 
                        placeholder="Enter movie title" value="{{ old('title') }}" />
                    
                    @error('title')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea id="synopsis" name="synopsis" 
                            class="form-textarea @error('synopsis') is-invalid @enderror" 
                            placeholder="Enter movie synopsis">{{ old('synopsis') }}</textarea>
                    
                    @error('synopsis')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" id="release_date" name="release_date" 
                        class="form-input @error('release_date') is-invalid @enderror" 
                        value="{{ old('release_date') }}" />
                    
                    @error('release_date')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="thumbnail">Profile Picture:</label>
                    <input type="file" name="thumbnail" class="form-input @error('thumbnail') is-invalid @enderror">
                    @error('thumbnail')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
            </div>
            

                <div class="form-group">
                    <button type="submit" class="submit-btn">Add Movie</button>
                </div>
                
            </form>
        </div>

    </body>
    </html>