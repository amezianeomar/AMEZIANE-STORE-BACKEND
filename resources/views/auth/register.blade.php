<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ANGEL PROTOCOL INITIATION</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@300;500;700&display=swap');

        body {
            background: linear-gradient(30deg, #050510 0%, #1a1a2e 100%);
            font-family: 'Rajdhani', sans-serif;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            background: rgba(20, 20, 35, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid #00f3ff;
            box-shadow: 0 0 20px rgba(0, 243, 255, 0.2);
            padding: 40px;
            width: 90%;
            max-width: 500px;
            clip-path: polygon(0 0, 100% 0, 100% calc(100% - 30px), calc(100% - 30px) 100%, 0 100%);
            position: relative;
        }

        @media (max-width: 768px) {
            .login-container {
                border: none;
                box-shadow: none;
                width: 100%;
                clip-path: none;
                padding: 20px;
                background: transparent;
            }
        }

        .login-title {
            font-family: 'Orbitron', sans-serif;
            color: #00f3ff;
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #00f3ff;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            background: #0a0a15;
            border: 1px solid #333;
            color: #fff;
            padding: 12px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
            font-family: 'Rajdhani', sans-serif;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #00f3ff;
            box-shadow: 0 0 10px rgba(0, 243, 255, 0.3);
        }

        .btn-login {
            background: #bc13fe;
            color: #fff;
            border: none;
            padding: 15px;
            width: 100%;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            cursor: pointer;
            transition: 0.3s;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #d946ef;
            box-shadow: 0 0 20px rgba(188, 19, 254, 0.6);
            transform: translateY(-2px);
        }

        .invalid-feedback {
            color: #ff0055;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .decorative-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00f3ff, transparent);
        }
        
        .login-link {
            text-align: center; 
            margin-top: 20px; 
            font-size: 14px;
        }
        
        .login-link a {
            color: #bc13fe;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        
        .login-link a:hover {
            color: #d946ef;
            text-shadow: 0 0 10px rgba(188, 19, 254, 0.6);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="decorative-line"></div>
        <h2 class="login-title">ANGEL PROTOCOL INITIATION</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">{{ __('Identity (Name)') }}</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">{{ __('Comms Link (E-Mail)') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">{{ __('Secure Passcode') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">{{ __('Verify Passcode') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-login">
                {{ __('INITIATE UPLOAD') }}
            </button>
            
            <div class="login-link">
                Already an Angel? <a href="{{ route('login') }}">ACCESS MAINFRAME</a>
            </div>
        </form>
    </div>
</body>
</html>
