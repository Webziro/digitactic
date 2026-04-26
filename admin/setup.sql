-- Admins table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Content table for editable sections
CREATE TABLE IF NOT EXISTS site_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(50) NOT NULL UNIQUE,
    content TEXT NOT NULL
);

-- Example insert for admin (replace password hash with output from password_hash)
INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$REPLACE_WITH_HASHED_PASSWORD');

-- Example inserts for content sections
INSERT INTO site_content (section, content) VALUES
('hero', 'Default hero section text'),
('who_we_are', 'Default who we are text'),
('about_us', 'Default about us text'),
('impacts', 'Default impacts text');
