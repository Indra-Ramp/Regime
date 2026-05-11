-- =========================
-- INSERTION DES ROLES
-- =========================
INSERT INTO role(role) VALUES
('admin'),
('user');

-- =========================
-- INSERTION DES UTILISATEURS
-- =========================
INSERT INTO user(nom, prenom, email, genre, password_hash, id_role, created_at) VALUES
('Rakoto', 'Jean', 'jean@gmail.com', 'Homme', '1234', 2, '2026-01-10 08:30:00'),
('Rasoanaivo', 'Sarah', 'sarah@gmail.com', 'Femme', '1234', 2, '2026-01-15 10:15:00'),
('Randria', 'Lucas', 'lucas@gmail.com', 'Homme', '1234', 2, '2026-02-02 14:20:00'),
('Andry', 'Emma', 'emma@gmail.com', 'Femme', '1234', 2, '2026-02-18 09:45:00'),
('Rabe', 'Kevin', 'kevin@gmail.com', 'Homme', '1234', 1, '2026-03-01 16:10:00');

-- =========================
-- INSERTION DES PROFILS
-- =========================
INSERT INTO profil(id_user, telephone, date_naissance) VALUES
(1, 340000001, '2000-01-15'),
(2, 340000002, '1999-05-20'),
(3, 340000003, '2001-07-11'),
(4, 340000004, '1998-03-08'),
(5, 340000005, '1997-12-25');

-- =========================
-- INSERTION DES SUIVIS SANTE
-- =========================
INSERT INTO suivi_sante(id_user, poids, taille, date_suivi) VALUES
(1, 70, 1.75, NOW()),
(2, 58, 1.65, NOW()),
(3, 82, 1.80, NOW()),
(4, 64, 1.70, NOW()),
(5, 90, 1.78, NOW());

-- =========================
-- INSERTION DES ACTIVITES SPORTIVES
-- =========================
INSERT INTO activite_sportive(label, variation_poids, frequence) VALUES
('Course a pied', -2.5, 4),
('Musculation', 1.5, 5),
('Natation', -1.8, 3),
('Cyclisme', -2.0, 4),
('Yoga', -0.5, 2);

-- =========================
-- INSERTION DES REGIMES
-- =========================
INSERT INTO regime(
    perc_viande,
    perc_poisson,
    perc_volaille,
    variation_poids,
    duree,
    price
) VALUES
(40, 20, 40, -3, 1, 5000),
(20, 50, 30, -2, 4, 6500),
(10, 20, 70, 1, 2, 7000),
(0, 80, 20, -4, 3, 9000),
(50, 10, 40, 2, 3, 4500);

-- =========================
-- INSERTION DES OBJECTIFS
-- =========================
INSERT INTO objectif(label) VALUES
('Perte de poids'),
('Augmentation de poids')
('Atteindre mon IMC ideal');

-- =========================
-- INSERTION DES OBJECTIFS UTILISATEURS
-- =========================
INSERT INTO objectif_user(id_user, id_objectif, date_objectif, valeur) VALUES
(1, 1, NOW(), -5),
(2, 3, NOW(), 8),
(3, 2, NOW(), 0),
(4, 3, NOW(), 0),
(5, 1, NOW(), -10);

-- =========================
-- INSERTION DES CODES
-- =========================
INSERT INTO code(code, montant) VALUES
('CODE001', 5000),
('CODE002', 10000),
('CODE003', 15000),
('CODE004', 20000),
('CODE005', 25000),
('CODE006', 30000),
('CODE007', 35000),
('CODE008', 40000),
('CODE009', 45000),
('CODE010', 50000),
('CODE011', 55000),
('CODE012', 60000),
('CODE013', 65000),
('CODE014', 70000),
('CODE015', 75000);

-- =========================
-- INSERTION DES PORTE-MONNAIE
-- =========================
INSERT INTO porte_monnaie(id_user, montant) VALUES
(1, 100000),
(2, 50000),
(3, 120000),
(4, 80000),
(5, 150000);

-- =========================
-- INSERTION DES CONFIGURATIONS
-- =========================
INSERT INTO config(cle, valeur) VALUES
('standard', 0),
('gold', 20);

-- =========================
-- INSERTION DES TYPES ABONNEMENTS
-- =========================
INSERT INTO type_abonnement(label, montant, perc_reduction) VALUES
('Standard', 0, 0),
('Gold', 50000, 10);

-- =========================
-- INSERTION DES ABONNEMENTS UTILISATEURS
-- =========================
INSERT INTO type_abonnement_user(
    id_user,
    id_abonnement,
    date_abonnement
) VALUES
(1, 2, NOW()),
(2, 1, NOW()),
(3, 2, NOW()),
(4, 1, NOW()),
(5, 2, NOW());

-- =========================
-- INSERTION DES REGIMES UTILISATEURS
-- =========================
INSERT INTO regime_user(id_user, id_regime, date_regime) VALUES
(1, 1, NOW()),
(2, 2, NOW()),
(3, 3, NOW()),
(4, 4, NOW()),
(5, 5, NOW());

-- =========================
-- INSERTION DES CODES UTILISATEURS
-- =========================
INSERT INTO code_user(
    id_user,
    code,
    statut,
    date_track
) VALUES
(1, 'CODE001', 'valide', NOW()),
(2, 'CODE005', 'en attente', NOW()),
(3, 'CODE010', 'en attente', NOW()),
(4, 'CODE003', 'valide', NOW()),
(5, 'CODE015', 'refuse', NOW());