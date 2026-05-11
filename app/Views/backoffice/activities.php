<?php

    $success = session()->getFlashData('success');
    $error = session()->getFlashData('error');

?>
<?= $this->extend('sidebar/sidebar') ?>

<?= $this->section('css') ?>
    <link rel="stylesheet" href="/assets/css/activities.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="table-container">
    <div class="table-header">
        <div>
            <h2>Gestion des Activités</h2>
            <p>Visualisez, modifiez ou supprimez les activités.</p>
        </div>
        <!-- Bouton pour ouvrir le formulaire d'ajout -->
        <button class="btn-add" onclick="toggleForm('add')">+ Nouvelle Activité</button>
    </div>

    <!-- ZONE FORMULAIRE DYNAMIQUE -->
    <div id="form-zone" class="form-card" style="display: none;">
        <div class="form-header">
            <h3 id="form-title">Ajouter une activité</h3>
            <button class="btn-close" onclick="closeForm()">×</button>
        </div>
        
        <form id="activity-form" action="/admin/activites/save" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="input-id">
            
            <div class="form-grid">
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" id="input-label" placeholder="Ex: Course à pied" required>
                </div>
                <div class="form-group">
                    <label>Variation de poids (kg)</label>
                    <input type="number" step="0.01" name="variation_poids" id="input-variation" placeholder="Ex: -0.5" required>
                </div>
                <div class="form-group">
                    <label>Fréquence</label>
                    <input type="number" step="0.01" name="frequence" id="input-frequence" placeholder="Ex: -0.5" required>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-save">Validee et Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- ALERTES -->
    <?php if(isset($success)): ?> <div class="flash success" id='success'><?= $success ?></div> <?php endif; ?>
    <?php if(isset($error)): ?> <div class="flash error" id='error'><?= $error ?></div> <?php endif; ?>

    <!-- TABLEAU -->
    <div class="responsive-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Variation</th>
                    <th>Fréquence</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($activities as $activity): ?>
                    <tr>
                        <td><strong>#<?= $activity['id'] ?></strong></td>
                        <td><?= esc($activity['label']) ?></td>
                        <td class="<?= $activity['variation_poids'] < 0 ? 'text-loss' : 'text-gain' ?>">
                            <?= $activity['variation_poids'] ?> kg
                        </td>
                        <td><span class="badge"><?= $activity['frequence'] ?></span></td>
                        <td>
                            <!-- Appel JS avec les données de la ligne -->
                            <button class="btn-edit" onclick="toggleForm('edit', <?= htmlspecialchars(json_encode($activity)) ?>)">Modifier</button>
                            
                            <form action="/admin/activites/delete/<?= $activity['id'] ?>" method="post" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                                <button type="submit" class="btn-delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="/assets/js/activities.js"></script>
<?= $this->endSection() ?>