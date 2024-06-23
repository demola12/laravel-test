
## Laravel Test

This project is a solution to Cavendish Technical Assessment

## Table of Contents

- [Installation](#installation)
- [Endpoints](#endpoints)
- [Test](#test)

## Installation


1. Install the required dependencies using Composer::

   ```bash
   composer install
    ```
2. Set up your environment variables by copying the `.env.example` file:
   ```bash
   cp .env.example .env
    ```

3. Generate a new application key:
    ```bash
    php artisan key:generate
    ```
6. Configure your database connection in the `.env` file.
7. Run the migrations:
    ```bash
    php artisan migrate --seed
    ```
8. Generate a JWT secret key:

   ```bash
   php artisan jwt:secret
    ```
## Endpoints

| Method   |      Endpoint           |    Description                             |
|----------|-------------------------|--------------------------------------------|
| POST     | /api/login              | User login and token generation            |
| GET      | /api/me                 | Get current user information               |
| POST     | /api/refresh            | Refresh access token                       |
| POST     | /api/logout	         | Invalidate the current token and log out   |
| POST     | /api/admin/register      | Register a user and assign admin role     |
| GET      | /api/categories          | List all the categories                   |
| POST     | /api/register            | Register a user and assign user role      |
| POST     | /api/websites            | Submit a website to a directory/categories|
| GET      | /api/websites            | List all website in directory             |
| GET      | /api/websites?category=  | List all website in  category             |
| DELETE   | /api/websites/{id}       | Delete a website                          |
| POST     | /api/websites/{id}/vote  | Vote and unvote                           |

#### User Registration
Use this endpoint to register a user . Provide the user's email,name,password and password_confirmation in the request body. If the validation are valid, the API will respond with success message

##### Request Body:
```http
POST /api/register HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "name":"Oyinlade Demola",
    "email":"tester@gmail.com",
    "password":"Qwerty@123456",
    "password_confirmation":"Qwerty@123456"
}
```

##### Response:
```json
{
    "success": true
}
```
#### Admin Registration
Use this endpoint to register a user with admin role . Provide the user's email,name,password and password_confirmation in the request body. If the validation are valid, the API will respond with success message

##### Request Body:
```http
POST /api/admin/register HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "name":"Oyinlade Demola",
    "email":"tester@gmail.com",
    "password":"Qwerty@123456",
    "password_confirmation":"Qwerty@123456"
}
```

##### Response:
```json
{
    "success": true
}
```
#### User Login
Use this endpoint to authenticate a user and generate an access token. Provide the user's email and password in the request body. If the credentials are valid, the API will respond with the user's information along with an access token that can be used for subsequent requests.

##### Request Body:
```http
POST /api/login HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "email": "johndoe@example.com",
    "password": "password@123"
}
```

##### Response:
```json
{
    "user": {
        "id": 1,
        "name": "john doe",
        "email": "johndoe@example.com",
        "email_verified_at": null,
        "created_at": "2023-07-24T05:10:20.000000Z",
        "updated_at": "2023-07-24T05:10:20.000000Z"
    },
    "authorization": {
        "access_token": "{{ token }}",
        "token_type": "bearer",
        "expires_in": 3600
    }
}
```

#### Get Current Authenticated User Information
Use this endpoint to fetch information about the currently authenticated user. Include the access token in the request headers. The API will respond with the user's details.

##### Request Body:
```http
GET /api/me HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Bearer <token>
```

##### Response:
```json
{
    "id": 1,
    "name": "john doe",
    "email": "johndoe@example.com",
    "email_verified_at": null,
    "created_at": "2023-07-24T05:10:20.000000Z",
    "updated_at": "2023-07-24T05:10:20.000000Z"
}
```

#### Generate Refresh token
Use this endpoint to refresh an expired access token. Include the current access token in the request headers. The API will respond with a new access token that can be used for authentication. Token refresh is useful to maintain a user's session without requiring frequent logins.

##### Request Body:
```http
POST /api/refresh HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Bearer <token>
```

##### Response:
```json
{
    "user": {
        "id": 1,
        "name": "john doe",
        "email": "johndoe@example.com",
        "email_verified_at": null,
        "created_at": "2023-07-24T05:10:20.000000Z",
        "updated_at": "2023-07-24T05:10:20.000000Z"
    },
    "authorization": {
        "access_token": "{{ token }}",
        "token_type": "bearer",
        "expires_in": 3600
    }
}
```

#### Logout
Use this endpoint to invalidate the current access token and log out the user. Include the access token in the request headers. After logging out, the token will no longer be valid for making authenticated requests.

##### Request Body:
```http
POST /api/logout HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Bearer <token>
```

##### Response:
```json
{
    "success": true
}
```

#### Get list of directory (also known as categories)
Use this endpoint to fetch list of directory. The API will respond with the directory details No token needed.

##### Request Body:
```http
GET /api/categories HTTP/1.1
Host: localhost:8000
Content-Type: application/json
```

##### Response:
```json
{
    "categories": [
        {
            "id": "9c599a85-49d3-493f-99d4-694119378a9f",
            "name": "officiis",
            "description": "Exercitationem tempore id autem et qui ea non. Delectus veniam ipsam modi voluptatem iste. Accusamus amet recusandae consequatur consequatur. Asperiores alias dicta iure eaque occaecati fugiat.",
            "created_at": "2024-06-22T20:03:04.000000Z",
            "updated_at": "2024-06-22T20:03:04.000000Z",
            "deleted_at": null
        }
    ]
}
```
#### List all website
Use this endpoint to fetch list all website. The API will respond with the paginated website details No token needed.

##### Request Body:
```http
GET /api/websites HTTP/1.1
Host: localhost:8000
Content-Type: application/json
```

##### Response:
```json
{
    "websites": {
        "current_page": 1,
        "data": [
            {
                "id": "9c599a97-b9a5-4c67-b054-148e9378b7ac",
                "title": "Molestiae velit est autem blanditiis sunt rerum aut.",
                "url": "http://huels.com/8b7acbfa-fd89-440d-9765-8532d6010dc3",
                "description": "Optio non et sequi excepturi est minus eum. Distinctio suscipit totam praesentium sapiente molestiae at et dolorem. Quae temporibus sit culpa rerum.",
                "user_id": "9c599a85-451e-45a2-ac69-69b0ae7240f9",
                "category_id": "9c599a85-4eba-4e62-b329-5c894e42f6e1",
                "vote_count": 1,
                "created_at": "2024-06-22T20:03:16.000000Z",
                "updated_at": "2024-06-22T20:20:30.000000Z",
                "deleted_at": null,
                "category": {
                    "id": "9c599a85-4eba-4e62-b329-5c894e42f6e1",
                    "name": "suscipit",
                    "description": "Laudantium pariatur sit animi sed necessitatibus quae rerum. Quisquam sed perspiciatis voluptates et distinctio est error. Inventore hic minima quo et.",
                    "created_at": "2024-06-22T20:03:04.000000Z",
                    "updated_at": "2024-06-22T20:03:04.000000Z",
                    "deleted_at": null
                }
            }
        ],
        "next_page_url": "http://127.0.0.1:8000/api/websites?page=2",
        "path": "http://127.0.0.1:8000/api/websites",
        "per_page": 50,
        "prev_page_url": null,
        "to": 50,
        "total": 10000
    }
}
```
#### List website based on category
Use this endpoint to fetch list all website in a category. The API will respond with the paginated website details in a category No token needed.

##### Request Body:
```http
GET /api/websites?category=7898-0987 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
```

##### Response:
```json
{
    "websites": {
        "current_page": 1,
        "data": [
            {
                "id": "9c599a95-48c8-4626-8067-59011b30b92f",
                "title": "Accusantium explicabo dolorem nihil sint qui quia aliquid beatae.",
                "url": "http://huels.com/dccb4783-4df0-4f44-8a93-fae4322f0c12",
                "description": "Eaque ut molestiae esse nostrum et sed repudiandae. Quas ipsa itaque non laboriosam. Harum et nisi aut. Commodi fuga velit voluptate incidunt voluptatem voluptatum minima.",
                "user_id": "9c599a85-41d6-4532-9505-b277bc3b5f19",
                "category_id": "9c599a85-49d3-493f-99d4-694119378a9f",
                "vote_count": 0,
                "created_at": "2024-06-22T20:03:14.000000Z",
                "updated_at": "2024-06-22T20:03:14.000000Z",
                "deleted_at": null,
                "category": {
                    "id": "9c599a85-49d3-493f-99d4-694119378a9f",
                    "name": "officiis",
                    "description": "Exercitationem tempore id autem et qui ea non. Delectus veniam ipsam modi voluptatem iste. Accusamus amet recusandae consequatur consequatur. Asperiores alias dicta iure eaque occaecati fugiat.",
                    "created_at": "2024-06-22T20:03:04.000000Z",
                    "updated_at": "2024-06-22T20:03:04.000000Z",
                    "deleted_at": null
                }
            },
        ],
        "first_page_url": "http://127.0.0.1:8000/api/websites?page=1",
        "from": 1,
        "last_page": 7,
        "last_page_url": "http://127.0.0.1:8000/api/websites?page=7",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=4",
                "label": "4",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=5",
                "label": "5",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=6",
                "label": "6",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=7",
                "label": "7",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/websites?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": "http://127.0.0.1:8000/api/websites?page=2",
        "path": "http://127.0.0.1:8000/api/websites",
        "per_page": 50,
        "prev_page_url": null,
        "to": 50,
        "total": 333
    }
}
```



## Test

### Admin Can Delete
This test verifies that an admin user can successfully delete a website. The test follows these steps:
1. Create an admin user using the `UserFactory`.
2. Create a website entry using the `WebsiteFactory`.
3. Authenticate as the admin user.
4. Send a DELETE request to the endpoint `/websites/{id}` with the ID of the created website.
5. Assert that the response status is `204 No Content`, indicating that the deletion was successful.
6. Verify that the website entry is no longer present in the database.

### User Can not Delete
This test verifies that an user can not successfully delete a website. The test follows these steps:
1. Create an user using the `UserFactory`.
2. Create a website entry using the `WebsiteFactory`.
3. Authenticate as the  user.
4. Send a DELETE request to the endpoint `/websites/{id}` with the ID of the created website.
5. Assert that the response status is `403`, indicating that the deletion was not successful.
6. Verify that the website entry is no longer present in the database.

```bash
   php artisan test
    ```
