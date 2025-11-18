<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyMovies</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Raleway:wght@400;700&display=swap"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />

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

    .nav-links a::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 0;
      height: 2px;
      background-color: var(--primary-color);
      transition: width 0.3s ease-out;
    }

    .nav-links a:hover::after,
    .nav-links a.active::after {
      width: 100%;
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

    .search-form input[type="text"]::placeholder {
      color: var(--text-light);
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

    .logout-link::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.2);
      transform: skewX(-20deg);
      transition: left 0.5s ease;
    }

    .logout-link:hover::before {
      left: 100%;
    }

    .type {
      padding: 5px 60px;
      position: relative;
    }

    .typeh1 {
      font-family: "Playfair Display", Georgia, "Times New Roman", serif;
      font-size: 2.2rem;
      font-weight: 400;
      color: #e4dfdfff;
    }

    .movie-slider-wrapper {
      position: relative;
    }

    .movies_card {
      display: flex;
      flex-direction: row;
      justify-content: center;
      flex-wrap: wrap;
      gap: 100px;
      padding: 50px;
      white-space: nowrap;
      scroll-behavior: smooth;
      scrollbar-width: none;
     
    }

    .movies_card::-webkit-scrollbar {
      display: none;
    }

  
    
    .cast {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    .view-more-link {
      display: inline-block;
      margin-top: 35px;
      margin-right: 45px;
      font-family: var(--font-heading);
      color: var(--secondary-color);
      text-decoration: none;
      font-weight: 700;
      font-size: 1.5em;
      transition: all 0.3s ease;
      text-shadow: none;
    }

    .view-more-link:hover {
      color: var(--primary-color);
      text-shadow: 0 0 8px var(--primary-color);
      transform: translateX(5px);
    }

    .view-more-link i {
      margin-left: 5px;
      font-size: 0.9em;
    }

   
        .movie-card {
      position: relative;
      width: 250px;
      height: 340px;
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
    .pagination {
  display: inline-flex;
  gap: 10px;
}

.pagination {
  display: inline-flex;
  gap: 12px;
  list-style: none;
  padding: 0;
}

.pagination .page-item .page-link {
  padding: 10px 18px;
  background: #111;
  border: 2px solid #f50a0a;
  color: #fff;
  font-weight: 600;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.3s ease;
}

.pagination .page-item .page-link:hover {
  background: #f50a0a;
  color: #000;
  box-shadow: 0 0 12px rgba(245, 10, 10, 0.8);
  transform: translateY(-2px);
}

.pagination .page-item.active .page-link {
  background: #f50a0a;
  border-color: #f50a0a;
  color: #000;
  box-shadow: 0 0 15px rgba(245, 10, 10, 1);
}

.pagination .page-item.disabled .page-link {
  opacity: 0.4;
  cursor: not-allowed;
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
        <a
          href="{{ route('logout') }}"
          class="logout-link"
          onclick="event.preventDefault(); this.closest('form').submit();"
          >Logout</a
        >
      </form>
    </div>
  </nav>

  <section>
    <div>
      <div class="type">
        <div class="cast">
          <h1 class="typeh1">Tv Shows</h1>
         
        </div>
        <div class="movie-slider-wrapper">
          
          <div class="movies_card">
                  @foreach ($movies as $tv_show)
                    <a href="{{ route('moviecard', $tv_show->id) }}">
                      <div class="movie-card">
                            <img src="https://th-i.thgim.com/public/incoming/wmujms/article70092693.ece/alternates/LANDSCAPE_1200/HBD_OG_LOCK%20copy.jpg" alt="TV Show Poster"/>
                            <div class="movie-title">{{ $tv_show->title }}</div>
                      </div>
                     </a>
                  @endforeach
                 
        </div>
         <div style="margin-top: 30px; text-align: center;">
                   {{ $movies->links('pagination::bootstrap-5') }}
         </div>

    
        </div>
      </div>
    </div>
  </section>

  
</body>
</html>
