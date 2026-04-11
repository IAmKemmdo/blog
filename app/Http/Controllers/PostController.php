<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $posts = Post::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($postQuery) use ($search) {
                    $likeSearch = "%{$search}%";

                    $postQuery
                        ->where('title', 'like', $likeSearch)
                        ->orWhere('lead', 'like', $likeSearch)
                        ->orWhere('content', 'like', $likeSearch)
                        ->orWhere('author', 'like', $likeSearch);
                });
            })
            ->latest()
            ->get();

        return view('posts.index', [
            'posts' => $posts,
            'search' => $search,
        ]);
    }

    public function show(string $slug)
    {
        $selectedAds = collect(['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'])
            ->flatMap(fn (string $extension): array => File::glob(public_path("images/ads/*.{$extension}")))
            ->unique()
            ->map(fn (string $path): string => asset('images/ads/'.basename($path)))
            ->shuffle()
            ->take(2)
            ->values();

        $post = Post::query()
            ->where('slug', $slug)
            ->with([
                'comments' => fn ($query) => $query->latest(),
            ])
            ->firstOrFail();

        return view('posts.show', [
            'post' => $post,
            'leftAd' => $selectedAds->get(0),
            'rightAd' => $selectedAds->get(1),
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $parameters = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
            'lead' => ['nullable', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $post = new Post;

        $post->title = $parameters['title'];
        $post->slug = $parameters['slug'];
        $post->lead = $parameters['lead'] ?? null;
        $post->author = $parameters['author'];
        $post->content = $parameters['content'];

        // Post::create($parameters);

        $post->save();

        return redirect()->route('posts.index');
    }
}
