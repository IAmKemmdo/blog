    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-950 shadow-sm border-b border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        📝 Blog
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('posts.index') }}"
                        class="text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('posts.create') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                        Nowy Post
                    </a>
                    <button
                        id="theme-toggle"
                        type="button"
                        aria-label="Przełącz motyw"
                        class="inline-flex items-center justify-center h-10 w-10 rounded-md border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    >
                        <svg id="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5 dark:hidden" aria-hidden="true">
                            <path d="M12.004 2.25a.75.75 0 0 1 .75.75 8.25 8.25 0 0 0 8.25 8.25.75.75 0 0 1 0 1.5 8.25 8.25 0 1 0-8.25 8.25.75.75 0 0 1 0 1.5C6.342 22.5 1.5 17.658 1.5 11.25S6.342 0 12.754 0a.75.75 0 0 1 .75.75Z" />
                        </svg>
                        <svg id="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="hidden h-5 w-5 dark:block" aria-hidden="true">
                            <path d="M12 2.25a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75Zm0 15a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm9-4.5a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75Zm-15 0a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75Zm11.303 6.553a.75.75 0 0 1 0 1.06l-1.06 1.061a.75.75 0 0 1-1.061-1.06l1.06-1.061a.75.75 0 0 1 1.061 0Zm-9.546 0a.75.75 0 0 1 1.061 0l1.06 1.061a.75.75 0 0 1-1.06 1.06L7.757 20.364a.75.75 0 0 1 0-1.06Zm9.546-14.606a.75.75 0 0 1 0 1.06l-1.06 1.061a.75.75 0 1 1-1.061-1.06l1.06-1.061a.75.75 0 0 1 1.061 0Zm-9.546 0a.75.75 0 0 1 1.061 0l1.06 1.061a.75.75 0 1 1-1.06 1.06L7.757 5.757a.75.75 0 0 1 0-1.06ZM12 19.5a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 12 19.5Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
