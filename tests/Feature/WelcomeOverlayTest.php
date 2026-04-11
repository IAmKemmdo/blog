<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('homepage redirects to posts index', function () {
    $response = $this->get('/');

    $response->assertRedirect('/posts');
});

test('posts index contains welcome overlay and blurred content', function () {
    $response = $this->get('/posts');

    $response
        ->assertSuccessful()
        ->assertSee('id="posts-welcome-overlay"', false)
        ->assertSeeText('Witaj')
        ->assertSee('id="posts-content" class="transition-[filter] duration-[2200ms] ease-out blur-md motion-reduce:transition-none"', false);
});
