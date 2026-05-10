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
    <a href="<?= base_url('profil/form') ?>" class="nav-link">Profile</a>
<?php } else { ?>
    <a href="<?= base_url('profil/profil') ?>" class="nav-link">Profile</a>
<?php } ?>
    </nav>

    <div class="user-zone">
      <div class="wallet">
        <span class="wallet-balance">42,50 €</span>
        <a href="#" class="wallet-add" title="Ajouter">+</a>
      </div>

      <div class="username">
        <div class="avatar">SM</div>
        <span>Sophie Martin</span>
      </div>
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