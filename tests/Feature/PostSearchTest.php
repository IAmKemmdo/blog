<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it filters posts by search phrase', function () {
    Post::query()->create([
        'title' => 'Laravel routes guide',
        'slug' => 'laravel-routes-guide',
        'lead' => 'Routing basics',
        'author' => 'Jan',
        'content' => 'Opis tras i middleware',
    ]);

    Post::query()->create([
        'title' => 'React komponenty',
        'slug' => 'react-komponenty',
        'lead' => 'Frontend wpis',
        'author' => 'Anna',
        'content' => 'Stan i propsy',
    ]);

    $response = $this->get(route('posts.index', ['search' => 'Laravel']));

    $response
        ->assertSuccessful()
        ->assertSeeText('Laravel routes guide')
        ->assertDontSeeText('React komponenty');
});

test('it no longer shows categories filter on posts index', function () {
    $response = $this->get(route('posts.index'));

    $response
        ->assertSuccessful()
        ->assertDontSeeText('Wszystkie kategorie')
        ->assertSee('name="search"', false)
        ->assertDontSee('type="submit"', false)
        ->assertSee('id="theme-toggle"', false);
});
