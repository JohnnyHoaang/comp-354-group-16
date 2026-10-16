<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="wa-theme-default wa-palette-default wa-brand-blue"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title>@yield('title', 'QuickBite')</title>

    <link
        rel="stylesheet"
        href="https://ka-f.webawesome.com/webawesome@3.0.0/styles/webawesome.css"
    >
    <script
        type="module"
        src="https://ka-f.webawesome.com/webawesome@3.0.0/webawesome.loader.js"
    ></script>

    <style>
        :root {
            color-scheme: light;
            font-family: var(--wa-font-sans, "Instrument Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif);
            color: #17211c;
            background: #f5f7f5;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-width: 320px;
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(ellipse at 12% 0%, rgba(221, 241, 228, 0.75), transparent 35rem),
                #f5f7f5;
        }

        a {
            color: #176b45;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        a:hover {
            color: #104d32;
        }

        .site-header {
            border-bottom: 1px solid rgba(23, 33, 28, 0.08);
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
        }

        .site-header-inner,
        .page-shell {
            width: min(1160px, calc(100% - 40px));
            margin-inline: auto;
        }

        .site-header-inner {
            display: flex;
            min-height: 72px;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            color: #222;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.8px;
            text-decoration: none;
        }

        .page-shell {
            padding-block: clamp(32px, 6vw, 68px) 76px;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #176b45;
            font-size: 0.76rem;
            font-weight: 750;
            letter-spacing: 0.13em;
            text-transform: uppercase;
        }

        h1,
        h2,
        h3,
        p {
            overflow-wrap: anywhere;
        }

        h1,
        h2,
        h3 {
            color: #17211c;
            letter-spacing: -0.035em;
        }

        wa-button::part(base) {
            border-radius: 999px;
            font-weight: 650;
        }

        wa-input {
            --wa-form-control-border-radius: 999px;
        }

        wa-card {
            --border-radius: 18px;
            --border-color: rgba(23, 33, 28, 0.09);
            --box-shadow: 0 10px 28px rgba(31, 56, 42, 0.055);
        }

        .restaurant-image {
            display: block;
            width: 100%;
            height: 210px;
            object-fit: cover;
            background: #e8eee9;
        }

        .restaurant-image--hero {
            height: clamp(230px, 36vw, 390px);
        }

        .menu-item-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .menu-item-image {
            display: block;
            width: 88px;
            height: 88px;
            flex: 0 0 88px;
            border-radius: 12px;
            object-fit: cover;
            background: #e8eee9;
        }

        .menu-item-content {
            min-width: 0;
            flex: 1;
        }

        .restaurant-card-content {
            padding: 20px;
        }

        .restaurant-card-content h2,
        .restaurant-card-content h3 {
            margin: 0;
        }

        .muted {
            color: #657168;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 16px;
            margin: 44px 0 18px;
        }

        .section-heading h2 {
            margin: 0;
            font-size: clamp(1.45rem, 3vw, 1.9rem);
        }

        .section-heading p {
            margin: 5px 0 0;
        }

        @media (max-width: 640px) {
            .site-header-inner,
            .page-shell {
                width: min(100% - 28px, 1160px);
            }

            .site-header-inner {
                min-height: 62px;
            }

            .restaurant-image {
                height: 190px;
            }

            .menu-item-image {
                width: 72px;
                height: 72px;
                flex-basis: 72px;
            }

            .section-heading {
                align-items: start;
                flex-direction: column;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="site-header-inner">
            <a class="brand-link" href="{{ route('restaurants.index') }}">
                QuickBite
            </a>
            <wa-button
                href="{{ route('restaurants.index') }}"
                variant="neutral"
                appearance="plain"
            >
                Browse restaurants
            </wa-button>
        </div>
    </header>

    @yield('content')
</body>
</html>
