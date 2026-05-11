<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Régimes</title>
    <link rel="stylesheet" href="/assets/css/activities.css">
</head>
<body>
    <div class="table-container">
        <div class="table-header">
            <h2>Liste des Régimes</h2>
            <p>Visualisez, modifiez ou supprimez les régimes du programme.</p>
        </div>
        <div class="responsive-table col-md-8">
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>% Viande</th>
                            <th>% Poisson</th>
                            <th>% Volaille</th>
                            <th>Variation de poids</th>
                            <th>Durée (jours)</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($regimes as $regime): ?>
                            <tr>
                                <input type="hidden" name="id" value="<?= $regime['id'] ?>">
                                <td><?= $regime['id'] ?></td>
                                <td><?= $regime['perc_viande'] ?> %</td>
                                <td><?= $regime['perc_poisson'] ?> %</td>
                                <td><?= $regime['perc_volaille'] ?> %</td>
                                <td><?= $regime['variation_poids'] ?> kg</td>
                                <td><?= $regime['duree'] ?></td>
                                <td><?= $regime['price'] ?> €</td>
                                <td>
                                    <a href="/admin/regimes/update/<?= $regime['id'] ?>">Modifier</a>
                                    <form action="/admin/regimes/delete/<?= $regime['id'] ?>" method="post" style="display:inline;">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        <div style="margin-top: 20px;">
            <a href="/admin/regime-form" class="btn-add">+ Ajouter un régime</a>
        </div>
    </div>
</body>
</html>
