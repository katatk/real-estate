-- drop table if it already exists and rebuild it --

DROP DATABASE IF EXISTS real_estate;

CREATE DATABASE real_estate;

USE real_estate;

-- create tables --

CREATE TABLE property_type (
Type VARCHAR(20) NOT NULL PRIMARY KEY
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE cities (
City VARCHAR(20) NOT NULL PRIMARY KEY
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE user_roles (
Role VARCHAR(20) NOT NULL PRIMARY KEY
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

CREATE TABLE users (
Email_Address VARCHAR(80) NOT NULL PRIMARY KEY,
First_Name VARCHAR(20) NOT NULL,
Password VARCHAR(255) NOT NULL,
Role VARCHAR(20) NOT NULL,
FOREIGN KEY (Role) REFERENCES user_roles(Role)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;


CREATE TABLE properties (
Property_ID INT(3) ZEROFILL NOT NULL AUTO_INCREMENT PRIMARY KEY,
Image_URL TEXT(500) NOT NULL,
Title VARCHAR(80) NOT NULL,
Type VARCHAR(20) NOT NULL,
City VARCHAR(20) NOT NULL,
Price INT(8) NOT NULL,
Address VARCHAR(255) NOT NULL,
Description TEXT NOT NULL,
FOREIGN KEY (Type) REFERENCES property_type(Type),
FOREIGN KEY (City) REFERENCES cities(City)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;


CREATE TABLE user_wishlist (
Email_Address VARCHAR(80) NOT NULL,
Property_ID INT(3) ZEROFILL NOT NULL,
PRIMARY KEY (Email_Address, Property_ID)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

-- add data --
INSERT INTO property_type (Type)
VALUES ('Section'), ('House');

INSERT INTO cities (City)
VALUES ('Auckland'), ('Hamilton'), ('Tauranga');

INSERT INTO user_roles (Role)
VALUES ('Admin'), ('User'), ('Agent');

INSERT INTO properties (Image_URL, Title, Type, City, Price, Address, Description)
VALUES ('images/properties/auckland-house.jpg', '1053B Whangaparaoa Road', 'House', 'Auckland', 2495000, '1053B Whangaparaoa Road, Auckland', 'Masterfully positioned and thoughtfully designed to capture the stunning views, this dramatic, brand new family home has been tailor made for the discerning.'),
('images/properties/auckland-section.jpg', '18 Boocock Cres', 'Section', 'Auckland', 649000, '18 Boocock Cres', 'This flat section is 788 m2 more or less is the most elevated of the Grant Terraces development with a north facing backyard.'), 
('images/properties/hamilton-house.jpg', '1049 River Road', 'House', 'Hamilton', 2250000, '1049 River Road, Hamilton', 'It is our pleasure to present this quality home at its exclusive address. From the moment you walk in the door of 1049 River Road you know you are about to view something extraordinary and you will want to own and experience this home for a lifetime.'),
('images/properties/auckland-section.jpg', 'Lot 2 Borman Road', 'Section', 'Hamilton', 800000, 'Lot 2 Borman Road', 'Large Greenfield site in the heart of the booming north-east Hamilton suburbs. Zoned for the new Rototuna Junior and Senior High Schools, and in proximity to the expressway and planned new mega town centre in Rototuna'),
('images/properties/tauranga-house.jpg', '18 Royal Ascot Drive', 'House', 'Tauranga', 2790000, '18 Royal Ascot Drive, Tauranga', 'Welcome to 26 Pillans Road, the pinnacle of luxury residential living, positioned in the beautiful suburb of Otumoetai and the growing city of Tauranga.'),
('images/properties/auckland-section.jpg', '1 Papamoa Beach Road', 'Section', 'Tauranga', 775000, '1 Papamoa Beach Road, Tauranga', 'A large corner site of 574m² with a 16m wide frontage facing the coastal reserve and 38m long offering loads of room for off-street parking')



