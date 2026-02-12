# Wallet API Documentation

Dokumentasi untuk backend API Wallet Application. API ini menangani otentikasi user, manajemen dompet (pockets), pencatatan pemasukan/pengeluaran, dan pelaporan.

## Persyaratan Sistem

- PHP 8.3+
- Composer
- Database (pgSQL)

## Instalasi

1. **Clone repository**

    ```bash
    git clone [https://github.com/iqbalrez/api-wallet-gsi.git](https://github.com/iqbalrez/api-wallet-gsi.git)
    cd api-wallet-gsi
    ```

2. **Install dependensi**

    ```bash
    composer install
    ```

3. **Setup environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrasi & Seeding Database**
   Jalankan perintah ini untuk membuat tabel dan data dummy (2 user test).

    ```bash
    php artisan db:seed
    ```

5. **Jalankan server**
    ```bash
    php artisan serve
    ```

## Otentikasi

API ini menggunakan JWT. Sertakan token pada header untuk endpoint yang diproteksi.

`Header: Authorization: Bearer <your-token> Accept: application/json`

## Endpoints

1. **Endpoint untuk User Login**

    Method: `POST` - api/auth/login

    Request:

    ```
    {
        "email": "example@mail.net",
        "password": "password"
    }
    ```

2. **Endpoint untuk Get User Profile**

    Method: `GET` - api/auth/profile

3. **Endpoint untuk Get Pockets**

    Method: `GET` - api/pockets

4. **Endpoint untuk Add New Pocket**

    Method: `POST` - api/pockets

    Request:

    ```
    {
        "name": "Pocket 1",
        "initial_balance": 2000000
    }
    ```

5. **Endpoint untuk Create Income**

    Method: `POST` - api/incomes

    Request:

    ```
    {
        "pocket_id": "uuid",
        "amount": 300000,
        "notes": "Menemukan uang di jalan"
    }

    ```

6. **Endpoint untuk Create Expense**

    Method: `POST` - api/expenses

    Request:

    ```
    {
        "pocket_id": "uuid",
        "amount": 2000000,
        "notes": "Ganti lecet mobil orang"
    }
    ```

7. **Endpoint untuk Get total balances**

    Method: `GET` - api/pockets/total-balance

8. **Create Report by Pocket ID**

    Method: `POST` - api/pockets/:id/create-report

    Request:

    ```
    {
    "type": "INCOME",  // INCOME atau EXPENSE
    "date": "2026-01-01"  // Format tanggal YYYY-MM-DD
    }

    ```

9. **Stream Report (Download Excel)**

    Method: `GET`- reports/:id

## Testing via Postman

Untung keperluan testing, tersedia collection JSON yang dapat di import ke Postman di

`API Wallet GSI.postman_collection.json`

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
