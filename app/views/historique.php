<div class="content-header">
    <h2><i class="bi bi-clock-history me-2"></i>Historique des achats</h2>
</div>
<div class="content-body">
    <?php if (empty($achats)): ?>
        <div class="text-center text-muted py-5">
            <i class="bi bi-inbox display-4 d-block mb-3"></i>
            <p class="lead">Aucun achat clôturé pour cette caisse.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Caisse</th>
                        <th>Caissier</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achats as $index => $a): ?>
                        <tr class="animate-fadeInUp" style="animation-delay: <?php echo ($index * 0.05); ?>s">
                            <td><?php echo $a['id']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($a['date_achat'])); ?></td>
                            <td>Caisse n°<?php echo $a['caisse_numero']; ?></td>
                            <td><?php echo htmlspecialchars($a['utilisateur_nom']); ?></td>
                            <td class="text-end fw-bold"><?php echo number_format($a['total'], 0, ',', ' '); ?> F</td>
                            <td class="text-center">
                                <a href="<?php echo url('historique/' . $a['id']); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Détail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
