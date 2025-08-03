<!DOCTYPE html>
<html lang="pt-br" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            width: 100%;
        }
    </style>
</head>
<body class="m-0 p-0 w-full">
    @yield('content')
</body>
</html>
