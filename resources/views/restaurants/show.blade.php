<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="wa-theme-default wa-palette-default wa-brand-blue"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }} | QuickBite</title>
</head>
<body>
    <main>
        <a href="{{ route('restaurants.index') }}">Back to restaurants</a>

        <header>
            <h1>{{ $restaurant->name }}</h1>
            @if ($restaurant->image_url)
                <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}">
            @endif
            <p>{{ $restaurant->description ?: 'No description available.' }}</p>
            <p><strong>Location:</strong> {{ $restaurant->location }}</p>
        </header>

        <nav aria-label="Restaurant sections">
            <a href="#best-sellers">Best sellers</a>
            <a href="#menu">Menu</a>
        </nav>

        <section id="best-sellers" aria-labelledby="best-sellers-heading">
            <h2 id="best-sellers-heading">Best sellers</h2>
            @forelse ($bestSellers as $item)
                <article>
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <p>{{ $item->units_sold }} sold</p>
                </article>
            @empty
                <p>No sales data is available yet.</p>
            @endforelse
        </section>

        <section id="menu" aria-labelledby="menu-heading">
            <h2 id="menu-heading">Menu</h2>
            @forelse ($menuItems as $item)
                <article>
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <p>${{ number_format((float) $item->price, 2) }}</p>
                </article>
            @empty
                <p>This restaurant has no menu items yet.</p>
            @endforelse
        </section>
    </main>
</body>
</html>
