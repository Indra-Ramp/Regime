<?php

    $success = session()->getFlashData('success');
    $error = session()->getFlashData('error');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier votre régime - VitalVibe</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/create-activity.css">
</head>
<body>

  <div class="creation-card">
    
    <h2>Modifier votre régime</h2>
    <?php if(isset($success)){?>
            <div class="success">
                <?= $success;?>
            </div>
        <?php } else if(isset($error)){ ?>
            <div class="error">
                <?= $error;?>
            </div>
        <?php }?>

    <form action="/admin/regimes/updated-regime" method="post" class="activity-form">
      <input type="hidden" name="id" id="id" value="<?= session('regime')['id'] ?? $regime['id'] ?? '' ?>">">
      
      <div class="form-group">
        <label for="perc_viande">Pourcentage de viande (%)</label>
        <input type="number" id="perc_viande" name="perc_viande" step="0.1" min="0" max="100" value="<?= $regime['perc_viande']?>" placeholder="<?= $regime['perc_viande'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="perc_poisson">Pourcentage de poisson (%)</label>
        <input type="number" id="perc_poisson" name="perc_poisson" step="0.1" min="0" max="100" value="<?= $regime['perc_poisson']?>" placeholder="<?= $regime['perc_poisson'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="perc_volaille">Pourcentage de volaille (%)</label>
        <input type="number" id="perc_volaille" name="perc_volaille" step="0.1" min="0" max="100" value="<?= $regime['perc_volaille']?>" placeholder="<?= $regime['perc_volaille'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="variation_poids">Variation de poids moyenne (en kg)</label>
        <input type="number" id="variation_poids" name="variation_poids" step="0.1" value="<?= $regime['variation_poids']?>" placeholder="<?= $regime['variation_poids'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="duree">Durée du régime (en jours)</label>
        <input type="number" id="duree" name="duree" value="<?= $regime['duree']?>" placeholder="<?= $regime['duree'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="price">Prix (€)</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?= $regime['price'] ?>" placeholder="<?= $regime['price'] ?? '' ?>" required>
      </div>

      <button type="submit" class="btn-submit">Valider et Modifier le Régime</button>
    </form>
    
  </div>

</body>
</html>
