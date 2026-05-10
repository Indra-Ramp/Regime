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
     <?php if (!session()->get('id_user')) { ?>
    <a href="<?= base_url('profil/') ?>" class="nav-link">Profile</a>
<?php } else { ?>
    <a href="<?= base_url('profil/profil') ?>" class="nav-link">Profile</a>
<?php } ?>
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
    <div class="main-placeholder">
      <p style="font-weight: 600; font-size: 18px; color: var(--primary); margin-bottom: 8px;">Prêt pour vos objectifs ?</p>
      <p style="z-index: 1;">Le contenu de votre programme s'affichera ici.</p>
    </div>
  </main>

</body>
</html>