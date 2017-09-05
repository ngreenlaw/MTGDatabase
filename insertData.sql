-- Nathan Greenlaw
-- CS 340
-- Final Project: MTG database

-- decks
INSERT INTO decks (name, color, playFormat, cardCount)
	VALUES
	('clues','blue/green/white','standard',60);

INSERT INTO decks (name, color, playFormat, cardCount)
	VALUES
	('angels','black/white','standard',64);
	
INSERT INTO decks (name, color, playFormat, cardCount)
	VALUES
	('pouncing cheetah','green/black','limited',40);

-- themes

INSERT INTO themes( block, inspiration ) 
VALUES (
'kaladesh',  'indian steampunk'
);

INSERT INTO themes( block, inspiration ) 
VALUES (
'shadows over innistrad',  'gothic horror'
);

INSERT INTO themes( block, inspiration ) 
VALUES (
'amonkhet',  'ancient egypt'
);

-- sets
INSERT INTO sets( name, cardCount, block, releaseDate ) 
VALUES (
'shadows over innistrad', 297, (

SELECT block
FROM themes
WHERE block =  'shadows over innistrad'
),  '2016-04-02'
);

INSERT INTO sets( name, cardCount, block, releaseDate ) 
VALUES (
'eldritch moon', 205, (

SELECT block
FROM themes
WHERE block =  'shadows over innistrad'
),  '2016-07-22'
);

INSERT INTO sets( name, cardCount, block, releaseDate ) 
VALUES (
'amonkhet', 264, (

SELECT block
FROM themes
WHERE block =  'amonkhet'
),  '2017-04-28'
);

-- cards

INSERT INTO cards( name, cardType, cost, color, rarity, setName, deckName ) 
VALUES (
'Graf Mole',  'creature', 3,  'green',  'uncommon', (

SELECT name
FROM sets
WHERE name =  'shadows over innistrad'
), (

SELECT name
FROM decks
WHERE name =  'clues'
)
);

INSERT INTO cards( name, cardType, cost, color, rarity, setName, deckName ) 
VALUES (
'Hapatras Mark',  'instant', 1,  'green',  'uncommon', (

SELECT name
FROM sets
WHERE name =  'amonkhet'
), (

SELECT name
FROM decks
WHERE name =  'pouncing cheetah'
)
);

INSERT INTO cards( name, cardType, cost, color, rarity, setName, deckName ) 
VALUES (
'Gisela, the Broken Blade',  'creature', 4,  'white',  'mythic', (

SELECT name
FROM sets
WHERE name =  'eldritch moon'
), (

SELECT name
FROM decks
WHERE name =  'angels'
)
);

-- built table

INSERT INTO built( setName,deckName ) 
VALUES (
'amonkhet','pouncing cheetah');

INSERT INTO built( setName,deckName ) 
VALUES (
'shadows over innistrad','clues');

INSERT INTO built( setName,deckName ) 
VALUES (
'eldritch moon','clues');

/* select all decks for a set
SELECT b.setName, name as deck
FROM built b
INNER JOIN decks d ON d.name = b.deckName
WHERE b.setName =  "Shadows over innistrad";
*/

/*select all sets for a given deck
SELECT b.deckName, name as set_name
FROM built b
INNER JOIN sets s ON s.name = b.setName
WHERE b.deckName =  "clues";
*/