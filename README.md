## QuickBite (COMP-354 Group 16)

### Requirements

- PHP `^8.4.14`
- Composer

### Setup

```bash
composer install
```

### Migrate the database

```bash
php artisan migrate
```

To drop every table and rebuild from scratch:

```bash
php artisan migrate:fresh
```

### Seed demo data

```bash
php artisan db:seed
```

### Run the app

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000`.

### Routes

| Method | URI | Name | Description |
| --- | --- | --- | --- |
| GET | `/` | `restaurants.index` | Main restaurant browsing/search page |
| GET | `/debug/data` | `debug.data.index` | JSON dump of restaurants, menu items, orders, and order items |
| GET | `/debug/data/restaurants` | `debug.data.restaurants` | JSON dump of restaurants (with menu items and orders) |
| GET | `/debug/data/menu-items` | `debug.data.menu-items` | JSON dump of menu items (with restaurant) |
| GET | `/debug/data/orders` | `debug.data.orders` | JSON dump of orders (with restaurant and items) |
| GET | `/debug/data/order-items` | `debug.data.order-items` | JSON dump of order items (with order and menu item) |