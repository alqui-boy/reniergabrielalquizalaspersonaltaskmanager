<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #d9f99d, #7dd3fc);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .auth-card {
            width: 100%;
            max-width: 480px;
            background: rgba(255,255,255,0.96);
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
            padding: 36px 28px;
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
            font-weight: 600;
            color: #1f2937;
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
            background: #16a34a;
            color: white;
            border: 0;
            border-radius: 10px;
            padding: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }
        .btn:hover { background: #15803d; }
        .link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 600;
        }
        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 6px;
        }
        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1>Create Account</h1>
        <p>Register to continue to your task dashboard</p>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="field">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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

            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Register</button>
            <a class="link" href="{{ route('login') }}">Already have an account? Login</a>
        </form>
    </div>
</body>
</html>
