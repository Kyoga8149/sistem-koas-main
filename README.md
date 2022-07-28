# Sistem Koas
This is a Student Management System for Indonesian Learning Hospital. It can manage the KOAS, Resident, and healthcare internship students. 

## Features

- [ ] Manajemen Mahasiswa Koas
- [ ] Manajemen Dokter Residen
- [ ] Manajemen Tenaga Kesehatan Magang (nurse, apoteker, dll)
- [ ] Manajemen Stase
- [ ] Manajemen Dokter Pendamping
- [ ] Manajemen Universitas dan sekolah rekanan
- [ ] Available in Docker image

## How to install

This system is using Laravel version 9 and PHP 8.1. It's also using Laravel Nova. You need to purchase the license for Laravel Nova (search Google for more info).

To install 
- Clone the repository
- Configure the environment file `.env`.
- run `composer install`
- Configure the database. The easiest is to use `sqlite`. Though in the production environment, you would want to use MySQL or Postgres.
- Run `php artisan migrate:refresh`. Or, if you want to install seed data, run: `php artisan migrate:refresh --seed`.  
- Run `php artisan serve`
- Visit the system at `http://localhost:8000`

# sistem-koas-main
# sistem-koas-main
