<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

uses(RefreshDatabase::class);

test('it renders two unique sidebar ads when at least two ads are available', function () {
    $post = Post::query()->create([
        'title' => 'Post z reklamami',
        'slug' => 'post-z-reklamami',
        'lead' => 'Lead',
        'author' => 'Autor',
        'content' => 'Tresc',
    ]);

    File::shouldReceive('glob')
        ->times(6)
        ->andReturn(
            [
                public_path('images/ads/ad-left.jpg'),
                public_path('images/ads/ad-right.jpg'),
            ],
            [],
            [],
            [],
            [],
            [],
        );

    $response = $this->get(route('posts.show', $post->slug));

    $response->assertSuccessful();
    $response->assertSee(asset('images/ads/ad-left.jpg'), false);
    $response->assertSee(asset('images/ads/ad-right.jpg'), false);

    $content = $response->getContent();

    expect(substr_count($content, asset('images/ads/ad-left.jpg')))->toBe(1);
    expect(substr_count($content, asset('images/ads/ad-right.jpg')))->toBe(1);
});

test('it does not repeat ad when only one ad is available', function () {
    $post = Post::query()->create([
        'title' => 'Post z jedna reklama',
        'slug' => 'post-z-jedna-reklama',
        'lead' => 'Lead',
        'author' => 'Autor',
        'content' => 'Tresc',
    ]);

    File::shouldReceive('glob')
        ->times(6)
        ->andReturn(
            [
                public_path('images/ads/single-ad.jpg'),
            ],
            [],
            [],
            [],
            [],
            [],
        );

    $response = $this->get(route('posts.show', $post->slug));

    $response->assertSuccessful();

    $content = $response->getContent();

    expect(substr_count($content, asset('images/ads/single-ad.jpg')))->toBe(1);
});
