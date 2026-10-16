@extends('layouts.app')

@section('title', $menuItem->name . ' | ' . $restaurant->name . ' | QuickBite')

@push('styles')
    <style>
        body {
            background: #f8f8f8;
            color: #222;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .page-container {
            width: min(820px, calc(100% - 40px));
            margin: 0 auto;
            padding: 32px 0 60px;
        }

        .detail-back {
            display: inline-block;
            margin-bottom: 20px;
        }

        .item-detail {
            overflow: hidden;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            background: #fff;
        }

        .item-detail-image {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            background: #ececec;
        }

        .item-detail-content {
            padding: 24px;
        }

        .item-detail-content h1 {
            margin: 0 0 10px;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -1px;
            line-height: 1.15;
        }

        .item-price {
            margin: 0 0 16px;
            font-size: 22px;
            font-weight: 700;
        }

        .item-description {
            margin: 0 0 20px;
            color: #707070;
            line-height: 1.6;
        }

        .item-restaurant {
            margin: 0;
            padding-top: 18px;
            border-top: 1px solid #eee;
            color: #555;
            font-size: 14px;
        }

        @media (max-width: 650px) {
            .page-container {
                width: min(100% - 24px, 820px);
            }
        }
    </style>
@endpush

@section('content')
    <main class="page-container">
        <a class="detail-back" href="{{ route('restaurants.show', $restaurant) }}">← Back to {{ $restaurant->name }}</a>

        <article class="item-detail">
            <img
                class="item-detail-image"
                src="{{ $menuItem->image_url ?: asset('images/food-placeholder.svg') }}"
                alt="{{ $menuItem->name }}"
            >

            <div class="item-detail-content">
                <h1>{{ $menuItem->name }}</h1>
                <p class="item-price">${{ number_format($menuItem->price, 2) }}</p>
                <p class="item-description">
                    {{ $menuItem->description ?: 'No description available.' }}
                </p>
                <p class="item-restaurant">
                    Served by
                    <a href="{{ route('restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a>
                    &middot; {{ $restaurant->location }}
                </p>
            </div>
        </article>
    </main>
@endsection
