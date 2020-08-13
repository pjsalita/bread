# Basic API with Authentication

**Direction**: Implement an [or a set of] API that can do Browse, Read, Edit, Add, Delete (BREAD) operations against a sql database table.

**Used**:
- Lumen
- JWT for authentication

**Setup**:
1. Clone Repository
    ```sh
    $ git clone https://github.com/pjsalita/bread.git
    ```
2. Change directory and install dependencies
    ```sh
    $ cd bread
    $ composer install
    ```
3. Create .env file and update **APP_KEY** to random string 32 characters string
    ```sh
    $ cp .env.example .env
    ```
4. Create **database.sqlite** file under **database** folder
    ```
    $ touch database/database.sqlite
    ```
5. Run migrations and seeders
    ```
    $ php artisan migrate --seed
    ```
6. Generate jwt secret
    ```
    $ php artisan jwt:secret
    ```
7. Serve
    ```
    $ php -S localhost:8000 -t public
    ```
Note: Make sure php-sqlite extension is installed/enabled.

Seeded user(to skip registration for testing):
- Username: sample
- Password: password

Endpoints:
- http://bread.xyzfiglet.cf/api/v1/register (POST)
  (params: name, email, username, password, password_confirmation)
- http://bread.xyzfiglet.cf/api/v1/login (POST)
  (params: username, password)
- http://bread.xyzfiglet.cf/api/v1/customers?page=1... (GET)
  (can have **per_page**, **sort**, **order**, and **page**)
- http://bread.xyzfiglet.cf/api/v1/customers/{id} (GET, PATCH, DELETE)
  (PATCH params: firstname, lastname, date_of_birth, is_active)
- http://bread.xyzfiglet.cf/api/v1/customers (PUT)

