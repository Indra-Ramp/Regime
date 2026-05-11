<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités suggérées — VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/activite.css">
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="container">
    <div class="card">

        <div class="header">
            <div class="logo">Vital<span>Vibe</span></div>
            <h1>Activités suggérées</h1>
            <p>Basé sur votre objectif : <strong><?= esc($objectifLabel) ?></strong></p>
        </div>

        <?php if ($imc): ?>
            <div class="imc-box <?= $imc < 18.5 ? 'imc-low' : ($imc > 25 ? 'imc-high' : 'imc-ok') ?>">
                <div class="imc-value"><?= $imc ?></div>
                <div class="imc-info">
                    <div class="imc-label">Votre IMC</div>
                    <div class="imc-status">
                        <?php if ($imc < 18.5): ?>
                            Insuffisance pondérale
                        <?php elseif ($imc <= 25): ?>
                            Poids normal ✓
                        <?php elseif ($imc <= 30): ?>
                            Surpoids
                        <?php else: ?>
                            Obésité
                        <?php endif; ?>
                    </div>
                    <div class="imc-detail"><?= $poids ?> kg — <?= $taille ?> cm</div>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-title">Activités recommandées</div>

        <div id="msg-box" class="msg-box"></div>

        <?php if (!empty($activites)): ?>
            <div class="activite-list">
                <?php foreach ($activites as $a): ?>
                    <div class="activite-card">
                        <div class="activite-header">
                            <div class="activite-icon">🏃</div>
                            <div class="activite-label"><?= esc($a['label']) ?></div>
                            <div class="activite-variation <?= $a['variation_poids'] < 0 ? 'neg' : 'pos' ?>">
                                <?= $a['variation_poids'] > 0 ? '+' : '' ?><?= $a['variation_poids'] ?> kg
                            </div>
                        </div>

                        <div class="activite-footer">
                            <span class="activite-frequence">📅 <?= $a['frequence'] ?>x / semaine</span>
                            <button class="btn-choisir" data-id="<?= $a['id'] ?>">Choisir</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-activite">Aucune activité disponible pour votre objectif.</div>
        <?php endif; ?>

        <div class="nav-links">
            <a href="<?= base_url('regime/suggestions') ?>" class="back-link">🥗 Voir les régimes</a>
            <a href="<?= base_url('profil/show') ?>" class="back-link">← Retour au profil</a>
        </div>

    </div>
</div>

<script>
const BASE_URL = "<?= base_url() ?>";
const msgBox   = document.getElementById('msg-box');

document.querySelectorAll('.btn-choisir').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id = btn.dataset.id;
        btn.disabled = true;
        btn.textContent = '...';

        try {
            const response = await fetch(`${BASE_URL}/activite/choisir/${id}`, {
                method: 'POST',
                credentials: 'include'
            });

            const result = await response.json();

            if (result.success) {
                msgBox.className = 'msg-box success';
                msgBox.textContent = 'Activité choisie avec succès !';
                btn.textContent = '✓ Choisi';
            } else {
                msgBox.className = 'msg-box error';
                msgBox.textContent = result.message || 'Erreur.';
                btn.disabled = false;
                btn.textContent = 'Choisir';
            }
        } catch (e) {
            msgBox.className = 'msg-box error';
            msgBox.textContent = 'Impossible de contacter le serveur.';
            btn.disabled = false;
            btn.textContent = 'Choisir';
        }
    });
});
</script>

</body>
</html>