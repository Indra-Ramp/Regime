<?php
$tempData = session()->get('temp_data') ?? [];
$errors = session()->getFlashData('errors') ?? [];

$inputs = [
    'nom'           => old('nom') ?: ($tempData['nom'] ?? ''),
    'prenom'        => old('prenom') ?: ($tempData['prenom'] ?? ''),
    'email'         => old('email') ?: ($tempData['email'] ?? ''),
    'genre'         => old('genre') ?: ($tempData['genre'] ?? 'H'),
    'password_hash' => old('password_hash') ?: ($tempData['password_hash'] ?? ''),
];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 1 | VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/register.css">
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <header class="login-header">
                <div class="logo">Vital<span>Vibe</span></div>

                <div class="step-indicator">
                    <span class="step active">1</span>
                    <div class="line"></div>
                    <span class="step">2</span>
                </div>

                <h1>Créer un compte</h1>
                <p>Vos informations de base</p>
            </header>

            <form action="<?= base_url('/register/1') ?>" method="POST">
                <?= csrf_field() ?>

                <fieldset class="form-section">
                    <legend>Identité</legend>
                    <div class="input-row">
                        <div class="input-group">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="<?= isset($errors['nom']) ? 'input-error' : '' ?>" placeholder="Nom" value="<?= esc((string) ($inputs['nom'] ?? '')) ?>">
                            <?php if (isset($errors['nom'])): ?>
                                <span class="error-text"><?= $errors['nom'] ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="input-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="<?= isset($errors['prenom']) ? 'input-error' : '' ?>" placeholder="Prénom" value="<?= esc((string) ($inputs['prenom'] ?? '')) ?>">
                            <?php if (isset($errors['prenom'])): ?>
                                <span class="error-text"><?= $errors['prenom'] ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Genre</label>
                        <div class="gender-selector">
                            <input type="radio" name="genre" id="homme" value="H" <?= $inputs['genre'] === 'H' ? 'checked' : '' ?>>
                            <label for="homme" class="gender-btn">Homme</label>

                            <input type="radio" name="genre" id="femme" value="F" <?= $inputs['genre'] === 'F' ? 'checked' : '' ?>>
                            <label for="femme" class="gender-btn">Femme</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-section">
                    <legend>Contact & Sécurité</legend>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="<?= isset($errors['email']) ? 'input-error' : '' ?>" placeholder="nom@exemple.com" value="<?= esc((string) ($inputs['email'] ?? '')) ?>">
                        <?php if (isset($errors['email'])): ?>
                            <span class="error-text"><?= $errors['email'] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="password">Mot de passe</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password_hash"
                                class="<?= isset($errors['password_hash']) ? 'input-error' : '' ?>"
                                placeholder="••••••••" value="<?= esc((string) ($inputs['password_hash'] ?? '')) ?>">

                            <label class="show-password-trigger">
                                <input type="checkbox" id="checkbox">
                                <span class="trigger-text">Show</span>
                            </label>
                        </div>

                        <?php if (isset($errors['password_hash'])): ?>
                            <span class="error-text"><?= $errors['password_hash'] ?></span>
                        <?php endif; ?>
                    </div>
                </fieldset>

                <button type="submit" class="btn-login">Suivant : Profil Santé</button>
            </form>

            <footer class="login-footer">
                <p>Déjà inscrit ? <a href="<?= base_url('/login') ?>">Connectez-vous</a></p>
            </footer>
        </div>

        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <script type="text/javascript">
        const showPass = document.querySelector('#checkbox');
        const passField = document.querySelector('#password');
        showPass.addEventListener('change', (event) => {
            passField.setAttribute('type', event.target.checked ? 'text' : 'password');
        });
    </script>

</body>

</html>