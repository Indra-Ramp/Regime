<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - VitalVibe</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>

    <div class="container">
        <header class="db-header">
            <h1>Tableau de bord</h1>
            <p>Suivi et analyses de l'activité de VitalVibe</p>
        </header>

        <!-- <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-label">Inscriptions totales</span>
                <span class="stat-value">1,248</span>
                <span class="stat-trend">▲ +12% cette semaine</span>
            </div>
            <div class="stat-card">
                <span class="stat-label">Abonnements Actifs</span>
                <span class="stat-value">342</span>
                <span class="stat-trend" style="color: var(--primary);">Vitalité & Énergie</span>
            </div>
        </div> -->

        <div class="chart-card">
            <h2>Évolution des utilisateurs inscrits</h2>
            <div class="chart-wrapper">
                <canvas id="countUserChart" 
                    data-labels='<?= $chartLabels ?>' 
                    data-values='<?= $chartData ?>'>
                </canvas>
            </div>
        </div>

        <div class="chart-card">
            <h2>Types d'abonnement</h2>
            <div class="chart-wrapper">
                <canvas id="typeAbonnementChart" 
                    data-labels='<?= $chartTypeLabels ?>' 
                    data-values='<?= $chartTypeData ?>'>
                </canvas>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
</body>
</html>