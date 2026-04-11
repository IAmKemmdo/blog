<!DOCTYPE html>
<html lang="pl" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Lista Postów</title>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col">
    <div id="page-loading-overlay"
        class="pointer-events-none fixed inset-0 z-[100] hidden items-center justify-center bg-white/70 backdrop-blur-sm">
        <div class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-lg">
            <span class="h-5 w-5 animate-spin rounded-full border-2 border-indigo-600 border-t-transparent"></span>
            <span class="text-sm font-medium text-gray-700">Wczytywanie posta...</span>
        </div>
    </div>

    @include('partials.navigation')

    <div class="w-full flex-1">
        {{ $slot }}
    </div>

    @include('partials.footer')

    @vite(['resources/js/app.js'])
</body>

</html>
