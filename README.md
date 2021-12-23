How to run this project

1. Clone this repository

2. Run composer install on your cmd or terminal

3. Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu

4. Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration. By default, the username is root and you can leave the password field empty. (This is for Xampp)

5. Run npm install

6. Run npm run dev

7. Run php artisan key:generate

8. Run php artisan migrate:fresh --seed to generate database and seeder data

9. Run php artisan storage:link

10. Run php artisan serve

11. Go to localhost:8000