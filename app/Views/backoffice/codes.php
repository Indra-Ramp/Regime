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
            <h2>Liste des Codes</h2>
            <p>Visualisez, modifiez ou supprimez les codes du programme.</p>
        </div>
        <?php if(isset($success)){?>
            <div class="success">
                <?= $success;?>
            </div>
        <?php } else if(isset($error)){ ?>
            <div class="error">
                <?= $error;?>
            </div>
        <?php }?>
        <div class="responsive-table">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>User</th>
                        <th>Statut</th>
                        <th>Date de suivi</th>
                        <th>Actions</th>
                        <th>Validations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($codes as $code): ?>
                        <tr>
                            <input type="hidden" name="id" value="<?= $code['id'] ?>">
                            <td><?= $code['id'] ?></td>
                            <td><?= $code['code'] ?></td>
                            <td><?= $code['id_user'] ?></td>
                            <td><?= $code['statut'] ?></td>
                            <td><?= $code['date_track'] ?></td>
                                <td>
                                    <a href="/admin/codes/update/<?= $code['id'] ?>">Modifier</a>
                                    <form action="/admin/codes/delete/<?= $code['id'] ?>" method="post" style="display:inline;">
                                        <button type="submit">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="/admin/codes/validate/<?= $code['id'] ?>">Validé</a>
                                    <form action="/admin/codes/refuse/<?= $code['id'] ?>" method="post" style="display:inline;">
                                        <button type="submit">Refusé</button>
                                    </form>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>