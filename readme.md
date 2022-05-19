School Management System
Initial Setup

To build the app, you need to have php7.1 or greater (with mdstring and xml modules as required by Laravel), composer, mysql required.
.And also make sure about database configured correctly in running system.

1. Install base from composer

composer install

2. Install node modules from npm

npm install

3. Create environment file

Once the npm modules are installed and configured, you just need to update the environment variable to suit your development environment for mysql and redis.

cp .env.example .env

Update the mysql to reflect your local setup.

Note the environment file is in git ignore, so it wont be pushed with any updates.

4. Migrate the database schema

Run the migration code to populate your local mysql instance.

php artisan migrate

This will prepopulate the mysql database with the auth users table and migration management table.

5. Seeding data to populate the database

Note: If you are using the app for the first time, you need to set the APP_INITIAL_BUILD flag in your .env file to be true. Edit .env and set APP_INITIAL_BUILD=true.

Once updated, seed the data to prepopulate the database, first update composer to reflect the seed data.

composer dump-autoload

php artisan db:seed

This will include the initial user,teachers,subject,terms test data in the initial dump.
The seed may be run when configs are updated.

IMPORTANT!

MAKE SURE YOU AFTER YOU COMPLETE THE INITIAL SEED, THE APP_INITIAL_BUILD IN YOUR .ENV TO SET TO FALSE AFTER YOU HAVE COMPLETED THE SEED, otherwise the next time you run the seed it will delete and replace the existing tables.

If there any issue related to db seed please use command php artisan migrate:fresh --seed

Once configured, you can start a local version of the instance using laravels built in webserver:

php artisan serve

This will start the server on http://localhost:8000.

Alternatively, you can setup a config for nginx or apache based on laravel's guides
Logging in

If you have created the initial data set, there is a default account already setup.

Username: admin@school.com

Password: secret

Alternatively, you can go to /register to signup a new account, or click signup from the login page.