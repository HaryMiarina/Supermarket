<div class="content-header d-flex justify-content-between align-items-center">
    <h2><i class="bi bi-box-seam me-2"></i>Produits</h2>
    <a href="produits/ajouter" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle me-1"></i>Ajouter
    </a>
</div>
<div class="content-body">
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Désignation</th>
                    <th class="text-end">Prix</th>
                    <th class="text-center">Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $index => $p): ?>
                    <tr class="animate-fadeInUp" style="animation-delay: <?php echo ($index * 0.05); ?>s">
                        <td><?php echo $p['id']; ?></td>
                        <td class="fw-semibold"><?php echo htmlspecialchars($p['designation']); ?></td>
                        <td class="text-end"><?php echo number_format($p['prix'], 0, ',', ' '); ?> Ar</td>
                        <td class="text-center">
                            <?php if ($p['quantite_stock'] > 20): ?>
                                <span class="badge bg-success"><?php echo $p['quantite_stock']; ?></span>
                            <?php elseif ($p['quantite_stock'] > 5): ?>
                                <span class="badge bg-warning"><?php echo $p['quantite_stock']; ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger"><?php echo $p['quantite_stock']; ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
