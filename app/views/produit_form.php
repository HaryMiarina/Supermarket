<div class="content-header">
    <h2><i class="bi bi-plus-circle me-2"></i>Ajouter un produit</h2>
</div>
<div class="content-body">
    <form method="POST" action="produits/ajouter" class="purchase-form" style="max-width: 500px">
        <div class="mb-3">
            <label for="designation" class="form-label fw-semibold">Désignation</label>
            <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label fw-semibold">Prix</label>
            <input type="number" class="form-control" id="prix" name="prix" min="0" step="1" required>
        </div>
        <div class="mb-4">
            <label for="quantite" class="form-label fw-semibold">Quantité en stock</label>
            <input type="number" class="form-control" id="quantite" name="quantite" min="0" value="0" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i>Enregistrer
            </button>
            <a href="produits" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-1"></i>Annuler
            </a>
        </div>
    </form>
</div>
