<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QuickBite Restaurants</title>
</head>

<body>

    <div class="container">

        <h1>QuickBite Restaurants</h1>

        <form
            method="GET"
            action="{{ route('restaurants.index') }}"
        >
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search restaurants..."
            >

            <button type="submit">
                Search
            </button>
        </form>

        <hr>

        <!-- Restaurant list -->
        <div class="restaurant-list">

            @forelse ($restaurants as $restaurant)

                <div class="restaurant-card">

                    <h2>
                        {{ $restaurant->name }}
                    </h2>

                    <p>
                        {{ $restaurant->description }}
                    </p>

                    <p>
                        {{ $restaurant->location }}
                    </p>

                    <a href="#">
                        View Restaurant
                    </a>

                </div>

                <hr>

            @empty

                <p>No restaurants found.</p>

            @endforelse

        </div>

    </div>

</body>
</html>