<div class="content-header">
    <h2><i class="bi bi-bag-plus me-2"></i>Saisie des achats</h2>
</div>
<div class="content-body">
    <!-- Formulaire d'ajout -->
    <form method="POST" action="achats/ajouter" class="purchase-form mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="produit_id" class="form-label fw-semibold">
                    <i class="bi bi-box me-1"></i>Produit
                </label>
                <select class="form-select" id="produit_id" name="produit_id" required>
                    <option value="">-- Sélectionner un produit --</option>
                    <?php foreach ($produits as $p): ?>
                        <option value="<?php echo $p['id']; ?>">
                            <?php echo htmlspecialchars($p['designation']); ?> 
                            (<?php echo number_format($p['prix'], 0, ',', ' '); ?> F - Stock: <?php echo $p['quantite_stock']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="quantite" class="form-label fw-semibold">
                    <i class="bi bi-123 me-1"></i>Quantité
                </label>
                <input type="number" class="form-control" id="quantite" name="quantite" 
                       min="1" value="1" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-add w-100">
                    <i class="bi bi-plus-circle me-2"></i>Ajouter
                </button>
            </div>
        </div>
    </form>

    <!-- Tableau des lignes d'achat -->
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr>
                    <th><i class="bi bi-box me-1"></i>Produit</th>
                    <th class="text-end">Prix Unit.</th>
                    <th class="text-center">Qté</th>
                    <th class="text-end">Montant</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($lignes)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                            Aucun article. Ajoutez des produits ci-dessus.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($lignes as $index => $ligne): ?>
                        <tr class="animate-fadeInUp" style="animation-delay: <?php echo ($index * 0.05); ?>s">
                            <td class="fw-semibold"><?php echo htmlspecialchars($ligne['designation']); ?></td>
                            <td class="text-end"><?php echo number_format($ligne['prix_unitaire'], 0, ',', ' '); ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill"><?php echo $ligne['quantite']; ?></span>
                            </td>
                            <td class="text-end fw-bold"><?php echo number_format($ligne['montant'], 0, ',', ' '); ?></td>
                            <td class="text-center">
                                <form method="POST" action="achats/supprimer" class="d-inline">
                                    <input type="hidden" name="ligne_id" value="<?php echo $ligne['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-delete" 
                                            title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" class="text-end fw-bold fs-5">Total</td>
                    <td class="text-end fw-bold fs-5 text-primary">
                        <?php echo number_format($total, 0, ',', ' '); ?> F
                    </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bouton clôturer -->
    <?php if (!empty($lignes)): ?>
        <div class="d-flex justify-content-end mt-3">
            <form method="POST" action="achats/cloturer">
                <button type="submit" class="btn btn-success btn-cloturer"
                        onclick="return confirm('Clôturer cet achat ?')">
                    <i class="bi bi-check2-circle me-2"></i>Clôturer l'achat
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>
