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

CREATE TABLE products (
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
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
);

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ;
