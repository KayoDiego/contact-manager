<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f5; color: #18181b; }
        .container { max-width: 900px; margin: 0 auto; padding: 24px; }
        .card { background: #fff; border: 1px solid #e4e4e7; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
        .row { display: flex; justify-content: space-between; align-items: center; gap: 12px; }
        .actions { display: flex; gap: 8px; align-items: center; }
        a { color: #0369a1; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .btn { border: 1px solid #d4d4d8; border-radius: 6px; background: #fafafa; padding: 6px 12px; cursor: pointer; }
        .btn-primary { background: #0369a1; color: #fff; border-color: #0369a1; }
        .btn-danger { background: #b91c1c; color: #fff; border-color: #b91c1c; }
        .field { margin-bottom: 12px; }
        .field label { display: block; margin-bottom: 4px; font-weight: 600; }
        .field input { width: 100%; padding: 8px; border: 1px solid #d4d4d8; border-radius: 6px; }
        .text-danger { color: #b91c1c; font-size: 14px; }
        .flash { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 10px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="container">
    <div class="card row">
        <a href="{{ route('contacts.index') }}"><strong>Contact Manager</strong></a>
        <div class="actions">
            @auth
                <span>Logged in as {{ auth()->user()->email }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn" type="submit">Logout</button>
                </form>
            @else
                <a class="btn" href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>

    @if (session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
