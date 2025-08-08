Blog API
A Laravel 10 API for managing blogs, posts, likes, and comments, built for the Voyatek assessment. The API uses Laravel Sanctum for authentication and a custom TokenMiddleware requiring an Authorization: vg@123 header.
Prerequisites

PHP >= 8.1
Composer
MySQL (or another supported database)
Postman (for testing)
Git

Setup Instructions

Clone the Repository
git clone https://github.com/NobulPlus/blogAPI.git
cd BlogAPI


Install Dependencies
Install PHP dependencies using Composer:
composer install


Configure Environment

Copy the example environment file:
cp .env.example .env


Update .env with your database details:
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog_api
DB_USERNAME=root
DB_PASSWORD=




Generate Application Key
php artisan key:generate


Run Migrations
Create the database tables:
php artisan migrate


Seed the Database
Seed a test user (email: test@example.com, password: password):
php artisan db:seed


Start the Server
Run the Laravel development server:
php artisan serve

The API will be available at http://localhost:8000/api.

Test with Postman

Import BlogAPI.postman_collection.json into Postman.
Set up a Postman environment (BlogAPI-Env) with:
base_url: http://localhost:8000/api
token: Obtained from POST /api/login


Authenticate:
Send POST {{base_url}}/login with:
{
    "email": "test@example.com",
    "password": "password"
}


Copy the returned token (e.g., 1|MqtP2lpFXKsmVZLhxRGykwSvBm90shq221Qn9VNsd1cb1857) to the token variable.



Test endpoints (e.g., POST {{base_url}}/blogs, POST {{base_url}}/blogs/{blogId}/posts):
Include headers:
Authorization: vg@123
Authorization: Bearer {{token}}
Content-Type: application/json (for POST requests)
Accept: application/json







API Endpoints

POST /api/login: Authenticate and get a Sanctum token.
GET /api/blogs: List all blogs.
POST /api/blogs: Create a blog.
GET /api/blogs/{id}: Show a blog.
PUT /api/blogs/{id}: Update a blog.
DELETE /api/blogs/{id}: Delete a blog.
GET /api/blogs/{blogId}/posts: List posts for a blog.
POST /api/blogs/{blogId}/posts: Create a post.
GET /api/blogs/{blogId}/posts/{postId}: Show a post.
PUT /api/blogs/{blogId}/posts/{postId}: Update a post.
DELETE /api/blogs/{blogId}/posts/{postId}: Delete a post.
POST /api/blogs/{blogId}/posts/{postId}/like: Like a post.
POST /api/blogs/{blogId}/posts/{postId}/comment: Comment on a post.

Notes

All endpoints except /api/login require:
Authorization: vg@123 header.
Authorization: Bearer {{token}} header (token from /api/login).


Ensure the database is running before executing migrations or seeding.
The Postman collection (BlogAPI.postman_collection.json) includes all endpoint requests for testing.
