CREATE DATABASE IF NOT EXISTS vneddy CHARACTER SET UTF8;

USE vneddy;

CREATE TABLE IF NOT EXISTS article(
	id INT UNSIGNED AUTO_INCREMENT,
	title CHAR(100) NOT NULL,
	author CHAR(50) NOT NULL,
	url VARCHAR(255),
	content TEXT NOT NULL,
	pubTime INT UNSIGNED NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS gossip(
	id INT UNSIGNED AUTO_INCREMENT,
	content TEXT NOT NULL,
	pubTime INT UNSIGNED NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS message(
	id INT UNSIGNED AUTO_INCREMENT,
	content TEXT NOT NULL,
	tmpuser CHAR(50) NOT NULL,
	sex CHAR(6) NOT NULL,
	pubTime INT UNSIGNED NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS article_message(
	id INT UNSIGNED AUTO_INCREMENT,
	article_id INT NOT NULL,
	content TEXT NOT NULL,
	tmpuser CHAR(50) NOT NULL,
	sex CHAR(6) NOT NULL,
	pubTime INT UNSIGNED NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS admin(
	id INT UNSIGNED AUTO_INCREMENT,
	username CHAR(50) NOT NULL,
	password CHAR(50) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS about(
	id INT UNSIGNED AUTO_INCREMENT,
	content TEXT NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS photo(
	id INT UNSIGNED AUTO_INCREMENT,
	url VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
) ENGINE = InnoDB;
