<?php

class LigneAchat
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ajouter($achatId, $produitId, $quantite, $prixUnitaire)
    {
        $montant = $quantite * $prixUnitaire;

        // Vérifier si le produit existe déjà dans cet achat
        $stmt = $this->db->prepare(
            "SELECT * FROM ligne_achat WHERE achat_id = :a AND produit_id = :p"
        );
        $stmt->execute(['a' => $achatId, 'p' => $produitId]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $newQte = $existing['quantite'] + $quantite;
            $newMontant = $newQte * $prixUnitaire;
            $stmt = $this->db->prepare(
                "UPDATE ligne_achat SET quantite = :q, montant = :m WHERE id = :id"
            );
            $stmt->execute(['q' => $newQte, 'm' => $newMontant, 'id' => $existing['id']]);
        } else {
            $stmt = $this->db->prepare(
                "INSERT INTO ligne_achat (achat_id, produit_id, quantite, prix_unitaire, montant) 
                 VALUES (:a, :p, :q, :pu, :m)"
            );
            $stmt->execute([
                'a' => $achatId,
                'p' => $produitId,
                'q' => $quantite,
                'pu' => $prixUnitaire,
                'm' => $montant
            ]);
        }
    }

    public function findByAchat($achatId)
    {
        $stmt = $this->db->prepare(
            "SELECT la.*, p.designation 
             FROM ligne_achat la 
             JOIN produit p ON la.produit_id = p.id 
             WHERE la.achat_id = :id 
             ORDER BY la.id"
        );
        $stmt->execute(['id' => $achatId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimer($id)
    {
        $stmt = $this->db->prepare("DELETE FROM ligne_achat WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
