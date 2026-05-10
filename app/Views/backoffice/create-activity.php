<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Créer votre activité - VitalVibe</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/create-activity.css"> </head>
<body>

  <div class="creation-card">
    
    <h2>Créer votre parcours</h2>

    <form action="/admin/create-activity" method="post" class="activity-form">
      
      <div class="form-group">
        <label for="label">Nom de l'activité</label>
        <input type="text" id="label" name="label" placeholder="Course à pied, Yoga, Musculation..." required>
      </div>

      <div class="form-group">
        <label for="variation_poids">Variation de poids moyenne (en kg)</label>
        <input type="number" id="variation_poids" name="variation_poids" step="0.1" placeholder="Ex: -0.5 pour perte, 1.2 pour prise" required>
      </div>
      
      <div class="form-group">
        <label for="frequence">Fréquence idéale (en jours)</label>
        <input type="number" id="frequence" name="frequence" placeholder="Ex: 3" required>
      </div>

      <button type="submit" class="btn-submit">Valider et Créer l'Activité</button>
    </form>
    
  </div>

</body>
</html>