<?php

  helper('user');
  $user = session()->get('user');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>VitalVibe</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/layout.css">
</head>
<body>

  <header class="header">
    <div class="logo">Vital<span>Vibe</span></div>

    <nav class="nav">
      <a href="#" class="nav-link active">Home</a>
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

  <main class="main">
    <div class="bento-grid">
    <!-- Carte 1 : Nutrition -->
        <div class="bento-item">
            <div class="bento-icon">🥗</div>
            <h3>Plan Nutritionnel</h3>
            <p>Vos repas personnalisés n'attendent que vous.</p>
            <span class="status-tag">À définir</span>
        </div>

        <!-- Carte 2 : Activité -->
        <div class="bento-item highlight">
            <div class="bento-icon">🔥</div>
            <h3>Calories Brûlées</h3>
            <div class="progress-placeholder"></div>
            <p>Connectez-vous pour suivre vos efforts.</p>
        </div>

        <!-- Carte 3 : Poids -->
        <div class="bento-item">
            <div class="bento-icon">⚖️</div>
            <h3>Suivi du Poids</h3>
            <p>Visualisez votre courbe de progression.</p>
        </div>
    </div>

    <!-- CTA flottant pour les Guests -->
    <?php if (!session()->has('user')): ?>
        <div class="floating-cta">
            <p>Envie de remplir ces statistiques ?</p>
            <a href="<?= base_url('/register/1') ?>" class="btn-main">Créer mon profil gratuit</a>
        </div>
    <?php endif; ?>
    <?php if (session()->has('user')): ?>
    <div class="floating-cta">
        <p>Passez à la vitesse supérieure !</p>
        <a href="<?= base_url('abonnement') ?>" class="btn-main">S'abonner</a>
    </div>
<?php endif; ?>
  </main>
<a href="<?= base_url('regime/suggestions') ?>" class="btn-main">Voir mes régimes suggérés</a>
</body>
</html>