# DYNAMIC-HOSPITAL-WEBSITE-
# DYNAMIC-HOSPITAL-WEBSITE

A dynamic hospital management and healthcare website designed to provide patients with easy access to hospital services, doctors, appointments, and other healthcare information.

## Project Overview

The Dynamic Hospital Website is a web-based system developed to improve communication between patients and healthcare providers. It provides an organized platform where users can explore hospital services, view doctors, request appointments, and access important hospital information.

The system is designed with a simple, responsive, and user-friendly interface.

## Features

* Hospital home page
* About the hospital
* Hospital services and departments
* Doctor information
* Doctor profiles
* Online appointment booking
* Patient registration and login
* Contact page
* Hospital announcements
* Admin management system
* Appointment management
* Patient management
* Doctor management
* Responsive design for different screen sizes

## Technologies Used

### Frontend

* HTML5
* CSS3
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Development Tools

* Visual Studio Code
* XAMPP or WAMP
* Git
* GitHub

## Project Structure

```text
DYNAMIC-HOSPITAL-WEBSITE/
│
├── index.html
├── about.html
├── services.html
├── doctors.html
├── appointment.html
├── contact.html
│
├── css/
│   └── style.css
│
├── js/
│   └── script.js
│
├── images/
│
├── php/
│   ├── connection.php
│   ├── login.php
│   ├── register.php
│   └── appointment.php
│
├── admin/
│   ├── dashboard.php
│   ├── doctors.php
│   ├── patients.php
│   └── appointments.php
│
└── database/
    └── hospital.sql
```

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/DYNAMIC-HOSPITAL-WEBSITE.git
```

### 2. Move the Project

Move the project folder into your XAMPP or WAMP server directory.

For XAMPP:

```text
C:\xampp\htdocs\
```

For WAMP:

```text
C:\wamp64\www\
```

### 3. Start the Server

Open XAMPP or WAMP and start:

* Apache
* MySQL

### 4. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
hospital_db
```

Import the database file:

```text
database/hospital.sql
```

### 5. Configure Database Connection

Update the database connection file with your MySQL settings.

Example:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "hospital_db";
```

### 6. Run the Project

Open your browser and visit:

```text
http://localhost/DYNAMIC-HOSPITAL-WEBSITE/
```

## Main Users

### Patients

Patients can:

* Create an account
* Log in
* View doctors
* View hospital services
* Book appointments
* View appointment information
* Contact the hospital

### Doctors

Doctors can:

* View their information
* Manage appointments
* View assigned patients
* Update relevant information

### Administrators

Administrators can:

* Manage patients
* Manage doctors
* Manage appointments
* Manage hospital services
* Manage announcements
* Monitor the overall system

## Database

The system uses MySQL to store and manage application data.

Possible database tables include:

```text
users
patients
doctors
departments
services
appointments
admins
announcements
contacts
```

## Security

The system should implement:

* User authentication
* Password hashing
* Session management
* Input validation
* SQL injection prevention
* Access control for admin pages

## Future Improvements

Future versions of the system may include:

* Online payment
* Email notifications
* SMS appointment notifications
* Doctor availability schedules
* Patient medical records
* Prescription management
* Online consultation
* Hospital reports and analytics
* Mobile application integration

## Purpose

The main purpose of this project is to develop a modern digital healthcare platform that makes hospital services easier to access and manage while improving the efficiency of hospital operations.

## Author

**Makda Nebyu**

Software Engineering Student

## License

This project is developed for educational and project purposes.
