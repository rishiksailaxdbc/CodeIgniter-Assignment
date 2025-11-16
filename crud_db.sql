-- This file will create database 'crud_db' and table 'items'
-- Run this file in SQL tab in <server/localhost>/phpmyadmin

CREATE DATABASE IF NOT EXISTS `crud_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crud_db`;

CREATE TABLE `items` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `price` DECIMAL(10,2),
  `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Seed Data (5 items)
INSERT INTO `items` (`name`, `description`, `price`)
VALUES
('item1', 'This is the description of item1', 1.00),
('item2', 'This is the description of item2', 2.00),
('item3', 'This is the description of item3', 3.00),
('item4', 'This is the description of item4', 4.00),
('item5', 'This is the description of item5', 5.00);
