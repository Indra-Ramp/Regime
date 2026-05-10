<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-Admin</title>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>
<body>
    <div class="container">
        <div class="row">
            <label for="CountUser">Les utilisateurs inscrits</label>
            <div class='col-md-8' style='width: 80%; margin: 0 auto;'>
                <h1>Counter User Dashboard</h1>
                <canvas id="countUserChart" data-labels='<?= $chartLabels?>' data-values='<?= $chartData?>'></canvas>
            </div>

            <label for="Comparaison">Repartition Abonnements</label>
            <div class='col-md-4' style='width: 80%; margin: 0 auto;'>
                <h1>Repartition Abonnements</h1>
                <canvas id="typeAbonnementChart" data-labels='<?= $chartTypeLabels?>' data-values='<?= $chartTypeData?>'></canvas>
            </div>
        </div>
    </div>

    <script src="https://jsdelivr.net"></script>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
</body>
</html>