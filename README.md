# Docker env
Laravel 8 short link app

# install && run site on http://localhost
- docker-compose up --build -d
- docker-compose exec app php artisan migrate

# Api usage

Public methods:

- POST/links - Create short link
    - 'link' => your link(string)
- POST/register - Create account and get token
    - 'name' => your name(required|string)
    - 'email' => your email(required|string)
    - 'password' => your password(required|string)
    - 'password_confirmation' => confirm the password(required|string)

Protected admin methods(using auth token):
- GET/links - Get all links
- GET/links/search/{string} - search links
- GET/links/{id}/ - get link data
- POST/logout - delete auth_user token
- PUT/links/{id} - update link
- DELETE/links/{id} - delete link





