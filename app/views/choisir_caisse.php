<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir une caisse - Supermarché</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-body">
    <div class="login-container animate-fadeIn">
        <div class="login-card caisse-card">
            <div class="login-header">
                <div class="login-icon caisse-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <h1>Choisir Caisse</h1>
                <p class="login-subtitle">Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom']); ?></p>
            </div>

            <form method="POST" action="caisses/valider" class="login-form">
                <div class="mb-4">
                    <label for="caisse_id" class="form-label fw-semibold">
                        <i class="bi bi-cash-stack me-2"></i>Sélectionnez une caisse
                    </label>
                    <select class="form-select form-select-lg" id="caisse_id" name="caisse_id" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($caisses as $caisse): ?>
                            <option value="<?php echo $caisse['id']; ?>">
                                Caisse n°<?php echo $caisse['numero']; ?> - <?php echo htmlspecialchars($caisse['libelle']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-login w-100">
                    <i class="bi bi-check-circle me-2"></i>Valider
                </button>
            </form>

            <div class="mt-3 text-center">
                <a href="logout" class="text-muted text-decoration-none">
                    <i class="bi bi-box-arrow-left me-1"></i>Déconnexion
                </a>
            </div>

            <div class="login-footer">
                <small>TD - SI-IHM &copy; <?php echo date('Y'); ?></small>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
