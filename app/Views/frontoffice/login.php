<?php

    $errors = session()->getFlashData('errors');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <header class="login-header">
                <div class="logo">Vital<span>Vibe</span></div>
                <h1>Ravi de vous revoir</h1>
                <p>Reprenez votre parcours bien-être là où vous vous étiez arrêté.</p>
            </header>

            <form class="login-form" action="/login" method="POST">
                <div class="input-group">
                    <label for="email">Adresse email</label>
                    <input type="email" id="email" placeholder="nom@exemple.com" name="email" value="<?= old('email') ?? '' ?>">
                    <?php if(isset($errors['email'])): ?>
                        <span class="error-text"><?= $errors['email'] ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-group">
                    <div class="label-row">
                        <label for="password">Mot de passe</label>
                    </div>
                    <input type="password" id="password" placeholder="••••••••" name="password_hash" value="<?= old('password_hash') ?? '' ?>">
                    <?php if(isset($errors['password_hash'])): ?>
                        <span class="error-text"><?= $errors['password_hash'] ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-login">Se connecter</button>
            </form>

            <footer class="login-footer">
                <p>Pas encore de compte ? <a href="/register/1">Inscrivez-vous gratuitement</a></p>
            </footer>
        </div>
        
        <!-- Décoration de fond pour l'ambiance -->
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

</body>
</html>