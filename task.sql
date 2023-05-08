DROP DATABASE IF EXISTS planning;

CREATE DATABASE IF NOT EXISTS planning;

USE planning;

CREATE TABLE task (
  id INT PRIMARY KEY AUTO_INCREMENT,
  title varchar(50) NOT NULL,
  description varchar(150) NOT NULL,
  completed BOOLEAN DEFAULT FALSE
);

INSERT INTO task (title, description) VALUES ('Faire les courses', 'test'), ('Appeler le plombier', 'test');