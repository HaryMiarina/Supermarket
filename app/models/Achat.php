<?php

class Achat
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function creer($caisseId, $utilisateurId)
    {
        $stmt = $this->db->prepare("INSERT INTO achat (caisse_id, utilisateur_id) VALUES (:c, :u)");
        $stmt->execute(['c' => $caisseId, 'u' => $utilisateurId]);
        return $this->db->lastInsertId();
    }

    public function findEnCours($caisseId, $utilisateurId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM achat WHERE caisse_id = :c AND utilisateur_id = :u AND cloture = 0 ORDER BY id DESC LIMIT 1"
        );
        $stmt->execute(['c' => $caisseId, 'u' => $utilisateurId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cloturer($id)
    {
        $total = $this->calculerTotal($id);
        $stmt = $this->db->prepare("UPDATE achat SET cloture = 1, total = :t WHERE id = :id");
        $stmt->execute(['t' => $total, 'id' => $id]);
    }

    public function calculerTotal($achatId)
    {
        $stmt = $this->db->prepare("SELECT COALESCE(SUM(montant), 0) as total FROM ligne_achat WHERE achat_id = :id");
        $stmt->execute(['id' => $achatId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function findAllClotures($caisseId = null)
    {
        $sql = "SELECT a.*, c.numero as caisse_numero, u.nom as utilisateur_nom 
                FROM achat a 
                JOIN caisse c ON a.caisse_id = c.id 
                JOIN utilisateur u ON a.utilisateur_id = u.id 
                WHERE a.cloture = 1";
        $params = [];
        if ($caisseId) {
            $sql .= " AND a.caisse_id = :c";
            $params['c'] = $caisseId;
        }
        $sql .= " ORDER BY a.date_achat DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT a.*, c.numero as caisse_numero, u.nom as utilisateur_nom 
             FROM achat a 
             JOIN caisse c ON a.caisse_id = c.id 
             JOIN utilisateur u ON a.utilisateur_id = u.id 
             WHERE a.id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
