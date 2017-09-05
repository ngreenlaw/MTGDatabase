/*Nathan Greenlaw
CS 340
Final Project: MTG database*/

/*Create the tables*/

/*Deck table*/
DROP TABLE IF EXISTS `built`;
DROP TABLE IF EXISTS `cards`;
DROP TABLE IF EXISTS `sets`;
DROP TABLE IF EXISTS `decks`;
DROP TABLE IF EXISTS `themes`;


CREATE TABLE decks(

id int NOT NULL AUTO_INCREMENT,

name varchar(255) NOT NULL,

color varchar(255),

cardCount int,

playFormat varchar(255),

PRIMARY KEY (id),

UNIQUE KEY (name)

)ENGINE=Innodb;

/*Theme table*/

CREATE TABLE themes(

id int NOT NULL AUTO_INCREMENT,

block varchar(255) NOT NULL,

inspiration varchar(255),

PRIMARY KEY (id),

UNIQUE KEY (block)

)ENGINE=Innodb;

/*Sets Table*/

CREATE TABLE sets(

id int NOT NULL AUTO_INCREMENT,

name varchar(255) NOT NULL,

cardCount int,

block varchar(255),

releaseDate date,

PRIMARY KEY (id),

UNIQUE KEY (name),

FOREIGN KEY (block)
	REFERENCES themes(block)
	ON DELETE CASCADE

)ENGINE=Innodb;

/*Cards table*/

CREATE TABLE cards(

id int NOT NULL AUTO_INCREMENT,

name varchar(255) NOT NULL,

cardType varchar(255),

cost int,

color varchar(255),

rarity varchar(255),

setName varchar(255),

deckName varchar(255),

PRIMARY KEY (id),

UNIQUE KEY (name),

FOREIGN KEY (setName)
	REFERENCES sets(name)
	ON DELETE CASCADE,
	
FOREIGN KEY (deckName)
	REFERENCES decks(name)
	ON DELETE CASCADE

)ENGINE=Innodb;

/*Built table Set to Deck Many to Many relationship*/

CREATE TABLE built(

setName varchar(255),

deckName varchar(255),

UNIQUE KEY (setName,deckName),

FOREIGN KEY (setName)
	REFERENCES sets(name)
	ON DELETE CASCADE,
	
FOREIGN KEY (deckName)
	REFERENCES decks(name)
	ON DELETE CASCADE

)ENGINE=Innodb;
