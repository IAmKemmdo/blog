<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it stores comment under post', function () {
    $post = Post::query()->create([
        'title' => 'Testowy post',
        'slug' => 'testowy-post',
        'lead' => 'Lead testowy',
        'author' => 'Autor testowy',
        'content' => 'Treść testowa',
    ]);

    $response = $this->post(route('posts.comments.store', $post->slug), [
        'author' => 'Jan Kowalski',
        'email' => 'jan@example.com',
        'content' => 'Super artykuł, dzięki za publikację.',
    ]);

    $response->assertRedirect(route('posts.show', $post->slug).'#comments');

    $this->assertDatabaseHas('comments', [
        'post_id' => $post->id,
        'author' => 'Jan Kowalski',
        'email' => 'jan@example.com',
        'content' => 'Super artykuł, dzięki za publikację.',
    ]);
});

test('it validates comment payload', function () {
    $post = Post::query()->create([
        'title' => 'Walidacja',
        'slug' => 'walidacja-postu',
        'lead' => 'Lead',
        'author' => 'Autor',
        'content' => 'Treść',
    ]);

    $response = $this->from(route('posts.show', $post->slug))
        ->post(route('posts.comments.store', $post->slug), [
            'author' => '',
            'email' => 'nie-email',
            'content' => '',
        ]);

    $response->assertRedirect(route('posts.show', $post->slug));
    $response->assertSessionHasErrors(['author', 'email', 'content']);
    $this->assertDatabaseCount('comments', 0);
});
