<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi VIKOR</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #333;
        }
        nav {
            background-color: #0056b3;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        nav .logo {
            font-size: 1.5rem;
            font-weight: 700;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        nav a:hover {
            color: #cce0ff;
        }
        main {
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 60px); /* Adjust based on nav height */
        }
        .container {
            width: 100%;
            max-width: 1200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f7f6;
            color: #333;
            font-weight: 600;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        input[type="number"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #0056b3;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        button:hover {
            background-color: #004494;
            transform: scale(1.02);
        }
        button:disabled {
            background-color: #aaa;
            cursor: not-allowed;
        }
        .btn-edit {
            background-color: #f0ad4e; /* Edit button color */
            color: white;
        }
        .btn-edit:hover {
            background-color: #ec971f;
        }
        .btn-delete {
            background-color: #d9534f; /* Delete button color */
            color: white;
        }
        .btn-delete:hover {
            background-color: #c9302c;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        /* Label */
        .form-label {
            display: block;
            font-size: 0.875rem; /* 14px */
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        /* Input */
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem; /* 16px */
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-input:focus {
            border-color: #0056b3;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 86, 179, 0.2); /* Blue shadow */
        }
        /* Error Message */
        .form-error {
            margin-top: 0.25rem;
            color: #d9534f; /* Red color for errors */
            font-size: 0.875rem; /* 14px */
        }
        /* Enhanced Select Styles */
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            font-size: 1rem; /* 16px */
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            appearance: none; /* Remove default arrow */
            background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiI+PHBhdGggZD0iTTEyIDBoLTkuMzc1LTEwLjkzNSIgZmlsbD0iIzAwMCIvPjwvc3ZnPg==') no-repeat right 0.75rem center;
            background-size: 1.5rem;
        }
        select:focus {
            border-color: #0056b3;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 86, 179, 0.2); /* Blue shadow */
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">Aplikasi VIKOR</div>
        <div>
            <a href="{{ route('inputdata.index') }}">Input Data</a>
            <a href="{{ route('vikor.index') }}">VIKOR</a>
        </div>
    </nav>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
