<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil & Objectif</title>
   
    <link rel="stylesheet" href="assets/css/form.css">
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
                <h1 id="step-title">Créer un profil</h1>
                <p id="step-subtitle">Étape 1 sur 2 — Informations personnelles</p>
            </div>

            <!-- Stepper -->
            <div class="stepper">
                <div class="step-dot active" id="dot-1">
                    <div class="dot-circle">1</div>
                    <span class="dot-label">Profil</span>
                </div>
                <div class="step-line" id="step-line"></div>
                <div class="step-dot" id="dot-2">
                    <div class="dot-circle">2</div>
                    <span class="dot-label">Objectif</span>
                </div>
            </div>

            <!-- Message feedback global -->
            <div class="msg-box" id="msg-box"></div>

           
            <div class="step-panel active" id="panel-1">

               

                <div class="input-group">
                    <div class="label-row">
                        <label for="telephone">Téléphone</label>
                    </div>
                    <div class="input-wrap">
                        <input type="tel" id="telephone" name="telephone" placeholder="Ex : 0321234567">
                    </div>
                    <span class="field-error" id="err-telephone"></span>
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="date_naissance">Date de naissance</label>
                    </div>
                    <div class="input-wrap">
                      
                        <input type="date" id="date_naissance" name="date_naissance">
                    </div>
                    <span class="field-error" id="err-date_naissance"></span>
                </div>

                <button class="btn-login" id="btn-step1">
                    <span class="btn-text">Continuer</span>
                    <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                    <span class="btn-loader"><span class="spinner"></span></span>
                </button>

            </div>

         
        
            <div class="step-panel" id="panel-2">

                <div class="input-group">
                    <div class="label-row">
                        <label for="id_objectif">Objectif</label>
                    </div>
                    <div class="input-wrap select-wrap">
                      
                    <label>
                                <input type="radio" name="objectif" value="1">
                                Perte de poids
                                </label>

                                <label>
                                <input type="radio" name="objectif" value="2">
                                Prise de masse
                                </label>
                            
                    </div>
                    <span class="field-error" id="err-id_objectif"></span>
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="date_objectif">Date cible</label>
                    </div>
                    <div class="input-wrap">
                      
                        <input type="date" id="date_objectif" name="date_objectif">
                    </div>
                    <span class="field-error" id="err-date_objectif"></span>
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="valeur">Valeur cible</label>
                    </div>
                    <div class="input-wrap">
                        
                        <input type="number" id="valeur" name="valeur" placeholder="Ex : 75 (kg, reps…)" min="0">
                    </div>
                    <span class="field-error" id="err-valeur"></span>
                </div>

                <div class="btn-row">
                    <button class="btn-back" id="btn-back">
                        
                        Retour
                    </button>
                    <button class="btn-login btn-flex" id="btn-step2">
                        <span class="btn-text">Enregistrer</span>
                        <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span class="btn-loader"><span class="spinner"></span></span>
                    </button>
                </div>

            </div>

            <div class="step-panel" id="panel-success">
                <div class="success-wrap">
                    <div class="success-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                    <h3>Tout est enregistré !</h3>
                    <p>Profil et objectif sauvegardés avec succès.</p>
                    <button class="btn-reset" id="btn-reset">Nouvelle inscription</button>
                </div>
            </div>

        </div><!-- /login-card -->
    </div><!-- /login-container -->

    <script src="assets/js/form.js"></script>
</body>
</html>