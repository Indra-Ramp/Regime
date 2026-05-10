<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codes</title>
    <link rel="stylesheet" href="/assets/css/activities.css">
</head>
<body>
    <div class="table-container">
        <div class="table-header">
            <h2>Liste des Codes</h2>
            <p>Visualisez, modifiez ou supprimez les codes du programme.</p>
        </div>
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
</body>
</html>