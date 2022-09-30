## Project setup
### Copy environment file
```
cp .env.example .env
```
### Install dependencies
```
composer install
npm install
```
### Set up app key
```
php artisan key:generate
```

### Create MYSQL Database:
`mysql -u root -p`

enter password

`CREATE DATABASE hotel_reservations;`

quit


### Run migrations
```
php artisan migrate
```
### Set up frontend
```
npm run dev
```
