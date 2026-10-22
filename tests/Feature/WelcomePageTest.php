<?php

test('the welcome page renders', function (): void {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('data-testid="welcome-main"', escape: false)
        ->assertSee('data-testid="welcome-heading"', escape: false)
        ->assertSee('data-testid="welcome-body"', escape: false);
});

test('the welcome page reports the runtime actually serving it', function (): void {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(PHP_VERSION)
        ->assertSee(app()->version());
});

test('the health check answers', function (): void {
    $this->get('/up')->assertOk();
});
