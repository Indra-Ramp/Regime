<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard utilisateur</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>">
</head>
<body>
 <header class="header">
    <div class="logo">Vital<span>Vibe</span></div>

    <nav class="nav">
      <a href="/" class="nav-link active">Home</a>
    <a href="<?= base_url('profil/show') ?>" class="nav-link">Profile</a>

    </nav>

    <div class="user-zone">
      <?php if (session()->has('user')): ?>
          <div class="wallet">
              <span class="wallet-balance"><?= esc($wallet) ?> €</span>
              <a href="<?= base_url('/wallet/add') ?>" class="wallet-add" title="Ajouter">+</a>
          </div>

          <!-- Conteneur avec menu déroulant -->
          <div class="user-dropdown">
              <div class="username">
                  <div class="avatar"><?= format_username($user['nom'], $user['prenom']) ?></div>
                  <span><?= esc($user['nom'] . " " . $user['prenom']) ?></span>
                  <i class="chevron-icon">▾</i>
              </div>
              
              <div class="dropdown-content">
                  <a href="<?= base_url('/profile') ?>" class="dropdown-item">Mon Profil</a>
                  <hr class="dropdown-divider">
                  <a href="<?= base_url('/logout') ?>" class="dropdown-item logout-link">
                      Se déconnecter
                  </a>
              </div>
          </div>

        <?php else: ?>
            <div class="auth-guest">
                <a href="<?= base_url('/login') ?>" class="btn-guest login">Connexion</a>
                <a href="<?= base_url('/register/1') ?>" class="btn-guest register">S'inscrire</a>
            </div>
        <?php endif; ?>
    </div>
  </header>

<h2>Profil</h2>
<table border="1">
    <tr><th>Nom</th><td><?= $profil['nom'] ?? '' ?></td></tr>
    <tr><th>Prénom</th><td><?= $profil['prenom'] ?? '' ?></td></tr>
    <tr><th>Email</th><td><?= $profil['email'] ?? '' ?></td></tr>
    <tr><th>Genre</th><td><?= $profil['genre'] ?? '' ?></td></tr>
    <tr><th>Téléphone</th><td><?= $profil['telephone'] ?? '' ?></td></tr>
    <tr><th>Date naissance</th><td><?= $profil['date_naissance'] ?? '' ?></td></tr>
</table>

<hr>
<?php if (empty($profil['telephone'])): ?>
    <a href="<?= base_url('profil/') ?>" class="btn-main">Créer mon profil</a>
<?php else: ?>
    <a href="<?= base_url('profil/') ?>" class="btn-main">Modifier mon profil</a>
<?php endif; ?>
<h2>Objectifs</h2>
<table border="1">
    <tr>
        <th>Objectif</th>
        <th>Date</th>
        <th>Valeur</th>
    </tr>
    <?php if (!empty($objectifs)): ?>
        <?php foreach ($objectifs as $obj): ?>
            <tr>
                <td><?= $obj['label'] ?></td>
                <td><?= $obj['date_objectif'] ?></td>
                <td><?= $obj['valeur'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="3">Aucun objectif</td></tr>
    <?php endif; ?>
</table>

<hr>

<h2>Suivi santé</h2>
<table border="1">
    <tr>
        <th>Poids (kg)</th>
        <th>Taille (cm)</th>
        <th>Date</th>
    </tr>
    
            <tr>
                <td><?= $profil['poids'] ?? '' ?></td>
                <td><?= $profil['taille']  ?? ''?></td>
                <td><?= $profil['date_suivi']  ?? ''?></td>
            </tr>
     
</table>

<hr>
<h2>Activités</h2>
<table border="1">
    <tr>
        <th>Activité</th>
        <th>Date</th>
    </tr>
    <?php foreach($activites as $a): ?>
        <tr>
            <td><?= $a['nom_activite'] ?></td>
            <td><?= $a['date_activite'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Régimes</h2>
<table border="1">
    <tr>
        <th>Prix</th>
        <th>Durée</th>
        <th>% Viande</th>
        <th>% Poisson</th>
        <th>% Volaille</th>
        <th>Date</th>
    </tr>

    <?php foreach($regimes as $r): ?>
        <tr>
            <td><?= $r['price'] ?> €</td>
            <td><?= $r['duree'] ?> jours</td>
            <td><?= $r['perc_viande'] ?> %</td>
            <td><?= $r['perc_poisson'] ?> %</td>
            <td><?= $r['perc_volaille'] ?> %</td>
            <td><?= $r['date_regime'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<h2>Porte-monnaie</h2>
<table border="1">
    <tr>
        <th>Montant</th>
        <td><?= $profil['montant'] ?? 0 ?></td>
    </tr>
</table>
<h2>Abonnement</h2>
<table border="1">
    <tr>
        <th>Type</th>
        <td><?= $profil['abonnement_label'] ?? 'Aucun' ?></td>
    </tr>
    <tr>
        <th>Montant</th>
        <td><?= $profil['abonnement_montant'] ?? 0 ?></td>
    </tr>
    <tr>
        <th>Réduction</th>
        <td><?= $profil['perc_reduction'] ?? 0 ?> %</td>
    </tr>
    <tr>
        <th>Date abonnement</th>
        <td><?= $profil['date_abonnement'] ?? '' ?></td>
    </tr>
</table>

<a href="<?= base_url('abonnement') ?>" class="btn-main">
    <?= empty($profil['abonnement_label']) ? "S'abonner" : "Changer d'abonnement" ?>
</a>
</body>
</html>