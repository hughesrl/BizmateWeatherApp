This page aims to provide travel information of Japan for foreign tourists visiting Japan for the first time.
The traveller has the possibility of going to the following cities.
Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya

Responsive UI for Web and Mobile view using Laravel as the backend and VueJS for frontend.

> I implemted this kind of UI/UX because it shows all the information you needed with just a click or tap away on choosing the City in Japan you want to visit. 

To run this project

1. cd <project_name>/
2. composer install
3. cp .env.example .env
4. (open .env and add you OpenWeatherMap API_KEY in WEATHER_API_KEY)
5. php artisan key:generate
6. php artisan config:cache
7. cd weather-vue/
8. cp .env.example .env
9. yarn or npm i
10. yarn build or npm run build
11. php artisan serve

Now open the browser to http://127.0.0.1:8000/

