<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Supermarché</title>
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/bootstrap-icons/bootstrap-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
</head>
<body class="login-body">
    <div class="login-container animate-fadeIn">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="bi bi-cart4"></i>
                </div>
                <h1>Supermarché</h1>
                <p class="login-subtitle">Système de caisse</p>
            </div>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show animate-shake" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo url('login'); ?>" class="login-form">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="login" name="login" 
                           placeholder="Identifiant" required autofocus>
                    <label for="login"><i class="bi bi-person me-2"></i>Identifiant</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Mot de passe" required>
                    <label for="password"><i class="bi bi-lock me-2"></i>Mot de passe</label>
                </div>
                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </button>
            </form>

            <div class="login-footer">
                <small>TD - SI-IHM &copy; <?php echo date('Y'); ?></small>
            </div>
        </div>
    </div>

    <script src="<?php echo asset('js/bootstrap.min.js'); ?>"></script>
</body>
</html>
