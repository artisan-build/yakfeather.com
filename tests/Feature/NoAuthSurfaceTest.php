<?php

// Fortify ships with the starter kit but is switched off: every feature is removed in
// config/fortify.php and AppServiceProvider calls Fortify::ignoreRoutes(). These assert OUR
// decision that the app exposes no account surface, not anything Fortify itself does.

test('no authentication routes are registered', function (string $path): void {
    $this->get($path)->assertNotFound();
})->with([
    '/login',
    '/register',
    '/forgot-password',
    '/user/two-factor-authentication',
    '/dashboard',
    '/settings/profile',
]);

test('no fortify features are enabled', function (): void {
    expect(config('fortify.features'))->toBe([]);
});
