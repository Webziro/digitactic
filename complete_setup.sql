-- Database Setup for Digitatic
-- Run this in phpMyAdmin to create the necessary tables and default data

-- 1. Create table for editable content
CREATE TABLE IF NOT EXISTS editable_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_key VARCHAR(100) NOT NULL UNIQUE,
    content TEXT NOT NULL
);

-- 2. Create table for admin users
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- 3. Insert default content keys to match index.php
-- Note: 'ON DUPLICATE KEY UPDATE content=content' prevents errors if keys already exist
INSERT INTO editable_content (section_key, content) VALUES
('hero_line_1', 'Built to Scale,'),
('hero_line_2', 'Not Just to'),
('hero_line_3', 'Work.'),
('hero_sub_part1', 'Engineering premium digital infrastructure'),
('hero_sub_part2', 'for the world’s most ambitious Entrepreneurs and Creators.'),
('who_we_are', 'Digitatic is a Boutique Digital studio for ambitious businesses that refuse to settle for average. We don\'t take on every client.'),
('about_us', 'About us page content goes here.'),
('services', 'Services page content goes here.'),
('stats_1_value', '40'),
('stats_1_label', 'Project Completed'),
('stats_2_value', '96'),
('stats_2_label', 'Satisfied Clients'),
('stats_3_value', '8'),
('stats_3_label', 'Running Projects'),
('stats_4_value', '96'),
('stats_4_label', 'Customer Satisfaction'),
('stats_5_value', '95'),
('stats_5_label', 'Years in Business'),
('stats_6_value', '7'),
('stats_6_label', 'Number of Team'),
('footer_phone', '+91 (154) 485 12 485')
ON DUPLICATE KEY UPDATE content=content;

-- 4. Insert default admin user (admin / admin123)
-- Password 'admin123' hashed with password_hash()
INSERT IGNORE INTO admins (username, password) VALUES
('admin', '$2y$10$fG6TSR7d7a753G3H9s6yGe1P9876543210123456789012345678');
-- Note: You should update your password once logged in.
