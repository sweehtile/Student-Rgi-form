CREATE DATABASE IF NOT EXISTS `stu_regi_form`;
USE `stu_regi_form`;

CREATE TABLE IF NOT EXISTS `students` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `father_name` VARCHAR(100) NOT NULL,
    `dob_day` INT(2) NOT NULL,
    `dob_month` INT(2) NOT NULL,
    `dob_year` INT(4) NOT NULL,
    `mobile_no` VARCHAR(15) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `gender` ENUM('Male', 'Female') NOT NULL,
    `department` VARCHAR(255) DEFAULT NULL,
    `course` VARCHAR(20) NOT NULL,
    `city` VARCHAR(100) NOT NULL,
    `address` TEXT NOT NULL,
    PRIMARY KEY (`id`)
);