CREATE TABLE student_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    course_id VARCHAR(20) NOT NULL,
    course_name VARCHAR(255) NOT NULL,
    year_section VARCHAR(20) NOT NULL,
    action_taken VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL
);
