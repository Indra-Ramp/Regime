<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer votre régime - VitalVibe</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/create-activity.css">
</head>
<body>

  <div class="creation-card">
    
    <h2>Créer un régime</h2>

    <form action="/admin/create-regime" method="post" class="activity-form">
      
      <div class="form-group">
        <label for="perc_viande">Pourcentage de viande (%)</label>
        <input type="number" id="perc_viande" name="perc_viande" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
      </div>

      <div class="form-group">
        <label for="perc_poisson">Pourcentage de poisson (%)</label>
        <input type="number" id="perc_poisson" name="perc_poisson" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
      </div>

      <div class="form-group">
        <label for="perc_volaille">Pourcentage de volaille (%)</label>
        <input type="number" id="perc_volaille" name="perc_volaille" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
      </div>

      <div class="form-group">
        <label for="variation_poids">Variation de poids moyenne (en kg)</label>
        <input type="number" id="variation_poids" name="variation_poids" step="0.1" placeholder="Ex: -1 pour perte, 0.5 pour prise" required>
      </div>

      <div class="form-group">
        <label for="duree">Durée du régime (en jours)</label>
        <input type="number" id="duree" name="duree" placeholder="Ex: 30" required>
      </div>

      <div class="form-group">
        <label for="price">Prix (€)</label>
        <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Ex: 99.99" required>
      </div>

      <button type="submit" class="btn-submit">Valider et Créer le Régime</button>
    </form>
    
  </div>

</body>
</html>
