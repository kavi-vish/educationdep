<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant - ESDFP System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        @include('accountant.partials.sidebar')
        <div class="flex-1 ml-64 p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>