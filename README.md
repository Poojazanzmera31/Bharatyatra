# Bharatyatra – Tour & Travel Guide Website

Bharatyatra is a travel website made using PHP, MySQL, HTML, CSS, and JavaScript. It helps users explore and book tour packages. The system includes:

- User Panel (for customers)
- Admin Panel (for admin)

## Localhost URLs

- User Panel: http://localhost/bharatyatra/home.php  
- Admin Panel: http://localhost/bharatyatra/admin_login.php

### Admin Login

- Username: admin  
- Password: admin123

## Technologies Used

- Frontend: HTML, CSS, JavaScript  
- Backend: PHP  
- Database: MySQL (File: bharatyatra_db.sql)

## Features

### User Panel

- User registration and login  
- Browse tour packages  
- Book packages online  
- Submit feedback  
- Contact form  
- Booking confirmation  
- Profile management

### Admin Panel

- Admin login  
- Add, update, delete packages  
- View/manage bookings  
- View contact messages  
- View feedback  
- Manage users and content

## How to Run the Project (XAMPP)

1. Copy the `bharatyatra` folder to:
   - Applications/XAMPP/htdocs/

2. Start XAMPP:
   - Start Apache and MySQL

3. Set up the database:
   - Open http://localhost/phpmyadmin
   - Create a database: `bharatyatra_db`
   - Import the file `bharatyatra_db.sql`

4. Run in browser:
   - User Panel: http://localhost/bharatyatra/home.php  
   - Admin Panel: http://localhost/bharatyatra/admin_login.php
