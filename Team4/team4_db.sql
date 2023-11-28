/*DROP DATABASE team4_db;*/
CREATE DATABASE team4_db;
USE team4_db;

CREATE TABLE users (
  id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  user_type enum('user','admin') NOT NULL DEFAULT 'admin',
  image varchar(100) NOT NULL
) ;
/*INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES ('2', 'x', 'x@gmail.com', '1234', 'user', 'pic-4.png');
ALTER TABLE users MODIFY user_type enum('user','admin') NOT NULL DEFAULT 'user' ;
*/
ALTER TABLE users MODIFY id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;

CREATE TABLE `products` (
  `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) AUTO_INCREMENT = 1;


CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ;
ALTER TABLE `cart` MODIFY id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 1;

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  FOREIGN KEY (`id`) REFERENCES `products`(`id`)
);

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ;

CREATE TABLE `repair` LIKE `message`;

ALTER TABLE `repair`
ADD COLUMN `status` VARCHAR(20) NOT NULL DEFAULT 'Pending';

CREATE TABLE `maintenance` (
    `MaintenanceID` INT PRIMARY KEY,
    `id` INT,
    `MaintenanceType` VARCHAR(255),
    `LastMaintenanceDate` DATE,
    `NextMaintenanceDate` DATE,
    `Details` TEXT,
    FOREIGN KEY (`id`) REFERENCES `products`(`id`)
);

-- Create a trigger BEFORE INSERT on the `message` table
DELIMITER //
CREATE TRIGGER before_message_insert
BEFORE INSERT ON `message`
FOR EACH ROW
BEGIN
  -- Insert a corresponding record into the `repair` table
  INSERT INTO `repair` (id, user_id, name, email, number, message, status)
  VALUES (NEW.id, NEW.user_id, NEW.name, NEW.email, NEW.number, NEW.message, 'Pending');
END;
//
DELIMITER ;

-- Create a trigger AFTER DELETE on the `repair` table
DELIMITER //
CREATE TRIGGER after_repair_delete
AFTER DELETE ON `repair`
FOR EACH ROW
BEGIN
  -- Delete the corresponding record from the `message` table
  DELETE FROM `message` WHERE id = OLD.id;
END;
//
DELIMITER ;
