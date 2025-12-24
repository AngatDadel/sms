-- Database: student_db
CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  roll VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  dob DATE DEFAULT NULL,
  class VARCHAR(50),
  sub1 INT DEFAULT 0,
  sub2 INT DEFAULT 0,
  sub3 INT DEFAULT 0,
  photo VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin
INSERT INTO users (name, email, password, role)
VALUES ('Admin', 'admin@example.com', '$2y$10$4h0YxQyQyqF3q9rKqZ6sWeaQ5kJ1p8b6Vq7b2Yh6vG1cJf9x8B2eG', 'admin');
-- password: admin123 (bcrypt hash)
