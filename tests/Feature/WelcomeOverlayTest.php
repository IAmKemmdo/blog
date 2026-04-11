<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('homepage redirects to posts index', function () {
    $response = $this->get('/');

    $response->assertRedirect('/posts');
});

test('posts index contains first-visit welcome overlay with theme choice', function () {
    $response = $this->get('/posts');

    $response
        ->assertSuccessful()
        ->assertSee('id="posts-welcome-overlay"', false)
        ->assertSeeText('Witaj')
        ->assertSeeText('Jasny motyw')
        ->assertSeeText('Ciemny motyw')
        ->assertSee('data-theme-choice="light"', false)
        ->assertSee('data-theme-choice="dark"', false)
        ->assertSee('id="posts-content" class="blur-md"', false);
});

test('posts index is not blurred and does not show welcome overlay after first visit', function () {
    $response = $this->withUnencryptedCookies(['welcome_seen' => '1'])->get('/posts');

    $response
        ->assertSuccessful()
        ->assertDontSee('id="posts-welcome-overlay"', false)
        ->assertSee('id="posts-content" class="blur-0"', false);
});
