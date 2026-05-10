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
      <a href="#" class="nav-link active">Home</a>
     <?php if (!session()->get('id_user')) { ?>
    <a href="<?= base_url('profil/form') ?>" class="nav-link">Profile</a>
<?php } else { ?>
    <a href="<?= base_url('profil/profil') ?>" class="nav-link">Profile</a>
<?php } ?>
    </nav>

    <div class="user-zone">
      <div class="username">
        <div class="avatar">SM</div>
        <span>Sophie Martin</span>
      </div>
    </div>
  </header>
<h2>Profil</h2>
<table border="1">
    <tr>
        <th>Nom</th>
        <td><?= $profil['nom'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Prénom</th>
        <td><?= $profil['prenom'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $profil['email'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Genre</th>
        <td><?= $profil['genre'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Téléphone</th>
        <td><?= $profil['telephone'] ?? '' ?></td>
    </tr>
    <tr>
        <th>Date naissance</th>
        <td><?= $profil['date_naissance'] ?? '' ?></td>
    </tr>
</table>

<hr>

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
        <tr>
            <td colspan="3">Aucun objectif</td>
        </tr>
    <?php endif; ?>

</table>

<hr>

<h2>Porte-monnaie</h2>
<table border="1">
    <tr>
        <th>Montant</th>
        <td><?= $profil['montant'] ?? 0 ?></td>
    </tr>
</table>

</body>
</html>