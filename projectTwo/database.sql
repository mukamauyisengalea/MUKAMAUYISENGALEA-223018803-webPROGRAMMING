CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS student_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    pin_code VARCHAR(10) NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    hobbies VARCHAR(255),
    other_hobby VARCHAR(100),
    class_x_board VARCHAR(100),
    class_x_percentage DECIMAL(5, 2),
    class_x_year VARCHAR(4),
    class_xii_board VARCHAR(100),
    class_xii_percentage DECIMAL(5, 2),
    class_xii_year VARCHAR(4),
    graduation_board VARCHAR(100),
    graduation_percentage DECIMAL(5, 2),
    graduation_year VARCHAR(4),
    masters_board VARCHAR(100),
    masters_percentage DECIMAL(5, 2),
    masters_year VARCHAR(4),
    course_applied VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
