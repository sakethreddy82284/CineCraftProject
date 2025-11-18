<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/flash.css') }}">

    <title>Movie Details - Professional</title>
    
    <style>
          :root {
            /* NEW: Color Theme (Black & Gold) */
            --primary-color: #f50a0aff; /* Gold */
            --primary-hover: #f00808ff; /* Darker Gold */
            --secondary-color: #FFFFFF;
            
            --background-color: #000000; 
            --card-background: #1a1a1a; 
            
            --text-color: #ffffff; 
            --text-light: #aaaaaa; 
            
            /* NEW: Font Theme */
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Raleway', sans-serif;
            
            --border-color: var(--primary-color); 
            --shadow-glow: 0 0 20px var(--primary-color);
            /* NEW: Gold RGBA */
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
            border-bottom: 3px solid var(--border-color); /* Gold border */
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        }
        .nav-left { display: flex; align-items: center; }
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
            /* Gold glow */
            text-shadow: 0 0 15px var(--primary-color), 0 0 20px rgba(237, 47, 47, 0.8);
        }
        .nav-links { list-style: none; margin: 0; padding: 0; display: flex; }
        .nav-links li { margin-right: 25px; }

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
            content: '';
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

        .nav-right { display: flex; align-items: center; }

        /* Search Bar */
        .search-form {
            display: flex;
            align-items: center;
            background-color: var(--background-color);
            border-radius: 5px;
            /* border: none; (Kept from previous) */
            margin-right: 100px;
            overflow: hidden;
            /* Gold glow */
            box-shadow: 0 0 5px rgba(249, 106, 23, 0.3);
            transition: box-shadow 0.3s ease;
        }
        .search-form:focus-within {
            /* Gold glow */
            box-shadow: 0 0 10px var(--primary-color), 0 0 15px rgba(255, 215, 0, 0.5);
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
        .search-form input[type="text"]::placeholder { color: var(--text-light); }

        .search-form button {
            padding: 10px 15px;
            border: none;
            background-color: var(--primary-color);
            color: #000; /* Black text for contrast */
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .search-form button:hover {
            background-color: var(--primary-hover);
            transform: scale(1.05);
        }

        /* Logout Button */
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
            color: #000; /* Black text */
            box-shadow: var(--shadow-glow);
            transform: translateY(-1px);
        }
        .logout-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.2);
            transform: skewX(-20deg);
            transition: left 0.5s ease;
        }
        .logout-link:hover::before { left: 100%; }
    
      
        /* --- Basic Page Setup --- */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #1a1a1a; /* Dark background */
            margin: 0;
            padding: 0;
            color: #d1d1d1;
        }

    
 
     
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, 
                rgba(18, 18, 18, 0.9) 15%, 
                rgba(18, 18, 18, 0.7) 40%, 
                rgba(18, 18, 18, 0.1) 70%,
                transparent 100%
            );
        }

        /* =========================================================
         2. UPGRADED: STAGGERED ANIMATIONS
        =========================================================
        */
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 50%;
            color: #ffffff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
            
            /* --- NEW --- */
            /* This pushes the content down below the floating nav */
            padding-top: 80px; 
        }

        /* --- Animation Base --- */
        /* All child elements will start transparent and animate in */
        .hero-content > * {
            opacity: 0; /* Start hidden */
            animation: fadeInContent 0.8s ease-out forwards;
        }

        @keyframes fadeInContent {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin: 0 0 20px 0;
            
            /* --- NEW: Staggered Delay --- */
            animation-delay: 0.2s;
        }

        .hero-content .synopsis {
            font-size: 1rem;
            line-height: 1.7;
            color: #e0e0e0;
            margin-bottom: 30px;
            max-width: 85%;
            
            /* --- NEW: Staggered Delay --- */
            animation-delay: 0.4s;
        }

        /* --- NEW: Metadata Group --- */
        /* This group lets us animate the two items together */
        .meta-group {
            display: flex;
            align-items: center;
            gap: 25px; /* Space between items */
            margin-bottom: 10px; /* Reduced margin */
            
            /* --- NEW: Staggered Delay --- */
            animation-delay: 0.6s;
        }

        .hero-content .release {
            font-size: 1rem;
            font-weight: 600;
            color: #c0c0c0;
            margin: 0; /* Remove default margins */
        }

        .hero-content .rating {
            display: inline-block;
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            background-color: #ff4d4d;
            padding: 6px 14px;
            border-radius: 20px;
            margin: 0; /* Remove default margins */
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            
            /* --- NEW: Subtle Polish --- */
            border: 1px solid rgba(255, 100, 100, 0.8);
        }

        /* =========================================================
         3. UPGRADED: PROFESSIONAL BUTTON GROUP
        =========================================================
        */
        
        /* --- NEW: Button Group --- */
        /* This group holds both buttons and animates them */
        .hero-button-group {
            display: flex;
            gap: 15px;
            margin-top: 35px; /* Added margin-top */
            
            /* --- NEW: Staggered Delay --- */
            animation-delay: 1.2s; /* Delayed this */
        }
        
        /* --- Primary Button (Play) --- */
        .hero-button {
            background-color: #ffffff;
            color: #1a1a1a;
            border: 2px solid #ffffff;
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .hero-button:hover {
            background-color: #ff4d4d; /* --- NEW: Hover changes to brand color --- */
            border-color: #ff4d4d;
            color: #ffffff;
            transform: scale(1.05) translateY(-2px); /* Pop effect */
            box-shadow: 0 8px 20px rgba(0,0,0,0.3); /* Bigger shadow */
        }
        
        /* --- NEW: Secondary Button (Watchlist) --- */
        .hero-button-secondary {
            background-color: rgba(100, 100, 100, 0.2); /* "Glass" effect */
            color: #ffffff;
            border: 2px solid rgba(255, 255, 255, 0.5); /* Fainter border */
            border-radius: 8px;
            padding: 12px 28px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px); /* Cool glass-blur effect */
        }
        
        .hero-button-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
            transform: scale(1.05) translateY(-2px);
        }
        
        /* --- NEW: Awards List Styling --- */
        .awards-list {
            animation-delay: 0.8s; /* Staggered delay */
        }
        .awards-list h4 {
            margin: 20px 0 10px 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #aaa;
        }
        .awards-list ul {
            list-style: none;
            padding-left: 0;
            color: #ddd;
            line-height: 1.6;
            margin: 0;
        }

        /* --- 2. Review Form Section (Unchanged) --- */
        .review-section {
            padding: 40px;
            display: grid;
            place-items: center;
        }
        
        .review-form-card {
            background-color: #282828;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 24px 32px;
            width: 100%;
            max-width: 700px;
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .review-form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .review-form-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #ffffff;
            text-align: center;
        }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.85rem;
            color: #b0b0b0;
        }

        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #444;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            background-color: #3a3a3a;
            color: #e0e0e0;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0099ff;
            box-shadow: 0 0 0 3px rgba(0, 153, 255, 0.25);
        }
        textarea { resize: vertical; min-height: 80px; }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 2px;
        }
        .star-rating input[type="radio"] { display: none; }
        .star-rating label {
            font-size: 1.75rem;
            color: #444;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .star-rating:hover label { color: #ffc107; }
        .star-rating label:hover ~ label { color: #444; }
        .star-rating input[type="radio"]:checked ~ label { color: #ffc107; }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }
        .submit-btn:hover {
            background-color: #e60000;
            transform: translateY(-2px);
        }

        /* --- Responsive (Mobile) --- */
        @media (max-width: 768px) {
            header.main-nav {
                padding: 15px;
                flex-direction: column;
                gap: 10px;
                position: relative; /* Don't float on mobile */
                background-color: #282828; /* Solid on mobile */
            }

            .movie-hero-section {
                min-height: 70vh;
                padding: 20px !important;
            }
            
            .hero-overlay {
                background: linear-gradient(to right, 
                    rgba(18, 18, 18, 0.9) 30%, 
                    rgba(18, 18, 18, 0.7) 70%,
                    rgba(18, 18, 18, 0.1) 100%
                );
            }
            .hero-content {
                max-width: 100%;
                padding-top: 0;     
            }
            .hero-content h1 { font-size: 2.5rem; }
            .hero-content .synopsis { font-size: 0.85rem; max-width: 100%; }

            .hero-button-group {
                flex-direction: column;
                width: 100%;
            }
            .hero-button, .hero-button-secondary {
                text-align: center;
            }

            .review-section { padding: 20px; }
            .review-form-card { padding: 20px; }
        }
        .awards{
            display: flex;
            flex-direction: row;
        }
           .type{
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
        
        .movies_card{
            display: flex;
            flex-direction: row;
            gap: 30px;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap; /* Prevents wrapping */
            scroll-behavior: smooth; /* For button clicks */
            padding: 30px 10px; /* Add padding so hover effect isn't cut off */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
         /* NEW: Hide scrollbar for Chrome, Safari, Opera */
        .movies_card::-webkit-scrollbar {
            display: none;
        }

        /* NEW: Ensure movie cards don't shrink */
        .movie_card {
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }
        .movie_card:hover {
            transform: scale(1.05);
        }

       .movie_img {
              height: 300px;
             width: 220px;
              border-radius: 15px;
              display: block;
              transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .movie_img:hover {
            transform: scale(1.05); 
            box-shadow: 0 0 15px rgba(237, 120, 47, 0.7);
            z-index: 10;
            border-radius: 15px;

         }
     
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(calc(-50% - 5px));
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.6);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 50%;
            width: 45px;
            height: 45px;
            font-size: 1.2em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(237, 120, 47, 0.5);
        }
        .scroll-btn:hover {
            background-color: var(--primary-color);
            color: #000;
            box-shadow: var(--shadow-glow);
        }
        .scroll-btn.left {
            left: -30px;
            margin-right: 40px; 
        }
        .scroll-btn.right {
            right: -20px; 
        }
        .cast{
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
    /* NEW: Removed shadow */
    text-shadow: none;
}
.view-more-link:hover {
    color: var(--primary-color); /* Hovers to gold */
    /* NEW: Reduced glow */
    text-shadow: 0 0 8px var(--primary-color);
    transform: translateX(5px);
}
.view-more-link i {
    margin-left: 5px;
    font-size: 0.9em;
}

        .reviews-container {
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            font-size: 1.5em; /* Smaller title */
            color: #E50914;
            text-align: center;
            margin-bottom: 20px; /* Reduced margin */
            padding-bottom: 5px; /* Reduced padding */
            border-bottom: 1px solid #E50914;
        }
        .review-card {
            background-color: #111111;
            border-radius: 5px;
            padding: 12px; /* Reduced padding */
            margin-bottom: 15px; /* Reduced margin */
            border: 1px solid #222;
        }
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px; /* Reduced margin */
            padding-bottom: 5px; /* Reduced padding */
            border-bottom: 1px solid #333;
        }
        .review-rating {
            font-size: 1.1em; /* Smaller font */
            font-weight: bold;
        }
        .review-type {
            font-size: 1em; /* Smaller font */
            font-weight: bold;
            text-transform: uppercase;
            color:red;
        }
        .review-text {
            font-size: 1em; /* Smaller font */
            color: #cccccc;
            line-height: 1.4; /* Tighter line height */
            font-style: italic;
            margin: 0; /* Removed default p margin */
        }

        /* --- Theme Logic --- */
        .review-card.rotten {
            border-left: 4px solid #E50914;
        }
        .review-card.rotten .review-type {
            color: #E50914;
        }
        .review-card.fresh {
            border-left: 4px solid #ffffff;
        }
        .review-card.fresh .review-type {
            color: #ffffff;
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
    .flash-message {
    padding: 12px 18px;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 16px;
    font-weight: 600;
    animation: fadeIn 0.3s ease-in-out;
}

.flash-message.success {
    background-color: #16a34a; /* Green */
    color: white;
}

.flash-message.error {
    background-color: #dc2626; /* Red */
    color: white;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0px);
    }
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
                <a href="{{ route('logout') }}"
                   class="logout-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                   Logout
                </a>
            </form>
        </div>
    </nav>

  

    <main>

        <section class="movie-hero-section" style="
    position: relative; 
    min-height: 87vh; 
    display: flex; 
    align-items: center; 
    padding: 50px; 
    /* NOTE: No margin-top needed */
    box-sizing: border-box; 
    background-image: url('https://th-i.thgim.com/public/incoming/wmujms/article70092693.ece/alternates/LANDSCAPE_1200/HBD_OG_LOCK%20copy.jpg'); 
    background-size: cover; 
    background-position: center center;
  "
>
            <div class="hero-overlay"></div>
            
            <div class="hero-content">
                <h1>{{ $movie->title }}</h1>
                
                <p class="synopsis">
                    {{ $movie->synopsis }}
                </p>
                

                <div class="meta-group">
                   Release:{{ $movie->release_date ? $movie->release_date->format('M j, Y') : 'Not Available' }}
                    <p class="rating">
                        Tomatometer: {{ $movie->tomatometer_score}}%
                    </p>
                </div>
           
                <div class="awards-list">
                    <h4>Awards</h4>
                    <ul class="awards">
                        
                        @forelse($awards as $award)
                            <li>{{ $award->awardname }} , </li>
                        @empty
                            <li style="color: #888;">No awards listed.</li>
                        @endforelse
                    </ul>
                </div> 
                       
                <div class="hero-button-group">
                    <a href="#" class="hero-button">
                        PLAY ▷
                    </a>

                    
                    @if ($status==1)
                     <form action="{{ route('watchlistdelete', $movie->id) }}" method="POST" style="display:inline;">
                             @csrf
                             @method('DELETE')
                            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                            <button type="submit" class="hero-button-secondary" style="background-color: #e60000;">
                                REMOVE FROM WATCHLIST
                            </button>
                      </form>
                    @endif
                    @if ($status==0)
                     <form action="{{ route('watchliststore', $movie->id) }}" method="POST" style="display:inline;">
                         @csrf
                         <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                         <button type="submit" class="hero-button-secondary">
                           + ADD TO WATCHLIST
                          </button>
                     </form>
                    @endif
                   
                </div>
            </div>
        </section>
           <section>
          <div>
                <div class="type">
                     <div class="cast">
                           <h1 class="typeh1">Related Movies</h1>
                     </div>
                    <div class="movie-slider-wrapper">
                        <button id="scroll-left" class="scroll-btn left"><i class="fas fa-chevron-left"></i> </button>
                           <div class="movies_card">
                              @foreach ($samecastmovies as $mo)
                                 <a href="{{ route('moviecard',$mo->id) }}">
                                      <div class="movie-card">
                                           <img src="https://th-i.thgim.com/public/incoming/wmujms/article70092693.ece/alternates/LANDSCAPE_1200/HBD_OG_LOCK%20copy.jpg"  alt="Movie Poster"/>
                                            <div class="movie-title">{{ $mo->title }}</div>
                                        </div>
                                 </a>
                             @endforeach
                           </div>
                       <button id="scroll-right" class="scroll-btn right">
                                     <i class="fas fa-chevron-right"></i>
                        </button>

                    </div>
                </div>
          </div>
     </section>


        <section class="review-section" id="review-form">
            <div class="review-form-card">
                 <form action="{{ route("postreview") }}" method="POST">
                    @csrf
                    
                    <h2>Add Your Review</h2>
                    
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">

                    <div class="form-group">
                        <label>Your Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="5 stars">★</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars">★</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars">★</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars">★</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star">★</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type">Your Verdict</label>
                        <select id="type" name="type" required>
                            <option value="" disabled selected>Choose...</option>
                            <option value="fresh">Fresh</option>
                            <option value="rotten">Rotten</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="review_text">Your Review</label>
                        <textarea id="review_text" name="review_text" rows="5" 
                                placeholder="Share your thoughts on the movie..."></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn">Post Review</button>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="reviews-container">
        <h2>All Reviews</h2>
         @if ($reviews->isEmpty())
            <p style="text-align:center; color:#aaa;">No reviews yet. Be the first to review this movie!</p>
        @else
        @foreach ($reviews as $review)
        <div class="review-card">
           <div class="review-header">
              <span class="review-rating">Rating: {{ $review->rating ?? 'N/A' }}</span>
              <span class="review-type">{{ $review->type ?? 'Unknown' }}</span>
           </div>
            <p class="review-text">{{ $review->review_text ?? 'No review text available.' }}</p>
         </div>
         
        @endforeach
        @endif




    </div>
        </section>

    </main>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.movies_card');
            const scrollLeftBtn = document.getElementById('scroll-left');
            const scrollRightBtn = document.getElementById('scroll-right');

            if (slider && scrollLeftBtn && scrollRightBtn) {
                
                const scrollAmount = 230 + 30; 

                scrollLeftBtn.addEventListener('click', () => {
                    slider.scrollLeft -= scrollAmount;
                });

                scrollRightBtn.addEventListener('click', () => {
                    slider.scrollLeft += scrollAmount;
                });
            }
        });
     </script>
</body>
</html>