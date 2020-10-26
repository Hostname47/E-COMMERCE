-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 07:53 PM
-- Server version: Apache/2.4.46 (Win64) OpenSSL/1.1.1g PHP/7.4.11 Server at localhost Port 443
-- PHP Version: 7.4.11

CREATE DATABASE ECOM;

CREATE TABLE user_info
(
  user_id int primary key AUTO_INCREMENT,
  user_name varchar(100),
  first_name varchar(100),
  last_name varchar(100),
  email varchar(300),
  password varchar(300),
  mobile varchar(100),
  address text,
  user_type int NOT NULL REFERENCE user_type(id)
)

-- Admine can later add categories
INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'All'),
(2, 'Electronics'),
(3, 'Books'),
(4, 'Computers'),
(5, 'Sports $ Outdours'),
(6, 'Furnitures'),
(7, 'Video Games'),
(8, 'Electronics Gadgets'),
(9, 'Tools & Home Improvement');

CREATE TABLE Category
(
	categoryID int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    categoryName varchar(200) NOT NULL,
    description text NOT NULL,
    picture text,
    active int NOT NULL
)

CREATE TABLE `brands` (
  `brand_id` int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `brand_title` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `products` (
  `product_id` int(100) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `product_cat` int NOT NULL REFERENCES categories(cat_id),
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE Customer
(
    customerID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstname varchar(200) NOT NULL,
    lastname varchar(200) NOT NULL,
    address1 varchar(300) NOT NULL,
    address2 varchar(300) NOT NULL,
    city varchar(100) NOT NULL,
    postalCode varchar(40) NOT NULL,
    email varchar(300) NOT NULL,
    password varchar(300) NOT NULL,
    creditCard varchar(200),
    creditCardTypeID int NOT NULL,
    CardExpYr varchar(100),
    CardExpMo varchar(100),
    dateEntered DATETIME NOT NULL DEFAULT NOW()
)

CREATE TABLE Supplier
(
    supplierID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    companyName varchar(300) NOT NULL,
    contactFname varchar(300) NOT NULL,
    contactLname varchar(300) NOT NULL,
    address1 text NOT NULL,
    address2 text,
    city varchar(300) NOT NULL,
    postalCode varchar(300) NOT NULL,
    email varchar(300) NOT NULL,
    paymentMethods varchar(400),
    typeGoods varchar(300),
    discountAvailable varchar(20),
    logo text NOT NULL
)

CREATE TABLE Products
(
	productID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    SKU varchar(200) NOT NULL UNIQUE,
    productName varchar(500) NOT NULL,
    productDescription text,
    supplierID int NOT NULL REFERENCES supplier(supplierID),
    categoryID int NOT NULL REFERENCES category(categoryID),
    unitPrice DECIMAL(10,2) NOT NULL,
    availableSizes varchar(300),
    availableColors varchar(300),
    size varchar(200),
    color varchar(200),
    discount varchar(200),
    unitWeight DECIMAL(10,2),
    UnitsInStock int NOT NULL,
    UnitsOnOrder int NOT NULL,
    productAvailable varchar(20) NOT NULL,
    picture text
    
)

