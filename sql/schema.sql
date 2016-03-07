DROP DATABASE IF EXISTS ShoppingSite;

CREATE DATABASE IF NOT EXISTS ShoppingSite;

USE ShoppingSite;

CREATE TABLE IF NOT EXISTS Categories (
	category_id int NOT NULL,
	category_name varchar(30),
	PRIMARY KEY(category_id)
);

CREATE TABLE IF NOT EXISTS Brands (
	brand_id int NOT NULL,
	brand_name varchar(30),
	PRIMARY KEY(brand_id)
);

CREATE TABLE IF NOT EXISTS Products (
	product_id int NOT NULL,
	product_name varchar(30),
	product_category int,
	product_brand int,
	product_price decimal(19,4),
	product_image varbinary(65000),
	product_keywords text,
	product_description text,
	PRIMARY KEY(product_id),
	FOREIGN KEY (product_category) REFERENCES Categories(category_id),
	FOREIGN KEY (product_brand) REFERENCES Brands(brand_id)
);
CREATE TABLE IF NOT EXISTS Cart (
	cart_id int NOT NULL,
	cart_name varchar(30),
	PRIMARY KEY(cart_id)
);
CREATE TABLE IF NOT EXISTS Customers (
	customer_id int NOT NULL,
	customer_name varchar(30),
	PRIMARY KEY(customer_id)
);
CREATE TABLE IF NOT EXISTS Orders (
	order_id int NOT NULL,
	order_name varchar(30),
	PRIMARY KEY(order_id)
);
CREATE TABLE IF NOT EXISTS Admin (
	admin_id int NOT NULL,
	admin_name varchar(30),
	PRIMARY KEY(admin_id)
);
CREATE TABLE IF NOT EXISTS Payments (
	payment_id int NOT NULL,
	payment_name varchar(30),
	PRIMARY KEY(payment_id)
);