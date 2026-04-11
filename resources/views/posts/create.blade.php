<x-layout>
    <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col max-w-3xl mx-auto my-6 p-6 gap-3 rounded-xl bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
        @csrf

        @if ($errors->any())
            <ul class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-200 p-4 rounded-lg mb-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Tytul</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        @error('title')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Przyjazny adres</label>
        <input type="text" name="slug" value="{{ old('slug') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        @error('slug')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Autor</label>
        <input type="text" name="author" value="{{ old('author') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
        @error('author')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Zajawka</label>
        <textarea name="lead" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('lead') }}</textarea>
        @error('lead')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <label class="text-sm font-medium text-gray-800 dark:text-gray-200">Treść</label>
        <textarea name="content" rows="8" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('content') }}</textarea>
        @error('content')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-indigo-600 text-white px-4 py-3 mt-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">Dodaj</button>
    </form>
</x-layout>
