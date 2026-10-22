<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">

        <title>yakfeather.com — the real PHP app</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="stylesheet" href="{{ asset('build/assets/fonts.css') }}">

        <style>
            :root {
                color-scheme: light dark;
                --bg: #fdfdfc;
                --fg: #1b1b18;
                --muted: #706f6c;
                --rule: #e3e3e0;
            }

            @media (prefers-color-scheme: dark) {
                :root {
                    --bg: #0a0a0a;
                    --fg: #ededec;
                    --muted: #a1a09a;
                    --rule: #2a2a28;
                }
            }

            * { box-sizing: border-box; }

            body {
                margin: 0;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
                background: var(--bg);
                color: var(--fg);
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                line-height: 1.6;
            }

            main { max-width: 34rem; }

            h1 {
                margin: 0 0 1rem;
                font-size: 1.75rem;
                font-weight: 600;
                letter-spacing: -0.02em;
            }

            p { margin: 0 0 1rem; }

            p.muted { color: var(--muted); }

            dl {
                margin: 1.5rem 0 0;
                padding-top: 1.5rem;
                border-top: 1px solid var(--rule);
                display: grid;
                grid-template-columns: auto 1fr;
                gap: 0.35rem 1.25rem;
                font-size: 0.9rem;
            }

            dt { color: var(--muted); }

            dd { margin: 0; font-variant-numeric: tabular-nums; }

            code {
                font-family: ui-monospace, 'SFMono-Regular', Menlo, monospace;
                font-size: 0.9em;
            }
        </style>
    </head>
    <body>
        <main data-testid="welcome-main">
            <h1 data-testid="welcome-heading">This is the real PHP app.</h1>

            <p data-testid="welcome-body">
                You are talking to yakfeather.com running on Laravel, on PHP, on Laravel Cloud. If you
                came here expecting a holding page, something put this app back in the request path.
            </p>

            <p class="muted">
                yakfeather.com exists to be taken out of its own request path and put back again. It is
                the subject of the Isolated Mode spike: when a Laravel Cloud app needs to stop running
                PHP in a hurry, its custom domain moves to a stand-in that serves one static page, and
                this app's environment stops. Seeing this page means the move has not happened, or has
                been undone.
            </p>

            <dl>
                <dt>Served by</dt>
                <dd>PHP {{ PHP_VERSION }}</dd>
                <dt>Laravel</dt>
                <dd>{{ app()->version() }}</dd>
                <dt>Health check</dt>
                <dd><code>/up</code></dd>
            </dl>
        </main>
    </body>
</html>
