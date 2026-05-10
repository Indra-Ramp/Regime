<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Objectif</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/form.css') ?>">
</head>
<body>

    <!-- Blobs décoratifs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="login-container">
        <div class="login-card">

            <!-- Header -->
            <div class="login-header">
                <div class="logo">Fit<span>Track</span></div>
                <h1>Compléter votre profil</h1>
                <p>Remplissez vos informations personnelles et votre objectif</p>
            </div>

            <!-- Message feedback global -->
            <div class="msg-box" id="msg-box"></div>

            <!-- Formulaire unique -->
            <form id="form-profil" method="POST">

                <!-- Section Profil -->
                <fieldset class="form-section">
                    <legend>Informations personnelles</legend>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="telephone">Téléphone</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.15 12 19.79 19.79 0 0 1 1.08 3.33 2 2 0 0 1 3.06 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <input type="tel" id="telephone" name="telephone" placeholder="Ex : 0321234567">
                        </div>
                        <span class="field-error" id="err-telephone"></span>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="date_naissance">Date de naissance</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <input type="date" id="date_naissance" name="date_naissance">
                        </div>
                        <span class="field-error" id="err-date_naissance"></span>
                    </div>

                </fieldset>

                <!-- Section Objectif -->
                <fieldset class="form-section">
                    <legend>Votre objectif</legend>

                    <div class="input-group">
                        <div class="label-row">
                            <label>Objectif</label>
                        </div>
                        <div class="radio-group">
                           
                           
                            <?php if (!empty($objectifs)): ?>

                                <?php foreach($objectifs as $obj): ?>

                                    <label class="radio-label">
                                        <input type="radio" name="id_objectif" value="<?= $obj['id'] ?>">
                                        <span><?= $obj['label'] ?></span>
                                    </label>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <p>Aucun objectif disponible</p>

                            <?php endif; ?>
                        </div>
                        <span class="field-error" id="err-id_objectif"></span>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="date_objectif">Date cible</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <input type="date" id="date_objectif" name="date_objectif">
                        </div>
                        <span class="field-error" id="err-date_objectif"></span>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="valeur">Valeur cible</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                            <input type="number" id="valeur" name="valeur" placeholder="Ex : 75 (kg, reps…)" min="0">
                        </div>
                        <span class="field-error" id="err-valeur"></span>
                    </div>

                </fieldset>

                <!-- Bouton d'envoi -->
                <button type="submit" class="btn-login" id="btn-submit">
                    <span class="btn-text">Enregistrer</span>
                    <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    <span class="btn-loader"><span class="spinner"></span></span>
                </button>

            </form>

            <!-- Panneau succès -->
            <div class="success-panel" id="success-panel">
                <div class="success-wrap">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                    <h3>Tout est enregistré !</h3>
                    <p>Profil et objectif sauvegardés avec succès.</p>
                    <button type="button" class="btn-reset" id="btn-reset">Ajouter un autre profil</button>
                </div>
            </div>

        </div><!-- /login-card -->
    </div><!-- /login-container -->

    <script src="<?= base_url('assets/js/form.js') ?>"></script>
    <script>
    const BASE_URL = "<?= base_url() ?>";
</script>


</body>
</html>