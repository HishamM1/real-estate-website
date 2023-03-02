# Larazillow
A real estate website that a realtor can list his property and another user or realtor can submit an offer to buy it.

# Basic Features
* User can Register and need email verification.

* User already registered can create Listing and add multiple images.

* View Listing can be filtered by Price/Beds/Baths/Area.

* User already registered can make offer for listing, total paid and interest paid will automatically change.

* If someone make offer for listing, user own that listing will get notify in application and email.

# Technologies
* PHP
* Laravel
* Tailwind
* MySQL
* Vue3
* Docker
* Mailhog
* Inertia

# Installation

Download this repo.

Rename ```.env.example``` to ```.env``` and fill the options.

Run the following commands:
```
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

