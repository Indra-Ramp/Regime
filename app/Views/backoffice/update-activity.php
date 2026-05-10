<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier votre activité - VitalVibe</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/create-activity.css"> </head>
<body>

  <div class="creation-card">
    
    <h2>Modifier votre activité</h2>

    <form action="/admin/activites/updated-activity" method="post" class="activity-form">
      <input type="hidden" name="id" id="id" value="<?= session('activity')['id'] ?? '' ?>">
      <div class="form-group">
        <label for="label">Nom de l'activité</label>
        <input type="text" id="label" name="label" value="<?= old('label', $activity['label'] ?? '') ?>" placeholder="<?= $activity['label'] ?? '' ?>" required>
      </div>

      <div class="form-group">
        <label for="variation_poids">Variation de poids moyenne (en kg)</label>
        <input type="number" id="variation_poids" name="variation_poids" step="0.1" value="<?= old('variation_poids', $activity['variation_poids'] ?? '') ?>" placeholder="<?= $activity['variation_poids'] ?? '' ?>" required>
      </div>
      
      <div class="form-group">
        <label for="frequence">Fréquence idéale (en jours)</label>
        <input type="number" id="frequence" name="frequence" value="<?= old('frequence', $activity['frequence'] ?? '') ?>" placeholder="<?= $activity['frequence'] ?? '' ?>" required>
      </div>

      <button type="submit" class="btn-submit">Valider et Modifier l'Activité</button>
    </form>
    
  </div>

</body>
</html>