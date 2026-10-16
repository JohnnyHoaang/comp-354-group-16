@extends('layouts.app')

@section('title', $restaurant->name . ' | QuickBite')

@push('styles')
    <style>
        body {
            background: #f8f8f8;
            color: #222;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .page-container {
            width: min(1200px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 60px;
        }

        .detail-back {
            display: inline-block;
            margin-bottom: 20px;
        }

        .detail-hero {
            overflow: hidden;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            background: #fff;
        }

        .restaurant-image {
            display: block;
            width: 100%;
            height: 190px;
            object-fit: cover;
            background: #ececec;
        }

        .detail-hero-content {
            padding: 18px;
        }

        .detail-hero-content h1 {
            margin: 0 0 12px;
            font-size: 36px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .detail-description {
            margin: 0 0 12px;
            color: #707070;
            line-height: 1.5;
        }

        .detail-location {
            margin: 0;
            color: #555;
            font-size: 14px;
        }

        .detail-columns {
            display: grid;
            gap: 36px;
            margin-top: 36px;
        }

        .detail-section {
            width: 100%;
        }

        .section-title {
            margin: 0 0 4px;
            font-size: 24px;
        }

        .section-subtitle {
            margin: 0 0 20px;
            color: #707070;
        }
        .item-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 24px;
        }

        .item-card {
            display: flex;
            flex-direction: column;
            color: inherit;
            text-decoration: none;
        }

        .item-card:hover {
            color: inherit;
        }

        .item-card-image {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 10;
            border-radius: 14px;
            object-fit: cover;
            background: #ececec;
            transition: box-shadow 0.2s ease;
        }

        .item-card:hover .item-card-image {
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.14);
        }

        .item-card-body {
            padding: 12px 2px 0;
        }

        .item-card-body h3 {
            display: -webkit-box;
            overflow: hidden;
            margin: 0 0 6px;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
            font-size: 17px;
        }

        .item-card-body p {
            display: -webkit-box;
            overflow: hidden;
            margin: 0;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            color: #707070;
            line-height: 1.45;
        }

        .item-card-meta {
            margin-top: 10px;
            color: #222;
            font-weight: 700;
        }

        .empty-state {
            padding: 28px;
            border: 1px solid #e5e5e5;
            border-radius: 14px;
            background: #fff;
            color: #666;
            text-align: center;
        }

        @media (max-width: 650px) {
            .page-container {
                width: min(100% - 24px, 1200px);
            }

            .item-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 18px;
            }
        }
    </style>
@endpush

@section('content')
    <main class="page-container">
        <a class="detail-back" href="{{ route('restaurants.index') }}">← Back to restaurants</a>

        <section class="detail-hero">
            <img
                class="restaurant-image"
                src="{{ $restaurant->image_url ?: asset('images/food-placeholder.svg') }}"
                alt="{{ $restaurant->name }}"
            >

            <div class="detail-hero-content">
                <h1>{{ $restaurant->name }}</h1>
                <p class="detail-description">
                    {{ $restaurant->description ?: 'No description available.' }}
                </p>
                <p class="detail-location"><strong>Pickup location:</strong> {{ $restaurant->location }}</p>
            </div>
        </section>

        <div class="detail-columns">
            @if ($bestSellers->isNotEmpty())
                <section class="detail-section" aria-labelledby="best-sellers-heading">
                    <h2 class="section-title" id="best-sellers-heading">Best Sellers</h2>

                    <div class="item-grid">
                        @foreach ($bestSellers as $item)
                            <a
                                class="item-card"
                                href="{{ route('restaurants.menu-items.show', [$restaurant, $item]) }}"
                            >
                                <img
                                    class="item-card-image"
                                    src="{{ $item->image_url ?: asset('images/food-placeholder.svg') }}"
                                    alt="{{ $item->name }}"
                                    loading="lazy"
                                >
                                <div class="item-card-body">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{{ $item->description ?: 'No description available.' }}</p>
                                    <p class="item-card-meta">
                                        ${{ number_format($item->price, 2) }} &middot; {{ $item->units_sold }} sold
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="detail-section" id="menu" aria-labelledby="menu-heading">
                <h2 class="section-title" id="menu-heading">Menu</h2>

                @if ($menuItems->isEmpty())
                    <p class="empty-state">This restaurant has not added any menu items yet.</p>
                @else
                    <div class="item-grid">
                        @foreach ($menuItems as $item)
                            <a
                                class="item-card"
                                href="{{ route('restaurants.menu-items.show', [$restaurant, $item]) }}"
                            >
                                <img
                                    class="item-card-image"
                                    src="{{ $item->image_url ?: asset('images/food-placeholder.svg') }}"
                                    alt="{{ $item->name }}"
                                    loading="lazy"
                                >
                                <div class="item-card-body">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{{ $item->description ?: 'No description available.' }}</p>
                                    <p class="item-card-meta">${{ number_format($item->price, 2) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection
