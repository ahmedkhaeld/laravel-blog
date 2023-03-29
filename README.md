# Blog

### Features
* Authentication (login, logout, register)
* Authorization 
* Posts Management (create, edit, delete)
* Newsletters (subscribe)
* Admin Dashboard

# End Points
| Method | Resource                    | # Description                               |
|--------|-----------------------------|---------------------------------------------|
| GET    | /                           | display home  with all posts                |
| GET    | /posts/{post:slug}          | display a single post with more details     |
| POST   | /posts/{post:slug}/comments | add a comments to a specific posts          |
| POST   | /newsletter                 | subscribe a viewer to a news letter service |
| GET    | /register                   | displays the registration form for viewer   |
| POST   | /register                   | creates new user                            |
| GET    | /login                      | receive user credentials                    |
| POST   | /login                      | check  user credentials to login or not     |
| POST   | /logout                     | log authenticated user out                  |
| POST   | /admin/posts/create         | admin can create new post                   |
| POST   | /admin/posts/{post}/edit    | admin can edit post                         |
| POST   | /admin/posts/{post}/delete  | admin can delete post                       |
|        |                             |                                             |
