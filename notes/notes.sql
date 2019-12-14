CREATE DATABASE matchmaker;
USE matchmaker;

CREATE TABLE Person(
  person_id int NOT NULL AUTO_INCREMENT,
  first_name varchar(50) NOT NULL,
  last_name varchar(50) NOT NULL,
  nickname varchar(25) NOT NULL,
  button_clicks int DEFAULT 0,
  anonymous varchar(1) NOT NULL DEFAULT 1,
  url_code varchar(25) NOT NULL,
  PRIMARY KEY (person_id)
);

CREATE TABLE Visit (
  visit_id int NOT NULL AUTO_INCREMENT,
  person_id int NOT NULL,
  browser varchar(100), 
  is_remote varchar(1),
  time_log varchar(100), 
  PRIMARY KEY(visit_id),
  FOREIGN KEY (person_id) REFERENCES Person(person_id)
);

CREATE TABLE Creds (
  creds_id int NOT NULL AUTO_INCREMENT,
  person_id int NOT NULL,
  username varchar(100),
  password varchar(200),
  time_log varchar(100),
  PRIMARY KEY (creds_id),
  FOREIGN KEY (person_id) REFERENCES Person(person_id)
);
