# yakfeather.com

One Laravel page that says it is the real PHP app, plus the `/up` health check. Nothing else.

It is the subject of the Isolated Mode spike: the app whose custom domain is moved to a stand-in
environment and then moved back, to find out whether a Laravel Cloud app can be pulled out of its own
request path without touching DNS. The page is deliberately dull so that anything surprising during
the spike is the infrastructure, not the app.

Scaffolded from [artisan-build/laravel-nodeless](https://github.com/artisan-build/laravel-nodeless),
so there is no Node, no npm and no frontend build step. See `CLAUDE.md` for what not to add and
`.solo/workflow.md` for the merge policy and gate.

## Running it

```
composer setup
composer dev
```

The gate before any PR is `composer ready`.
