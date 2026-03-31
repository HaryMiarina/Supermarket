<?php

class Utilisateur
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByLogin($login)
    {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE login = :login");
        $stmt->execute(['login' => $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM utilisateur WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
