<x-layout>
    <div id="posts-content" class="transition-[filter] duration-[3000ms] ease-out blur-md motion-reduce:transition-none">
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Najnowsze Posty</h2>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Odkryj najnowsze artykuły z świata programowania</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <input
                id="posts-search-input"
                type="search"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Szukaj postów..."
                autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            >
        </div>

        <!-- Posts Grid -->
        <div id="posts-grid" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            @forelse ($posts as $post)
                <article
                    data-post-card
                    data-search="{{ Str::lower($post->title.' '.$post->author.' '.($post->lead ?? '').' '.strip_tags($post->content)) }}"
                    class="bg-white dark:bg-gray-900 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border border-transparent dark:border-gray-800">
                    <div class="h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <span class="text-6xl">{{ $post->photo ?? '📝' }}</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            @if ($post->is_published)
                                <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200 text-xs font-semibold rounded-full">
                                    Opublikowany
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200 text-xs font-semibold rounded-full">
                                    Szkic
                                </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 hover:text-indigo-600 cursor-pointer">
                            <a href="{{ route('posts.show', $post->slug) }}" data-loading="post">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                            {{ $post->lead ?? Str::limit(strip_tags($post->content), 150) }}
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-full flex items-center justify-center text-sm font-semibold">
                                    {{ strtoupper(substr($post->author, 0, 2)) }}
                                </div>
                                <span class="text-sm text-gray-700 dark:text-gray-200 font-medium">{{ $post->author }}</span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 dark:text-gray-300 text-lg">Brak postów do wyświetlenia.</p>
                    <a href="/posts/create" class="text-indigo-600 hover:text-indigo-700 font-medium mt-2 inline-block">
                        Dodaj pierwszy post
                    </a>
                </div>
            @endforelse

        </div>

        <div id="posts-no-results" class="hidden text-center py-12">
            <p class="text-gray-500 dark:text-gray-300 text-lg">Brak wyników dla podanego wyszukiwania.</p>
        </div>
        </main>
    </div>

    <div id="posts-welcome-overlay"
        class="pointer-events-none fixed inset-0 z-[90] flex items-center justify-center bg-gray-50/40 dark:bg-black/40 opacity-100 transition-opacity duration-[3000ms] ease-out motion-reduce:transition-none">
        <p class="text-6xl md:text-7xl font-bold tracking-wide text-gray-900 dark:text-white">Witaj</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('posts-welcome-overlay');
            const content = document.getElementById('posts-content');
            const searchInput = document.getElementById('posts-search-input');
            const postCards = Array.from(document.querySelectorAll('[data-post-card]'));
            const noResults = document.getElementById('posts-no-results');

            if (!overlay || !content) {
                return;
            }

            window.requestAnimationFrame(() => {
                overlay.classList.add('opacity-0');
                content.classList.remove('blur-md');
                content.classList.add('blur-0');
            });

            window.setTimeout(() => {
                overlay.remove();
            }, 3100);

            const normalizeText = (value) =>
                value
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');

            const filterPosts = () => {
                if (!searchInput) {
                    return;
                }

                const phrase = normalizeText(searchInput.value.trim());
                let visibleCards = 0;

                postCards.forEach((card) => {
                    const searchableText = normalizeText(card.dataset.search ?? '');
                    const isMatch = phrase === '' || searchableText.includes(phrase);

                    card.classList.toggle('hidden', !isMatch);

                    if (isMatch) {
                        visibleCards += 1;
                    }
                });

                if (noResults) {
                    noResults.classList.toggle('hidden', visibleCards > 0 || phrase === '');
                }
            };

            if (searchInput) {
                searchInput.addEventListener('input', filterPosts);
                filterPosts();
            }
        });
    </script>


</x-layout>
