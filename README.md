## Api usage

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
- GET/links/search/{name} - search links
- GET/links/{id}/ - get link data
- POST/logout - delete auth_user token
- PUT/links/{id} - update link
- DELETE/links/{id} - delete link




