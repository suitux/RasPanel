
/* Database: */
CREATE DATABASE raspanel;
use raspanel;

/* User: */
CREATE USER 'raspuser'@'localhost' 
	IDENTIFIED BY 'raspuser';
/* Privileges: */
GRANT ALL PRIVILEGES ON raspanel.* to 'raspuser'@'localhost';


/* Tables: */
DROP TABLE IF EXISTS log;
DROP TABLE IF EXISTS privileges;
DROP TABLE IF EXISTS user;


/**
 * Table that contains the users of the Raspanel
 */
CREATE TABLE user (
	id 			INT(11)		NOT NULL 	AUTO_INCREMENT,		/*ID*/
	name 		VARCHAR(40) NOT NULL 	UNIQUE,				/*Username*/
 	mail 		VARCHAR(64) NOT NULL	UNIQUE,				/*Mail*/
 	phone 		INT(11) 	NOT NULL,						/*Phone*/
 	hash	 	CHAR(128) 	NOT NULL,						/*Password*/
 	isin 		TINYINT(1)	NOT NULL,						/*If the user is logged: true. Else: False*/
 	PRIMARY KEY(id)											/*Primary key: ID*/
) ENGINE=INNODB;

/**
 * Table that contains the privileges to access to the different parts of the application
 */
CREATE TABLE privileges (
	status		TINYINT(1)	NOT NULL	DEFAULT 1, 			/*Information Panel*/
	files		TINYINT(1) 	NOT NULL	DEFAULT 1,			/*Network Panel*/
	shell		TINYINT(1) 	NOT NULL	DEFAULT 0,			/*Shell Panel*/
	config 		TINYINT(1) 	NOT NULL	DEFAULT 0, 			/*User ID*/
	userid		INT(11), 
	FOREIGN KEY(userid) REFERENCES user(id) ON DELETE CASCADE
) ENGINE=INNODB;

/**
 * Table that contains the logs of the Raspanel
 * Log level: 4: SEVERE 3: WARNING 2: INFO 1: CONFIG 0: FINE
 */
CREATE TABLE log (
	id 			INT(10)			NOT NULL 	AUTO_INCREMENT, 	/*ID*/
	level		int(2)			NOT NULL	CHECK (level = 0 or level = 1 or level = 2 or level = 3 or level = 4),	
	message		VARCHAR(128)	NOT NULL,						/*Message of the log*/
	PRIMARY KEY(id)												/*Primary key: ID*/
) ENGINE=INNODB;