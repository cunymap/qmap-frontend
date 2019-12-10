-- Create user table
CREATE TABLE dmap_users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    institute_id VARCHAR(10) NOT NULL,
    created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create a default admin with password: dmap2019
INSERT INTO dmap_users (username, password, institute_id) VALUES ('admin', '$2y$10$BU/3O7t8p48HA24conWaKOUZ93/2hvpH0QSFuLQfvYRiQGokjZM/O', '0');
