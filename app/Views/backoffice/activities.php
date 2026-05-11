<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="/assets/css/activities.css">
</head>
<body>
    <div class="table-container">
        <div class="table-header">
            <h2>Liste des Activités</h2>
            <p>Visualisez, modifiez ou supprimez les activités du programme.</p>
        </div>
        <div class="responsive-table">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Label</th>
                        <th>Variation de poids</th>
                        <th>Fréquence</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($activities as $activity): ?>
                        <tr>
                            <input type="hidden" name="id" value="<?= $activity['id'] ?>">
                            <td><?= $activity['id'] ?></td>
                            <td><?= $activity['label'] ?></td>
                            <td><?= $activity['variation_poids'] ?></td>
                            <td><?= $activity['frequence'] ?></td>
                            <td>
                                <a href="/admin/activites/update/<?= $activity['id'] ?>">Modifier</a>
                                <form action="/admin/activites/delete/<?= $activity['id'] ?>" method="post" style="display:inline;">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>