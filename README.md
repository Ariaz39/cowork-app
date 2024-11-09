<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

- Laravel version: 10.48.22
- MySql version: 8.0.30
- PHP version: 8.1

# Users, Workspaces and Bookings management application

This application allows you to schedule a co-work and for the administrator to manage the reservation.

## Clone the repository

[https://github.com/Ariaz39/cowork-app.git](https://github.com/Ariaz39/cowork-app.git)

Create the .env file in the project root based on the .env.example file in order to set the environment variables.

1. To install the dependencies of Laravel/Breeze (Authentication required) run
```php 
composer install
npm install
``` 

## Note

> The database used for the project is MySql

### Migrations

Run the following command to run startup migrations with your seeders.

```php
php artisan migrate --seed
```

### Run Laravel project
```php
php artisan serve
```
### Please note that test users, workspaces, and bookings already exist. 
The users are listed below:

| Name    | Email            | Role | Password      |
|---------|------------------|------|---------------|
| Admin   | admin@test.com    | adm  | password      |
| User1   | user1@test.com    | usr  | password |
| User2   | user2@test.com    | usr  | password |


## Finally
1. If you wish, you can create a user, keeping in mind that every new user will be created with the role of 'user'
2. Register a new Workspace
3. Register a new Booking
4. With the administrator you can manage the reservation
5. Enjoy!



Autor: [Jorge Alejandro Arias Villalba © 2024](https://github.com/Ariaz39)
