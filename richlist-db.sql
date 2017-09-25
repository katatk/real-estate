-- drop table if it already exists and rebuild it --

DROP DATABASE beautzo8_richlist;

CREATE DATABASE beautzo8_richlist;

USE beautzo8_richlist;

-- create tables --

CREATE TABLE property_type (
Type VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE cities (
City VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE user_roles (
Role VARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE users (
Email_Address VARCHAR(80) NOT NULL PRIMARY KEY,
First_Name VARCHAR(20) NOT NULL,
Password VARCHAR(255) NOT NULL,
Role VARCHAR(20) NOT NULL,
FOREIGN KEY (Role) REFERENCES user_role(Role)
);

CREATE TABLE properties (
Property_ID INT(3) ZEROFILL NOT NULL PRIMARY KEY,
Title VARCHAR(80) NOT NULL,
Type VARCHAR(20) NOT NULL,
City VARCHAR(20) NOT NULL,
Price DOUBLE(8,2) NOT NULL,
Address VARCHAR(255) NOT NULL,
Description TEXT NOT NULL,
FOREIGN KEY (Type) REFERENCES property_type(Type),
FOREIGN KEY (City) REFERENCES city(City)  
);

CREATE TABLE user_wishlist (
Email_Address VARCHAR(80) NOT NULL,
Property_ID INT(3) ZEROFILL NOT NULL,
PRIMARY KEY (Email_Address, Property_ID)
);

-- add data --
INSERT INTO property_type (Type)
VALUES ('Section'), ('House');

INSERT INTO cities (City)
VALUES ('Auckland'), ('Hamilton'), ('Tauranga');

INSERT INTO user_roles (Role)
VALUES ('Admin'), ('User');



