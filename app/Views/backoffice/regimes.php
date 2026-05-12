<?php

    $success = session()->getFlashData('success');
    $error = session()->getFlashData('error');

?>
<?= $this->extend('sidebar/sidebar') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="/assets/css/activities.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container">
        <header class="db-header">
            <h1>Régimes</h1>
            <p>Gérez et modifiez les régimes du programme VitalVibe</p>
        </header>

        <div id="toast-regime"></div>
        <div class="dashboard-layout">
            <!-- COLONNE GAUCHE: Tableau des régimes -->
            <div class="table-column">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h3 style="margin: 0;">Liste des Regimes</h3>
                    <button class="btn-add" onclick="resetToCreateModeRegime()">+ Nouveau Regime</button>
                </div>
                <div class="responsive-table">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>% Viande</th>
                                <th>% Poisson</th>
                                <th>% Volaille</th>
                                <th>Variation</th>
                                <th>Durée</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="regimes-table-body">
                            <?php foreach($regimes as $regime): ?>
                                <tr id="regime-row-<?= $regime['id'] ?>">
                                    <td><strong><?= $regime['id'] ?></strong></td>
                                    <td class="cell-viande"><?= $regime['perc_viande'] ?>%</td>
                                    <td class="cell-poisson"><?= $regime['perc_poisson'] ?>%</td>
                                    <td class="cell-volaille"><?= $regime['perc_volaille'] ?>%</td>
                                    <td class="cell-variation"><?= $regime['variation_poids'] ?> kg</td>
                                    <td class="cell-duree"><?= $regime['duree'] ?></td>
                                    <td class="cell-price"><?= $regime['price'] ?> €</td>
                                    <td>
                                        <button class="btn-edit" onclick="setupEditModeRegime(<?= $regime['id'] ?>, <?= $regime['perc_viande'] ?>, <?= $regime['perc_poisson'] ?>, <?= $regime['perc_volaille'] ?>, <?= $regime['variation_poids'] ?>, <?= $regime['duree'] ?>, <?= $regime['price'] ?>)">Modifier</button>
                                        <button class="btn-delete" onclick="deleteRegime(<?= $regime['id'] ?>)">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- COLONNE DROITE: Formulaire AJAX -->
            <div class="form-column">
                <h2 id="regime-form-title">Créer un régime</h2>
                <p class="form-subtitle" id="regime-form-subtitle">Remplissez les champs pour ajouter un nouveau régime.</p>

                <form id="regime-form-ajax">
                    <input type="hidden" id="regime_id" name="regime_id" value="">

                    <div class="form-group">
                        <label for="perc_viande">% Viande</label>
                        <input type="number" id="perc_viande" name="perc_viande" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
                    </div>

                    <div class="form-group">
                        <label for="perc_poisson">% Poisson</label>
                        <input type="number" id="perc_poisson" name="perc_poisson" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
                    </div>

                    <div class="form-group">
                        <label for="perc_volaille">% Volaille</label>
                        <input type="number" id="perc_volaille" name="perc_volaille" step="0.1" min="0" max="100" placeholder="Ex: 25" required>
                    </div>

                    <div class="form-group">
                        <label for="variation_poids">Variation poids (kg)</label>
                        <input type="number" id="variation_poids" name="variation_poids" step="0.1" placeholder="Ex: -1 ou 0.5" required>
                    </div>

                    <div class="form-group">
                        <label for="duree">Durée (jours)</label>
                        <input type="number" id="duree" name="duree" placeholder="Ex: 30" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Prix (€)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Ex: 99.99" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="regime-btn-submit">Valider et Créer le Régime</button>
                        <button type="button" id="regime-btn-cancel" onclick="resetToCreateModeRegime()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/regimes.js"></script>
<?= $this->endSection() ?>
