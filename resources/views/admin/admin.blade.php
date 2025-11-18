<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/adminpage.css') }}">
 
</head>
<body>

    <nav class="navbar">
        <a href="#" class="nav-logo">MyWebsite</a>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Services</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">Contact</a>
            </li>
            
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    
                    <a href="{{ route('logout') }}"
                       class="nav-link nav-link-logout" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <div class="card-container">
         <div class="show-card">
            <div class="card-image-container">
                <img src="https://img.freepik.com/premium-vector/movie-theater-signboard-blue_34230-295.jpg?semt=ais_hybrid&w=740&q=80" alt="Show Poster">
            </div>
            <div class="card-content">
                <h3 class="card-title">Movies</h3>
                <p class="card-description"></p>
                <a href="{{ route('showmovies') }}" class="btn card-btn">More Info</a>
            </div>
        </div>

        <div class="show-card">
            <div class="card-image-container">
                <img src="https://png.pngtree.com/thumb_back/fh260/background/20230614/pngtree-tv-channel-wall-showing-lots-of-images-image_2969811.jpg" alt="Show Poster">
            </div>
            <div class="card-content">
                <h3 class="card-title">TV Shows</h3>
                <p class="card-description"></p>
                <a href="{{ route('showtvshow') }}" class="btn card-btn">More Info</a>
            </div>
        </div>

  

       
        
     

    </div> </body>
</html>