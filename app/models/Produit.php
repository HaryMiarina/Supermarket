<?php

class Produit
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $stmt = $this->db->query("SELECT * FROM produit ORDER BY designation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM produit WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateStock($id, $quantite)
    {
        $stmt = $this->db->prepare("UPDATE produit SET quantite_stock = quantite_stock - :qte WHERE id = :id");
        $stmt->execute(['qte' => $quantite, 'id' => $id]);
    }

    public function create($designation, $prix, $quantite)
    {
        $stmt = $this->db->prepare("INSERT INTO produit (designation, prix, quantite_stock) VALUES (:des, :prix, :qte)");
        $stmt->execute(['des' => $designation, 'prix' => $prix, 'qte' => $quantite]);
    }
}
