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

        .detail-actions {
            margin-top: 18px;
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
            margin-top: 32px;
        }

        .detail-section {
            width: 100%;
        }

        .section-title {
            margin: 0 0 20px;
            font-size: 24px;
        }

        .item-list {
            display: grid;
            gap: 16px;
        }

        .item-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            overflow: hidden;
            padding: 16px;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            background: #fff;
            transition: box-shadow 0.2s ease;
        }

        .item-card:hover {
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
        }

        .menu-item-image {
            display: block;
            width: 88px;
            height: 88px;
            flex: 0 0 88px;
            border-radius: 10px;
            object-fit: cover;
            background: #ececec;
        }

        .menu-item-content {
            min-width: 0;
            flex: 1;
        }

        .menu-item-content h3 {
            margin: 0 0 8px;
            font-size: 18px;
        }

        .menu-item-content p {
            margin: 0;
            color: #707070;
            line-height: 1.5;
        }

        .item-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 12px;
        }

        .item-card-footer p {
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

            .menu-item-image {
                width: 72px;
                height: 72px;
                flex-basis: 72px;
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
                <div class="detail-actions">
                    <wa-button href="#menu" variant="neutral" appearance="outlined">
                        View Menu
                    </wa-button>
                </div>
            </div>
        </section>

        <div class="detail-columns">
            <section class="detail-section" aria-labelledby="best-sellers-heading">
                <h2 class="section-title" id="best-sellers-heading">Best Sellers</h2>

                @if ($bestSellers->isEmpty())
                    <p class="empty-state">No sales data is available yet.</p>
                @else
                    <div class="item-list">
                        @foreach ($bestSellers as $item)
                            <article class="item-card">
                                <img
                                    class="menu-item-image"
                                    src="{{ $item->image_url ?: asset('images/food-placeholder.svg') }}"
                                    alt="{{ $item->name }}"
                                    loading="lazy"
                                >
                                <div class="menu-item-content">
                                    <h3>{{ $item->name }}</h3>
                                    <p>{{ $item->description ?: 'No description available.' }}</p>
                                    <div class="item-card-footer">
                                        <p>{{ $item->units_sold }} sold</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </main>
@endsection
