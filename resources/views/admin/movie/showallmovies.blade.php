<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Movies</title>
    
    <link rel="stylesheet" href="{{ asset('css/admin/showallmovies.css') }}">
</head>
<body>

    <div class="header-container">
        <h1>Movie List</h1>   
        <a href="{{ route('addmovie') }}" class="btn-add-movie">
            + Add New Movie
        </a>

                <a href="{{ route('backtodash') }}">back</a>

    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Synopsis</th>
                    <th>Release Date</th>
                    <th>Score</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($movies as $movie) 
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->title }}</td>
                        
                        <td>{{ Str::limit($movie->synopsis, 50) }}</td>
                        
                        <td>{{ $movie->release_date }}</td>
                        <td>{{ $movie->tomatometer_score }}%</td>
                        
                        <td class="actions">
                            <a href="{{ route('editpage',$movie->id) }}" class="btn-edit">Edit</a>
                            <form method="POST" action="{{ route('deltemovie', $movie->id) }}" style="display:inline;">
                                     @csrf
                                     @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No movies found.</td>
                    </tr>
                @endforelse 
            </tbody>
        </table>
    </div>

</body>
</html>