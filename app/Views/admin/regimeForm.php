<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Régime</title>
    <link rel="stylesheet" href="/assets/css/regimeform.css">
</head>

<body>
    <div class="regime-container">
        <div class="regime-card">
            <div class="regime-header">
                <h1 class="regime-title">Gestion Régime</h1>
                <p class="regime-subtitle">Ajoutez ou modifiez les paramètres d'un régime alimentaire</p>
            </div>

            <form method="POST" action="/admin/regime/save" class="regime-form">
                <div class="form-row">
                    <div class="input-group">
                        <label for="perc_viande">Pourcentage Viande (%)</label>
                        <input type="number" id="perc_viande" name="perc_viande" step="0.01" min="0" max="100" placeholder="Ex: 30" required>
                        <span class="form-hint">Entre 0 et 100%</span>
                    </div>

                    <div class="input-group">
                        <label for="perc_poisson">Pourcentage Poisson (%)</label>
                        <input type="number" id="perc_poisson" name="perc_poisson" step="0.01" min="0" max="100" placeholder="Ex: 25" required>
                        <span class="form-hint">Entre 0 et 100%</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="perc_volaille">Pourcentage Volaille (%)</label>
                        <input type="number" id="perc_volaille" name="perc_volaille" step="0.01" min="0" max="100" placeholder="Ex: 25" required>
                        <span class="form-hint">Entre 0 et 100%</span>
                    </div>

                    <div class="input-group">
                        <label for="variation_poids">Variation Poids (kg)</label>
                        <input type="number" id="variation_poids" name="variation_poids" step="0.01" placeholder="Ex: 2.5" required>
                        <span class="form-hint">Perte ou gain de poids</span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="duree">Durée (jours)</label>
                        <input type="number" id="duree" name="duree" step="0.01" min="0" placeholder="Ex: 30" required>
                        <span class="form-hint">Durée du régime</span>
                    </div>

                    <div class="input-group">
                        <label for="price">Prix (€)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Ex: 49.99" required>
                        <span class="form-hint">Prix du régime</span>
                    </div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-submit">Enregistrer</button>
                    <button type="reset" class="btn-reset">Réinitialiser</button>
                </div>
            </form>
        </div>

        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>
</body>

</html>