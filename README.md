# Tugas Akhir Pemrograman Web Lanjut
Nama Anggota :
1. Atthoriq Adillah Wicaksana (195150400111034)
2. Muhammad Alfarrel Indrawan (195150400111036)
3. Muhammad Faisal Shabri (195150400111038)
4. Muhammad Fikri Almas (195150400111033)

## Clone Repo :
```
git clone https://github.com/thoriqadillah/antrian-rs.git
cd antrian-rs
composer install
php artisan key:generate
git pull origin main
```
Kemudian copy .env ke folder project, dan sesuaikan config db nya dengan db kalian

## Migrate dan Seed :
```
php artisan migrate:refresh --seed
```

## IMPORTANT!
Ketika mau push, harus `git pull origin main` terlebih dahulu

## Install Laravel/UI
Untuk install laravel/ui :
```
composer require laravel/ui
npm install
```

## Run Server
```
php artisan serve
```
