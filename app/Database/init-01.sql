CREATE DATABASE Regime;
use Regime

CREATE TABLE role(
    id INT PRIMARY KEY AUTO_INCREMENT,
    role VARCHAR(10)
);

CREATE TABLE user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100),
    genre VARCHAR(10),
    password_hash VARCHAR(100),
    id_role INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_role) REFERENCES role(id)
);

CREATE TABLE profil(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    telephone INT,
    date_naissance TIMESTAMP,

    FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE suivi_sante(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    poids FLOAT,
    taille FLOAT,
    date_suivi TIMESTAMP,

    FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE activite_sportive(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100),
    variation_poids FLOAT,
    frequence FLOAT
);

CREATE TABLE regime(
    id INT PRIMARY KEY AUTO_INCREMENT,
    perc_viande FLOAT,
    perc_poisson FLOAT,
    perc_volaille FLOAT,
    variation_poids FLOAT,
    duree FLOAT,
    price FLOAT
);

CREATE TABLE objectif(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label TEXT
);

CREATE TABLE objectif_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_objectif INT,
    date_objectif TIMESTAMP,
    valeur INT,

    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_objectif) REFERENCES objectif(id)
);

CREATE TABLE code(
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50),
    montant FLOAT
);

CREATE TABLE porte_monnaie(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    montant FLOAT DEFAULT 0,

    FOREIGN KEY (id_user) REFERENCES user(id)
);

CREATE TABLE config(
    id INT PRIMARY KEY AUTO_INCREMENT,
    cle VARCHAR(50),
    valeur FLOAT
);

CREATE TABLE type_abonnement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(20),
    montant FLOAT,
    perc_reduction FLOAT
);

CREATE TABLE type_abonnement_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_abonnement INT DEFAULT 1,
    date_abonnement TIMESTAMP,

    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_abonnement) REFERENCES type_abonnement(id)
);

CREATE TABLE regime_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_regime INT,
    date_regime TIMESTAMP,

    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_regime) REFERENCES regime(id)
);

CREATE TABLE code_user(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    code VARCHAR(50),
    statut VARCHAR(20),
    date_track TIMESTAMP,

    FOREIGN KEY (id_user) REFERENCES user(id)
);