-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 07:53 PM
-- Server version: Apache/2.4.46 (Win64) OpenSSL/1.1.1g PHP/7.4.11 Server at localhost Port 443
-- PHP Version: 7.4.11

CREATE DATABASE ECOM;

CREATE TABLE `categories` (
  `cat_id` int primary key NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

