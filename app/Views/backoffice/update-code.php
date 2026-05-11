<?php

    $success = session()->getFlashData('success');
    $error = session()->getFlashData('error');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un code - VitalVibe</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/create-activity.css">
</head>
<body>

  <div class="creation-card">
    
    <h2>Modifier un code</h2>
    <?php if(isset($success)){?>
            <div class="success">
                <?= $success;?>
            </div>
        <?php } else if(isset($error)){ ?>
            <div class="error">
                <?= $error;?>
            </div>
        <?php }?>

    <form action="/admin/codes/update" method="post" class="activity-form">
      <input type="hidden" name="id" id="id" value="<?= session('code')['id'] ?? $code['id'] ?? '' ?>">
      
      <div class="form-group">
        <label for="code">Code</label>
        <input type="text" id="code" name="code" value="<?= $code['code']?>" placeholder="<?= $code['code'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="id_user">Utilisateur</label>
        <select id="id_user" name="id_user" required>
          <option value="">Sélectionner un utilisateur</option>
          <?php foreach($users as $user): ?>
            <option value="<?= $user['id'] ?>" <?= $code['id_user'] == $user['id'] ? 'selected' : '' ?>><?= $user['nom'] ?> <?= $user['prenom'] ?> (<?= $user['email'] ?>)</option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="statut">Statut</label>
        <select id="statut" name="statut" required>
          <option value="en attente" <?= $code['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
          <option value="valide" <?= $code['statut'] == 'valide' ? 'selected' : '' ?>>Valide</option>
          <option value="refuse" <?= $code['statut'] == 'refuse' ? 'selected' : '' ?>>Refusé</option>
        </select>
      </div>

      <div class="form-group">
        <label for="date_track">Date de suivi</label>
        <input type="date" id="date_track" name="date_track" value="<?= date('Y-m-d', strtotime($code['date_track'])) ?>" required>
      </div>

      <button type="submit" class="btn-submit">Valider et Modifier le Code</button>
    </form>
    
  </div>

</body>
</html>