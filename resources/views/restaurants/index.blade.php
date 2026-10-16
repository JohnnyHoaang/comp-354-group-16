<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="wa-theme-default wa-palette-default wa-brand-blue"
>
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>QuickBite Restaurants</title>

    <!-- WebAwesome -->
    <link
        rel="stylesheet"
        href="https://ka-f.webawesome.com/webawesome@3.0.0/styles/webawesome.css"
    >

    <script
        type="module"
        src="https://ka-f.webawesome.com/webawesome@3.0.0/webawesome.loader.js">
    </script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: #f8f8f8;
            color: #222;
        }

        .page-container {
            width: min(1200px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 60px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .brand {
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -0.8px;
            margin-bottom: 10px;
        }
        .page-header h1 {
           font-size: 46px;
           font-weight: 700;
           letter-spacing: -1.6px;
           margin: 0 0 12px;
           line-height: 1.05;
        }

        .subtitle {
            color: #666;
            margin-bottom: 24px;
        }

        .search-form {
            display: flex;
            gap: 12px;
            align-items: center;
            max-width: 700px;
        }

        .search-form wa-input {
            flex: 1;
        }

        .section-title {
            margin: 36px 0 20px;
            font-size: 24px;
        }

        .restaurant-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .restaurant-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #e8e8e8;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .restaurant-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }

        .restaurant-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
            background: #ececec;
        }

        .restaurant-content {
            padding: 18px;
        }

        .restaurant-name {
            margin: 0 0 8px;
            font-size: 20px;
        }

        .restaurant-location {
            margin: 0 0 10px;
            color: #555;
            font-size: 14px;
        }

        .restaurant-description {
            margin: 0 0 18px;
            color: #707070;
            line-height: 1.5;
        }

        .empty-state {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 14px;
            padding: 36px;
            text-align: center;
            color: #666;
        }

        @media (max-width: 650px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            .page-container {
                width: min(100% - 24px, 1200px);
            }
        }
    </style>
</head>

<body>

    <main class="page-container">

        <section class="page-header">

            <div class="brand">
                QuickBite
            </div>

            <h1>
                Restaurants
            </h1>

            <p class="subtitle">
                Browse restaurants and find something for your next pickup.
            </p>

            <form
                class="search-form"
                method="GET"
                action="{{ route('restaurants.index') }}"
            >

                <wa-input
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search restaurants..."
                    clearable
                >
                </wa-input>

                <wa-button
                    type="submit"
                    variant="brand"
                >
                    Search
                </wa-button>

            </form>

        </section>


        <section>

            <h2 class="section-title">
                Available Restaurants
            </h2>

            @if ($restaurants->isEmpty())

                <div class="empty-state">
                    No restaurants found.
                </div>

            @else

                <div class="restaurant-grid">

                    @foreach ($restaurants as $restaurant)
                        <article class="restaurant-card">

                            <img
                                class="restaurant-image"
                                src="{{ $restaurant->image_url }}"
                                alt="{{ $restaurant->name }}"
                            >

                            <div class="restaurant-content">

                                <h3 class="restaurant-name">
                                    {{ $restaurant->name }}
                                </h3>

                                <p class="restaurant-location">
                                    {{ $restaurant->location }}
                                </p>

                                <p class="restaurant-description">
                                    {{ $restaurant->description }}
                                </p>

                                <wa-button
                                    href="{{ route('restaurants.show', $restaurant) }}"
                                    variant="neutral"
                                    appearance="outlined"
                                >
                                    View Restaurant
                                </wa-button>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </section>

    </main>

</body>
</html>
