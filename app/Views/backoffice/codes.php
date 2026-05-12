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
            <h1>Codes</h1>
            <p>Gérez et modifiez les codes de promotion du programme</p>
        </header>
        <div id="toast-code"></div>
        
        <div class="dashboard-layout">
            <!-- COLONNE GAUCHE: Tableau des codes -->
            <div class="table-column">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h3 style="margin: 0;">Liste des Codes</h3>
                    <button class="btn-add" onclick="resetToCreateModeCode()">+ Nouveau Code</button>
                </div>
                <div class="responsive-table">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>User ID</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                                <th>Validations</th>
                            </tr>
                        </thead>
                        <tbody id="codes-table-body">
                            <?php foreach($codes as $code): ?>
                                <tr id="code-row-<?= $code['id'] ?>">
                                    <td><strong><?= $code['id'] ?></strong></td>
                                    <td class="cell-code"><?= $code['code'] ?></td>
                                    <td class="cell-user"><?= $code['id_user'] ?></td>
                                    <td class="cell-statut"><?= $code['statut'] ?></td>
                                    <td class="cell-date"><?= $code['date_track'] ?></td>
                                    <td>
                                        <button class="btn-edit" onclick="setupEditModeCode(<?= $code['id'] ?>, '<?= $code['code'] ?>', <?= $code['id_user'] ?>, '<?= $code['statut'] ?>', '<?= $code['date_track'] ?>')">Modifier</button>
                                        <button class="btn-delete" onclick="deleteCode(<?= $code['id'] ?>)">Supprimer</button>
                                    </td>
                                    <td>
                                        <button class="btn-edit" onclick="validateCode(<?= $code['id'] ?>)">Valider</button>
                                        <button class="btn-delete" onclick="refuseCode(<?= $code['id'] ?>)">Refuser</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- COLONNE DROITE: Formulaire AJAX -->
            <div class="form-column">
                <h2 id="code-form-title">Créer un code</h2>
                <p class="form-subtitle" id="code-form-subtitle">Remplissez les champs pour ajouter un nouveau code.</p>

                <form id="code-form-ajax">
                    <input type="hidden" id="code_id" name="code_id" value="<?= $code['id'] ?>">

                    <div class="form-group">
                        <label for="code">Code</label>
                        <input type="text" id="code" name="code" placeholder="Ex: CODE001" required>
                    </div>

                    <div class="form-group">
                        <label for="id_user">Utilisateur</label>
                        <select id="id_user" name="id_user" required>
                            <?php foreach($users as $user):?>
                                <option value="<?= $user['id'];?>"><?= $user['nom'] ?> <?= $user['prenom'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select id="statut" name="statut" required>
                            <option value="en attente">En attente</option>
                            <option value="valide">Valide</option>
                            <option value="refuse">Refusé</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_track">Date de suivi</label>
                        <input type="date" id="date_track" name="date_track" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="code-btn-submit">Valider et Créer le Code</button>
                        <button type="button" id="code-btn-cancel" onclick="resetToCreateModeCode()">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/codes.js"></script>
<?= $this->endSection() ?>