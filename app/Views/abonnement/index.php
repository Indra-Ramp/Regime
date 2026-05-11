<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement — VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/abo.css">
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="container">
    <div class="card">

        <div class="header">
            <div class="logo">Vital<span>Vibe</span></div>
            <h1>Abonnement</h1>
            <p>Gérez votre plan et profitez de tous les avantages</p>
        </div>

        <div class="section-title">Mon abonnement actuel</div>

        <?php if (!empty($actuel)): ?>
            <div class="actuel-box">
                <div class="actuel-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div class="actuel-info">
                    <div class="label">Plan actif</div>
                    <div class="value"><?= esc($actuel['id_abonnement']) ?></div>
                    <div class="date">Depuis le <?= esc($actuel['date_abonnement']) ?></div>
                </div>
            </div>
        <?php else: ?>
            <div class="no-abonnement">Aucun abonnement actif pour le moment.</div>
        <?php endif; ?>

        <div class="section-title">Choisir un abonnement</div>

        <div id="msg-box" class="msg-box"></div>

        <form id="form-abonnement">
            <div class="radio-group">
                <?php foreach ($abonnements as $ab): ?>
                    <label class="radio-label">
                        <input type="radio" name="id_abonnement" value="<?= $ab['id'] ?>"
                            <?= (!empty($actuel) && $actuel['id_abonnement'] == $ab['id']) ? 'checked' : '' ?>>
                        <div class="radio-content">
                            <div class="radio-label-text"><?= esc($ab['label']) ?></div>
                            <div class="radio-montant"><?= esc($ab['montant']) ?> Ar / mois</div>
                        </div>
                        <?php if ($ab['perc_reduction'] > 0): ?>
                            <span class="badge-reduction">-<?= esc($ab['perc_reduction']) ?>%</span>
                        <?php endif; ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <button type="button" class="btn-save" id="btn-save">
                <span class="btn-text">Enregistrer</span>
                <span class="btn-loader"><span class="spinner"></span></span>
            </button>
        </form>

        <a href="<?= base_url('profil/show') ?>" class="back-link">← Retour au profil</a>

    </div>
</div>

<script>
const BASE_URL = "<?= base_url() ?>";
const msgBox   = document.getElementById('msg-box');
const btnSave  = document.getElementById('btn-save');

btnSave.addEventListener('click', async () => {
    const selected = document.querySelector('input[name="id_abonnement"]:checked');

    msgBox.className = 'msg-box';
    msgBox.textContent = '';

    if (!selected) {
        msgBox.className = 'msg-box error';
        msgBox.textContent = 'Veuillez sélectionner un abonnement.';
        return;
    }

    btnSave.disabled = true;
    btnSave.classList.add('loading');

    const fd = new FormData();
    fd.append('id_abonnement', selected.value);

    try {
        const response = await fetch(`${BASE_URL}/abonnement/store`, {
            method: 'POST',
            body: fd,
            credentials: 'include'
        });

        const result = await response.json();

        if (result.success) {
            msgBox.className = 'msg-box success';
            msgBox.textContent = 'Abonnement mis à jour avec succès !';
        } else {
            msgBox.className = 'msg-box error';
            msgBox.textContent = result.message || 'Erreur lors de l\'enregistrement.';
        }
    } catch (e) {
        msgBox.className = 'msg-box error';
        msgBox.textContent = 'Impossible de contacter le serveur.';
    } finally {
        btnSave.disabled = false;
        btnSave.classList.remove('loading');
    }
});
</script>

</body>
</html>