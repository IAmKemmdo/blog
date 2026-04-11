<!DOCTYPE html>
<html lang="pl" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Lista Postów</title>

    <script>
        (() => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const shouldUseDark = savedTheme === 'dark' || (!savedTheme && prefersDark);

            document.documentElement.classList.toggle('dark', shouldUseDark);
        })();
    </script>

    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex flex-col bg-gray-50 text-gray-900 dark:bg-black dark:text-white transition-colors">
    <div id="page-loading-overlay"
        class="pointer-events-none fixed inset-0 z-[100] hidden items-center justify-center bg-white/70 dark:bg-black/70 backdrop-blur-sm">
        <div class="flex items-center gap-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 shadow-lg">
            <span class="h-5 w-5 animate-spin rounded-full border-2 border-indigo-600 border-t-transparent"></span>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Wczytywanie posta...</span>
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
