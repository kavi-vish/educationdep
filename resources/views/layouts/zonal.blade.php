<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonal Director - {{ auth()->user()->zone }} Zone</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .active { background-color: #eff6ff; border-right: 4px solid #2563eb; font-weight: bold; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex">
    <!-- Sidebar -->
    @include('zonal.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1 ml-64">
        <div class="p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>