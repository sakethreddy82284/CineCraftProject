<!DOCTYPE html>
<html>
<head>
    <title>Login/Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- Root Variables for Colors --- */
        :root {
            --primary-red: #e50914;
            --dark-bg: #141414;
            --darker-bg: #000000;
            --card-bg: #1f1f1f;
            --text-light: #f5f5f5;
            --text-muted: #aaa;
            --border-color: #333;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--dark-bg);
        
            background-image: radial-gradient(circle, #2a2a2a, var(--darker-bg));
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main-container {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        
        .button-toggle-container {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .toggle-btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background-color: transparent;
            color: var(--text-muted);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .toggle-btn:hover {
            color: var(--text-light);
        }

        .toggle-btn.active {
             background-color: var(--primary-red);
             color: white;
             box-shadow: 0 0 15px rgba(229, 9, 20, 0.5);
        }

        .form-container {
            background-color: var(--card-bg);
            padding: 30px 35px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        #loginform {
            display: none;
        }

        .form-container h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 700;
            color: var(--primary-red);
            text-shadow: 0 0 5px rgba(229, 9, 20, 0.5);
        }

        .form-container div {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Unique Input Field Style --- */
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 2px solid var(--border-color);
            color: var(--text-light);
            font-size: 16px;
            padding: 10px 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container input:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 5px 10px -5px rgba(229, 9, 20, 0.4);
        }


        .form-container button[type="submit"] {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 6px;
            background-color: var(--primary-red);
            color: white;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #c00; /* Darker red on hover */
            box-shadow: 0 0 20px rgba(229, 9, 20, 0.6);
        }
        
        /* --- Success Message --- */
        .success-message {
            margin-top: 15px;
            color: #fff; /* Bright white for contrast */
            font-weight: 600;
            background-color: rgba(40, 167, 69, 0.2);
            border: 1px solid rgba(40, 167, 69, 0.5);
            padding: 10px;
            border-radius: 4px;
        }
        .login-error {
          color: #D8000C; /* A strong red color */
          font-family: sans-serif;
          font-size: 14px;
          margin-top: 5px; /* Adds a little space above the message */
      }
    </style>
</head>
<body>
    <?php
     
    ?>
    <div class="main-container">
        <div class="button-toggle-container">
            <button id="loginButton" class="toggle-btn">Login</button>
             <button id="registerButton" class="toggle-btn">Register</button>
        </div>

        <div id="registerform" class="form-container">
            <h2>Create Account</h2>
            <form action="{{ route('register.store')}}" method="post">
                @csrf
                <div>
                    <label>Username</label>
                    <input type="text" name="name" placeholder="Choose a username" >
                </div>
                @error('name')
                    <div class="login-error">{{ $message }}</div>
              @enderror
                <div>
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email"  required>
                </div>
                @error('email')
                    <div class="login-error">{{ $message }}</div>
              @enderror

                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a secure password" required>
                </div>
                @error('password')
                    <div class="login-error">{{ $message }}</div>
              @enderror
                <button type="submit">Sign Up</button>
            </form>
           @if (session('success'))
               <p class="success-message">Registration Successful!</p>
           @endif
        </div>

        <div id="loginform" class="form-container">
            <h2>Sign In</h2>
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div>
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit">Sign In</button>
              @error('email')
                    <div class="login-error">{{ $message }}</div>
              @enderror
            </form>
        </div>
    </div>

    <script>
      
        const loginButton = document.getElementById('loginButton');
        const registerButton = document.getElementById('registerButton');
        const loginFormDiv = document.getElementById('loginform');
        const registerFormDiv = document.getElementById('registerform');

        loginButton.addEventListener('click', function() {
            loginFormDiv.style.display = 'block';
            registerFormDiv.style.display = 'none';
            loginButton.classList.add('active');
            registerButton.classList.remove('active');
        });

        registerButton.addEventListener('click', function() {
            registerFormDiv.style.display = 'block';
            loginFormDiv.style.display = 'none';
            registerButton.classList.add('active');
            loginButton.classList.remove('active');
        });

    
        document.addEventListener('DOMContentLoaded', function() {
            
            registerFormDiv.style.display = 'none';
            loginFormDiv.style.display = 'block';
            loginButton.classList.add('active');
        });
    </script>
</body>
</html>