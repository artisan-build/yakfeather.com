# yakfeather.com

A Laravel app with one page and a health check. It says, on that page, that it is the real PHP app,
and that is the whole feature set.

It exists as the subject of the Isolated Mode spike (`brain/ideas/2026-10-22-isolated-mode.md`): the
app whose custom domain gets moved to a stand-in environment and moved back, to find out whether a
Laravel Cloud app can be taken out of its own request path without a DNS change. Everything here is
in service of being small enough that nothing about the app confuses the result.

So: do not add authentication, accounts, billing, a database beyond the starter kit's own sqlite
file, a queue, a cache, a bucket, or a second page. Fortify ships with the starter kit and is
switched off in two places. `config/fortify.php` has an empty `features` array, and
`AppServiceProvider::register()` calls `Fortify::ignoreRoutes()`. The auth views, Livewire settings
components and Fortify actions the kit shipped were removed once those switches made them
unreachable. `tests/Feature/NoAuthSurfaceTest.php` holds that line.

## Workflow

See `.solo/workflow.md` for merge policy, the hard gate, CI, and coordination details. Feature builds
use the `multi-agent-build` skill.

Hard gate before any PR: `composer ready` (ide-helper + rector + pint + phpstan + pest + audit).

## No frontend build step

Non-negotiable, inherited from the starter kit: **no Node, no npm, no Vite, no frontend build step.**
Do not introduce one.

Tailwind CSS is served from the committed bundle at `public/build/assets/app.css`. **A class that is
not in that bundle silently does nothing** — no error, no warning, no console message. It simply
does not apply, which reads as "my markup is wrong" and burns an hour.

To use new classes, regenerate the bundle with `php artisan tailwind:optimize` (it downloads the
standalone Tailwind binary — still no Node) and **commit the regenerated file**.

**Delete `public/build/assets/app.css` before you regenerate.** Tailwind v4 scans the committed
output as one of its own sources, so anything junk in there re-seeds itself forever if you regenerate
in place.

Do not naively `grep` the bundle to check whether a class landed: it is minified and its selectors
are backslash-escaped (`.md\:flex`). Strip the backslashes and use `grep -F`, or you will get a
false negative and "fix" a bug that was never there.

## IDE helper files

`_ide_helper.php` and `_ide_helper_models.php` are committed on purpose (PHPStan `scanFiles` needs
`_ide_helper_models.php` to resolve model types). `.phpstorm.meta.php` is gitignored on purpose (it
embeds absolute local paths). This asymmetry is deliberate — do not make them consistent in either
direction.

## Static analysis

The PHPStan baseline lives in `phpstan-baseline.neon`. Keep it shrinking; never grow it silently.

## Object storage

The starter kit ships `league/flysystem-aws-s3-v3` as a runtime dependency because Laravel Cloud
**refuses to deploy** an application that has a bucket attached without it — not a warning, a failed
deployment, with nothing shippable until the package lands. Most apps end up wanting a bucket, so it
is cheaper to inherit it than to rediscover this during a deploy.

If this project has no bucket and never will, `composer remove league/flysystem-aws-s3-v3` is safe.
