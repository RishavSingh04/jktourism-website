CREATE DATABASE IF NOT EXISTS fakir_chand_store CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fakir_chand_store;
CREATE TABLE categories(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,icon VARCHAR(10) NOT NULL);
INSERT INTO categories(name,icon) VALUES
('Computer Science','💻'),('Engineering','⚙️'),('Medical','🩺'),('Competitive Exams','🎓'),('School','🏫'),('Commerce','📊'),('Management','💼'),('Fiction','📖'),('General Knowledge','🧠');
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(120) NOT NULL,email VARCHAR(160) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE books(id INT AUTO_INCREMENT PRIMARY KEY,title VARCHAR(200) NOT NULL,author VARCHAR(160) NOT NULL,category_id INT,price DECIMAL(10,2) NOT NULL,stock INT DEFAULT 0,emoji VARCHAR(10) DEFAULT '📕',description TEXT,FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE SET NULL);
INSERT INTO books(title,author,category_id,price,stock,emoji,description) VALUES
('PHP & MySQL Web Development','R. Sharma',1,550,20,'💻','Practical guide to PHP and MySQL.'),
('Clean Code','Robert C. Martin',1,799,12,'🧑‍💻','A classic guide to writing readable software.'),
('Engineering Mathematics','B. S. Grewal',2,700,15,'📐','Engineering mathematics reference.'),
('Introduction to Algorithms','Cormen et al.',1,950,8,'🧮','Algorithms and problem solving.'),
('Anatomy & Physiology','S. Singh',3,850,10,'🩺','Foundational medical study text.'),
('General Knowledge 2026','Arihant Experts',9,350,30,'🧠','General awareness and current topics.'),
('Quantitative Aptitude','R. S. Aggarwal',4,499,25,'🎯','Practice for competitive examinations.'),
('Business Management Basics','P. Kotler',7,600,14,'💼','Core concepts of business management.'),
('The Alchemist','Paulo Coelho',8,399,18,'📖','A popular inspirational novel.'),
('School Science Handbook','NCERT Guide',5,299,40,'🔬','Study companion for school learners.'),
('Financial Accounting','S. P. Jain',6,650,16,'📊','Accounting concepts and examples.'),
('Atomic Habits','James Clear',8,599,20,'📘','Practical ideas for building habits.');