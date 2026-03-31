<div class="content-header">
    <h2><i class="bi bi-receipt me-2"></i>Détail Achat #<?php echo $achat['id']; ?></h2>
</div>
<div class="content-body">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="info-card">
                <p><strong><i class="bi bi-calendar me-1"></i>Date :</strong> <?php echo date('d/m/Y H:i', strtotime($achat['date_achat'])); ?></p>
                <p><strong><i class="bi bi-cash-stack me-1"></i>Caisse :</strong> n°<?php echo $achat['caisse_numero']; ?></p>
                <p><strong><i class="bi bi-person me-1"></i>Caissier :</strong> <?php echo htmlspecialchars($achat['utilisateur_nom']); ?></p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th class="text-end">Prix Unit.</th>
                    <th class="text-center">Qté</th>
                    <th class="text-end">Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignes as $ligne): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ligne['designation']); ?></td>
                        <td class="text-end"><?php echo number_format($ligne['prix_unitaire'], 0, ',', ' '); ?></td>
                        <td class="text-center"><?php echo $ligne['quantite']; ?></td>
                        <td class="text-end fw-bold"><?php echo number_format($ligne['montant'], 0, ',', ' '); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-end fw-bold fs-5">Total</td>
                    <td class="text-end fw-bold fs-5 text-primary"><?php echo number_format($achat['total'], 0, ',', ' '); ?> Ar</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <a href="<?php echo url('historique'); ?>" class="btn btn-outline-secondary mt-3">
        <i class="bi bi-arrow-left me-1"></i>Retour
    </a>
</div>
