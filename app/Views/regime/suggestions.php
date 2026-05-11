<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestions de régimes — VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/regime.css">
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div class="container">
    <div class="card">

        <div class="header">
            <div class="logo">Vital<span>Vibe</span></div>
            <h1>Régimes suggérés</h1>
            <p>Basé sur votre objectif : <strong><?= esc($objectifLabel) ?></strong></p>
        </div>

        <!-- IMC -->
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

        <div class="section-title">Régimes recommandés</div>

        <div id="msg-box" class="msg-box"></div>

        <?php if (!empty($regimes)): ?>
            <div class="regime-list">
                <?php foreach ($regimes as $r): ?>
                    <div class="regime-card">
                        <div class="regime-header">
                            <div class="regime-variation <?= $r['variation_poids'] < 0 ? 'neg' : 'pos' ?>">
                                <?= $r['variation_poids'] > 0 ? '+' : '' ?><?= $r['variation_poids'] ?> kg
                            </div>
                            <div class="regime-price"><?= $r['price'] ?> Ar</div>
                        </div>

                        <div class="regime-macros">
                            <div class="macro">
                                <span class="macro-icon">🥩</span>
                                <span class="macro-label">Viande</span>
                                <span class="macro-val"><?= $r['perc_viande'] ?>%</span>
                            </div>
                            <div class="macro">
                                <span class="macro-icon">🐟</span>
                                <span class="macro-label">Poisson</span>
                                <span class="macro-val"><?= $r['perc_poisson'] ?>%</span>
                            </div>
                            <div class="macro">
                                <span class="macro-icon">🍗</span>
                                <span class="macro-label">Volaille</span>
                                <span class="macro-val"><?= $r['perc_volaille'] ?>%</span>
                            </div>
                        </div>

                        <div class="regime-footer">
                            <span class="regime-duree">⏱ <?= $r['duree'] ?> jours</span>
                            <button class="btn-choisir" data-id="<?= $r['id'] ?>">Choisir ce régime</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-regime">Aucun régime disponible pour votre objectif.</div>
        <?php endif; ?>

        <a href="<?= base_url('profil/show') ?>" class="back-link">← Retour au profil</a>

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
            const response = await fetch(`${BASE_URL}/regime/choisir/${id}`, {
                method: 'POST',
                credentials: 'include'
            });

            const result = await response.json();

            if (result.success) {
                msgBox.className = 'msg-box success';
                msgBox.textContent = 'Régime choisi avec succès !';
                btn.textContent = '✓ Choisi';
            } else {
                msgBox.className = 'msg-box error';
                msgBox.textContent = result.message || 'Erreur.';
                btn.disabled = false;
                btn.textContent = 'Choisir ce régime';
            }
        } catch (e) {
            msgBox.className = 'msg-box error';
            msgBox.textContent = 'Impossible de contacter le serveur.';
            btn.disabled = false;
            btn.textContent = 'Choisir ce régime';
        }
    });
});
</script>

</body>
</html>