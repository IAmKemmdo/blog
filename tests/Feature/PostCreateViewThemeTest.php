<?php

test('create post form has readable dark mode field styles', function () {
    $response = $this->get(route('posts.create'));

    $response
        ->assertSuccessful()
        ->assertSee('name="title"', false)
        ->assertSee('dark:bg-gray-950', false)
        ->assertSee('dark:text-gray-100', false);
});
