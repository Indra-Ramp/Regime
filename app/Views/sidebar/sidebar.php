<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <?= $this->renderSection('css') ?>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <a href="/" class="brand">
                <span class="brand-vibe">Vital</span>Vibe
            </a>
        </div>

        <nav class="sidebar-nav">
            <ul>
                <!-- Dashboard -->
                <li>
                    <a href="/admin/dashboard" class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        Dashboard
                    </a>
                </li>

                <!-- Régime -->
                <li>
                    <a href="/admin/regimes" class="<?= (uri_string() == 'admin/regimes') ? 'active' : '' ?>">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                        Régime
                    </a>
                </li>

                <!-- Activité -->
                <li>
                    <a href="/admin/activities" class="<?= (uri_string() == 'admin/activities') ? 'active' : '' ?>">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                        Activité
                    </a>
                </li>

                <!-- Code -->
                <li>
                    <a href="/admin/codes" class="<?= (uri_string() == 'admin/codes') ? 'active' : '' ?>">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 18l6-6-6-6"></path><path d="M8 6l-6 6 6 6"></path></svg>
                        Codes
                    </a>
                </li>

                <hr class="nav-divider">

                <!-- Déconnexion -->
                <li>
                    <a href="/logout" class="logout-link">
                        <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Déconnexion
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="content-area">
        <?= $this->renderSection('content') ?>
    </main>
</body>
</html>