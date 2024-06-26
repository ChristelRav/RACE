CREATE USER raceu WITH PASSWORD 'race';
CREATE DATABASE race;
GRANT ALL PRIVILEGES ON DATABASE race TO raceu;

psql -U raceu -d race

CREATE TABLE admin (
    id_amdin SERIAL PRIMARY KEY,
    email VARCHAR(255),
    mot_passe VARCHAR(45)
);

CREATE TABLE equipe (
    id_equipe SERIAL PRIMARY KEY,
    nom VARCHAR(255),
    pseudo VARCHAR(255),
    mot_passe VARCHAR(45)
);

CREATE TABLE categorie (
    id_categorie SERIAL PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE coureur (
    id_coureur SERIAL PRIMARY KEY,
    id_equipe INT REFERENCES equipe(id_equipe),
    nom VARCHAR(255) DEFAULT 'Koto Arihaja',
    num_dossard INT UNIQUE,
    genre VARCHAR(50) DEFAULT 'F', --(1):homme  ,(5):femme
    date_naissance DATE
);

CREATE TABLE etape (
    id_etape SERIAL PRIMARY KEY,
    nom VARCHAR(255) DEFAULT 'Tsimbazaza',
    longueur DOUBLE PRECISION,
    nbr_coureur INT DEFAULT 1,
    rang INT DEFAULT 1,
    date_etape DATE DEFAULT CURRENT_DATE,
    heure_depart TIME DEFAULT '07:00:00',
    duree_limite TIME DEFAULT '01:00:00'
);

CREATE TABLE coureur_categorie (
    id_coureur_categorie SERIAL PRIMARY KEY,
    id_coureur INT REFERENCES coureur(id_coureur),
    id_categorie INT REFERENCES categorie(id_categorie)
);

CREATE TABLE coureur_etape (
    id_coureur_etape SERIAL PRIMARY KEY,
    id_etape INT REFERENCES etape(id_etape),
    id_coureur INT REFERENCES coureur(id_coureur),
    heure_depart TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    heure_arrive TIMESTAMP DEFAULT (CURRENT_DATE + TIME '00:00:00')
);

CREATE TABLE point_etape (
    id_point_etape SERIAL PRIMARY KEY,
    rang INT,
    point DOUBLE PRECISION DEFAULT 0.0
);

CREATE TABLE temp1 (
    etape_rang INT,
    numero_dossard INT,
    nom VARCHAR(255),
    genre VARCHAR(50),
    date_naissance DATE,
    equipe VARCHAR(50),
    arrivee TIMESTAMP
);

CREATE TABLE temp2(
    classement INT,
    points DOUBLE PRECISION
);

CREATE TABLE temp3(
    etape VARCHAR(255),
    longueur DOUBLE PRECISION,
    nb_coureur INT,
    rang INT,
    date_depart DATE,
    heure_depart TIME
);

CREATE TABLE penalite (
    id_penalite SERIAL PRIMARY KEY,
    id_etape INT REFERENCES etape(id_etape),
    id_equipe INT REFERENCES equipe(id_equipe),
    temps_penalite TIME DEFAULT '00:00:00'
);