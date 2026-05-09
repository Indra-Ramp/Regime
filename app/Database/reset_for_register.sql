-- 1. Désactiver la vérification des clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- 2. Réinitialiser les tables (supprime les données et reset l'ID à 1)
TRUNCATE TABLE suivi_sante;
TRUNCATE TABLE porte_monnaie;
TRUNCATE TABLE profil;
TRUNCATE TABLE user;

-- 3. Réactiver la vérification des clés étrangères
SET FOREIGN_KEY_CHECKS = 1;