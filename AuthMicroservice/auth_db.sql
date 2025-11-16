-- auth_db.sql

CREATE DATABASE IF NOT EXISTS `auth_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `auth_db`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'user',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert an example user (password = Password123!)
-- NOTE: replace the hashed password with the output of password_hash('Password123!', PASSWORD_DEFAULT)
INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES
('admin', 'admin@example.com', '$2y$10$OzOE5bBAUYt1uIrC56k8IOrikgLulxNbrUaXdlxcrlNHfOWcXh84C', 'admin');
