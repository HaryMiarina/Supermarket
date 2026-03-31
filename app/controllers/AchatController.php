<?php

class AchatController
{
    public static function index()
    {
        if (!isset($_SESSION['user_id']) or !isset($_SESSION['caisse_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $achatModel = new Achat($db);
        $produitModel = new Produit($db);
        $ligneModel = new LigneAchat($db);

        // Trouver ou créer un achat en cours
        $achat = $achatModel->findEnCours($_SESSION['caisse_id'], $_SESSION['user_id']);
        if (!$achat) {
            $achatId = $achatModel->creer($_SESSION['caisse_id'], $_SESSION['user_id']);
            $achat = $achatModel->findById($achatId);
        }

        $produits = $produitModel->findAll();
        $lignes = $ligneModel->findByAchat($achat['id']);
        $total = $achatModel->calculerTotal($achat['id']);

        Flight::render('layout', [
            'content' => 'achats',
            'titre' => 'Saisie des achats',
            'produits' => $produits,
            'lignes' => $lignes,
            'total' => $total,
            'achat' => $achat
        ]);
    }

    public static function ajouter()
    {
        if (!isset($_SESSION['user_id']) or !isset($_SESSION['caisse_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $achatModel = new Achat($db);
        $produitModel = new Produit($db);
        $ligneModel = new LigneAchat($db);

        $produitId = intval(Flight::request()->data->produit_id);
        $quantite = intval(Flight::request()->data->quantite);

        if ($produitId > 0 and $quantite > 0) {
            $produit = $produitModel->findById($produitId);
            if ($produit and $produit['quantite_stock'] >= $quantite) {
                $achat = $achatModel->findEnCours($_SESSION['caisse_id'], $_SESSION['user_id']);
                if (!$achat) {
                    $achatId = $achatModel->creer($_SESSION['caisse_id'], $_SESSION['user_id']);
                } else {
                    $achatId = $achat['id'];
                }

                $ligneModel->ajouter($achatId, $produitId, $quantite, $produit['prix']);
                $produitModel->updateStock($produitId, $quantite);
            }
        }

        Flight::redirect(url('achats'));
    }

    public static function supprimer()
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $ligneModel = new LigneAchat($db);
        $ligneId = intval(Flight::request()->data->ligne_id);

        if ($ligneId > 0) {
            $ligneModel->supprimer($ligneId);
        }

        Flight::redirect(url('achats'));
    }

    public static function cloturer()
    {
        if (!isset($_SESSION['user_id']) or !isset($_SESSION['caisse_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $achatModel = new Achat($db);
        $achat = $achatModel->findEnCours($_SESSION['caisse_id'], $_SESSION['user_id']);

        if ($achat) {
            $achatModel->cloturer($achat['id']);
        }

        Flight::redirect(url('achats'));
    }
}
