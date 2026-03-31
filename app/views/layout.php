<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titre) ? htmlspecialchars($titre) : 'Supermarche'; ?> - Caisse n°<?php echo $_SESSION['caisse_numero']; ?></title>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="navbar-inner">
            <div class="navbar-brand-custom">
                <i class="bi bi-cart4 me-2"></i>
                TD - S4-IHM - ETU004352 - ETU004140<?php echo htmlspecialchars($_SESSION['user_login']); ?>
            </div>
            <div class="navbar-actions">
                <a href="changer-caisse" class="navbar-link">
                    <i class="bi bi-arrow-repeat me-1"></i>Changer Caisse
                </a>
                <a href="logout" class="navbar-link navbar-link-logout">
                    <i class="bi bi-box-arrow-right me-1"></i>Deconnexion
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-wrapper animate-fadeIn">
        <div class="content-grid">
            <!-- Sidebar -->
            <aside class="sidebar-card animate-slideInLeft">
                <div class="sidebar-header">
                    <i class="bi bi-cash-stack me-2"></i>
                    Caisse n°<?php echo $_SESSION['caisse_numero']; ?>
                </div>
                <nav class="sidebar-nav">
                    <a href="accueil" class="sidebar-link <?php echo ($content === 'accueil') ? 'active' : ''; ?>">
                        <i class="bi bi-house-door me-2"></i>Accueil
                    </a>
                    <a href="achats" class="sidebar-link <?php echo ($content === 'achats') ? 'active' : ''; ?>">
                        <i class="bi bi-bag-plus me-2"></i>Saisie Achats
                    </a>
                    <a href="historique" class="sidebar-link <?php echo ($content === 'historique' or $content === 'historique_detail') ? 'active' : ''; ?>">
                        <i class="bi bi-clock-history me-2"></i>Historique
                    </a>
                    <a href="produits" class="sidebar-link <?php echo ($content === 'produits' or $content === 'produit_form') ? 'active' : ''; ?>">
                        <i class="bi bi-box-seam me-2"></i>Produits
                    </a>
                </nav>
            </aside>

            <!-- Content Area -->
            <main class="content-card animate-slideInRight">
                <?php include __DIR__ . '/' . $content . '.php'; ?>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="footer-inner">
            <span>Copyright &copy; 4352 - 4140 <?php echo date('Y'); ?></span>
        </div>
    </footer>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
