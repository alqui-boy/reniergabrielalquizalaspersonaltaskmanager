<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #87CEEB, #dff7ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            padding: 32px 28px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.12);
        }
        h1 {
            margin: 0 0 8px;
            text-align: center;
            color: #0f172a;
        }
        p {
            text-align: center;
            margin: 0 0 24px;
            color: #475569;
        }
        .field {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }
        label {
            margin-bottom: 8px;
            color: #1f2937;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 15px;
        }
        .btn {
            width: 100%;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn:hover {
            background: #1d4ed8;
        }
        .signup-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 700;
        }
        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Welcome</h1>
        <p>Sign in to your Task Manager</p>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Login</button>
            <a href="{{ route('register') }}" class="signup-link">Sign Up</a>
        </form>
    </div>
</body>
</html>
