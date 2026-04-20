-- Run this in phpMyAdmin after creating your database
CREATE TABLE IF NOT EXISTS editable_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_key VARCHAR(100) NOT NULL UNIQUE,
    content TEXT NOT NULL
);

-- Insert default content for each section (edit as needed)
INSERT INTO editable_content (section_key, content) VALUES
('hero_headline', 'Built to Scale, <br> <span class="no-underline inner--element customized--word elementor-repeater-item-806b59e">Not Just to</span><br> Work.'),
('hero_subheadline', 'Engineering premium digital infrastructure </span> for the world’s most ambitious Entrepreneurs and Creators.'),
('who_we_are', 'Digitatic is a Boutique Digital studio for ambitious businesses that refuse to settle for average. We don\'t take on every client.'),
('about_us', 'About us page content goes here.'),
('services', 'Services page content goes here.');
