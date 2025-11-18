<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Search Results - MyMovies</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <style>
    :root {
      --primary-color: #f50a0aff;
      --primary-hover: #f00808ff;
      --secondary-color: #ffffff;
      --background-color: #000000;
      --card-background: #1a1a1a;
      --text-color: #ffffff;
      --text-light: #aaaaaa;
      --font-heading: "Playfair Display", serif;
      --font-body: "Raleway", sans-serif;
      --border-color: var(--primary-color);
      --shadow-glow: 0 0 20px var(--primary-color);
      --button-shadow: 0 0 10px rgba(255, 44, 44, 0.5);
    }

    body {
      font-family: var(--font-body);
      margin: 0;
      padding: 0;
      background-color: var(--background-color);
      color: var(--text-color);
      line-height: 1.6;
    }

    nav.main-nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: var(--card-background);
      border-bottom: 3px solid var(--border-color);
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    }

    .nav-left {
      display: flex;
      align-items: center;
    }

    .nav-logo {
      font-family: var(--font-heading);
      font-size: 2.2em;
      font-weight: 900;
      color: var(--primary-color);
      text-decoration: none;
      margin-right: 30px;
      text-shadow: 0 0 8px var(--primary-color);
      transition: text-shadow 0.3s ease;
    }

    .nav-logo:hover {
      text-shadow: 0 0 15px var(--primary-color),
        0 0 20px rgba(237, 47, 47, 0.8);
    }

    .nav-links {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    .nav-links li {
      margin-right: 25px;
    }

    .nav-links a {
      font-family: var(--font-heading);
      color: var(--text-light);
      text-decoration: none;
      font-weight: 700;
      font-size: 1.15em;
      padding: 10px 0;
      position: relative;
      transition: color 0.3s ease, text-shadow 0.3s ease, transform 0.2s ease;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--primary-color);
      text-shadow: 0 0 5px var(--primary-color);
      transform: translateY(-2px);
    }

    .nav-right {
      display: flex;
      align-items: center;
    }

    .search-form {
      display: flex;
      align-items: center;
      background-color: var(--background-color);
      border-radius: 5px;
      margin-right: 100px;
      overflow: hidden;
      box-shadow: 0 0 5px rgba(249, 106, 23, 0.3);
      transition: box-shadow 0.3s ease;
    }

    .search-form:focus-within {
      box-shadow: 0 0 10px var(--primary-color),
        0 0 15px rgba(255, 215, 0, 0.5);
    }

    .search-form input[type="text"] {
      padding: 10px 15px;
      border: none;
      background-color: transparent;
      color: var(--text-color);
      outline: none;
      font-family: var(--font-body);
      font-size: 1em;
      width: 180px;
    }

    .search-form button {
      padding: 10px 15px;
      border: none;
      background-color: var(--primary-color);
      color: #000;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .search-form button:hover {
      background-color: var(--primary-hover);
      transform: scale(1.05);
    }

    .logout-link {
      font-family: var(--font-heading);
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 700;
      padding: 10px 25px;
      border-radius: 5px;
      border: 2px solid var(--primary-color);
      background-color: transparent;
      transition: all 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .logout-link:hover {
      background-color: var(--primary-color);
      color: #000;
      box-shadow: var(--shadow-glow);
      transform: translateY(-1px);
    }

    .container {
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
    }

    h1 {
      font-family: "Playfair Display", serif;
      color: #f50a0a;
      font-size: 2.5em;
      text-align: center;
    }

    .section {
      margin-top: 40px;
    }

    .section h2 {
      color: #f50a0a;
      font-family: "Playfair Display", serif;
      font-size: 1.8em;
      margin-bottom: 20px;
    }

    .movies-grid {
      display: flex;
      flex-wrap: wrap;
      padding: 50px;
      gap: 30px;
      
    }

    /* 🎬 Enhanced Movie Card */
    .movie-card {
      position: relative;
      width: 250px;
      height: 380px;
      border-radius: 15px;
      overflow: hidden;
      background: #111;
      cursor: pointer;
      transition: transform 0.4s ease, box-shadow 0.4s ease;
      box-shadow: 0 0 10px rgba(245, 10, 10, 0.2);
    }

    .movie-card:hover {
      transform: scale(1.07) translateY(-8px);
      box-shadow: 0 0 25px rgba(240, 227, 227, 0.6);
    }

    .movie-card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(80%);
      transition: all 0.3s ease;
    }

    .movie-card:hover img {
      filter: brightness(50%) blur(0px);
      transform: scale(1.1);
    }

    .movie-title {
      position: absolute;
      bottom: 0;
      width: 100%;
      padding: 15px;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.85));
      color: #fff;
      text-align: center;
      font-weight: 700;
      font-size: 1.1em;
      font-family: "Playfair Display", serif;
      letter-spacing: 1px;
      transition: color 0.3s ease;
    }

    .movie-card:hover .movie-title {
      color: var(--primary-color);
    }

    .movie-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(120deg, transparent, rgba(245, 10, 10, 0.25), transparent);
      transition: all 0.6s ease;
    }

    .movie-card:hover::before {
      left: 100%;
    }

    .no-results {
      text-align: center;
      font-size: 1.5em;
      color: #bbb;
      margin-top: 50px;
    }

  </style>
</head>
<body>
  <nav class="main-nav">
    <div class="nav-left">
      <a href="{{ route('userdash') }}" class="nav-logo">MyMovies</a>
      <ul class="nav-links">

        <li><a href="{{ route('allmovies') }}">Movies</a></li>
        <li><a href="{{ route('alltvshows') }}">Tv Shows</a></li>
        <li><a href="{{ route('yourwatchlist') }}">Watch List</a></li>
      </ul>
    </div>
    <div class="nav-right">
      <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Search movies..." />
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>

      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <a href="{{ route('logout') }}" class="logout-link"
           onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
      </form>
    </div>
  </nav>

  <div class="container">
    <h1>Search Results for "{{ $query }}"</h1>

    @if($movies->count() === 0 && $tvShows->count() === 0)
      <p class="no-results">No results found.</p>
    @else

      @if($movies->count() > 0)
      <div class="section">
        <h2>Movies</h2>
        <div class="movies-grid">
          @foreach($movies as $movie)
          <a href="{{ route('moviecard', $movie->id) }}">
            <div class="movie-card">
              <img src="{{ $movie->poster_url ?? 'https://th-i.thgim.com/public/incoming/wmujms/article70092693.ece/alternates/LANDSCAPE_1200/HBD_OG_LOCK%20copy.jpg' }}" alt="{{ $movie->title }}">
              <div class="movie-title">{{ $movie->title }}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif

      @if($tvShows->count() > 0)
      <div class="section">
        <h2>TV Shows</h2>
        <div class="movies-grid">
          @foreach($tvShows as $tv_show)
          <a href="{{ route('tvshowcard', $tv_show->id) }}">
            <div class="movie-card">
              <img src="{{ $tv_show->poster_url ?? 'https://th-i.thgim.com/public/incoming/wmujms/article70092693.ece/alternates/LANDSCAPE_1200/HBD_OG_LOCK%20copy.jpg' }}" alt="{{ $tv_show->title }}">
              <div class="movie-title">{{ $tv_show->title }}</div>
            </div>
          </a>
          @endforeach
        </div>
      </div>
      @endif

    @endif
  </div>
</body>
</html>
