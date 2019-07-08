CREATE DATABASE quiz;
USE quiz;

CREATE TABLE utenti(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(40) NOT NULL
);

CREATE TABLE quiz(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titolo VARCHAR(64) NOT NULL,
  descrizione VARCHAR(256),
  data_creazione DATE NOT NULL
);

CREATE TABLE domande(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  descrizione VARCHAR(256) NOT NULL,
  id_quiz INT NOT NULL,
  FOREIGN KEY (id_quiz) REFERENCES quiz (id)
);

CREATE TABLE risposte(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  contenuto VARCHAR(512) NOT NULL,
  id_domanda INT NOT NULL,
  id_utente INT NOT NULL,
  FOREIGN KEY (id_domanda) REFERENCES domanda (id),
  FOREIGN KEY (id_utente) REFERENCES utenti (id)
);
