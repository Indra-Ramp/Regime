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
        <h1>Gestion des Activités</h1>
        <p>Visualisez, modifiez ou supprimez vos activités d'un seul clic.</p>
    </header>

    <div id="toast" class="toast-notification"></div>

    <div class="dashboard-layout">
        
        <div class="table-column">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin: 0;">Liste des Activités</h3>
                <button class="btn-add" onclick="resetToCreateMode()">+ Nouvelle Activité</button>
            </div>
            <div class="table-container">

                <div class="responsive-table">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Label</th>
                                <th>Variation</th>
                                <th>Fréquence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="activities-table-body">
                            <?php foreach($activities as $activity): ?>
                                <tr id="row-<?= $activity['id'] ?>">
                                    <td><strong><?= $activity['id'] ?></strong></td>
                                    <td class="cell-label"><?= esc($activity['label']) ?></td>
                                    <td class="cell-variation">
                                        <?= $activity['variation_poids'] ?> kg
                                    </td>
                                    <td class="cell-frequence"><span class="badge"><?= $activity['frequence'] ?> jours</span></td>
                                    <td>
                                        <button class="btn-edit" onclick="setupEditMode(<?= $activity['id'] ?>, '<?= esc($activity['label'], 'js') ?>', <?= $activity['variation_poids'] ?>, <?= $activity['frequence'] ?>)">Modifier</button>
                                        <button class="btn-delete" onclick="deleteActivity(<?= $activity['id'] ?>)">Supprimer</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-column">
            <h2 id="form-title">Créer votre parcours</h2>
            <p id="form-subtitle" class="form-subtitle">Remplissez les champs pour ajouter une nouvelle activité.</p>

            <form id="activity-form-ajax">
                <input type="hidden" name="id" id="activity_id">

                <div class="form-group">
                    <label for="label">Nom de l'activité</label>
                    <input type="text" id="label" name="label" placeholder="Ex: Course à pied, Yoga..." required>
                </div>

                <div class="form-group">
                    <label for="variation_poids">Variation de poids (en kg)</label>
                    <input type="number" id="variation_poids" name="variation_poids" step="0.1" placeholder="Ex: -0.5 ou 1.2" required>
                </div>
                
                <div class="form-group">
                    <label for="frequence">Fréquence idéale (en jours)</label>
                    <input type="number" id="frequence" name="frequence" placeholder="Ex: 3" required>
                </div>

                <div class="form-actions">
                    <button type="submit" id="btn-submit">Valider et Créer l'Activité</button>
                    <button type="button" id="btn-cancel" onclick="resetToCreateMode()">Annuler</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script src="/assets/js/activities.js"></script>
<?= $this->endSection() ?>