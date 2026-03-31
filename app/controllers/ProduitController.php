<?php

class ProduitController
{
    public static function index()
    {
        if (!isset($_SESSION['user_id']) or !isset($_SESSION['caisse_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $model = new Produit($db);
        $produits = $model->findAll();

        Flight::render('layout', [
            'content' => 'produits',
            'titre' => 'Gestion des produits',
            'produits' => $produits
        ]);
    }

    public static function ajouterForm()
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        Flight::render('layout', [
            'content' => 'produit_form',
            'titre' => 'Ajouter un produit'
        ]);
    }

    public static function ajouter()
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect(url('login'));
            return;
        }

        $designation = trim(Flight::request()->data->designation);
        $prix = floatval(Flight::request()->data->prix);
        $quantite = intval(Flight::request()->data->quantite);

        if ($designation and $prix > 0 and $quantite >= 0) {
            $db = Flight::db();
            $model = new Produit($db);
            $model->create($designation, $prix, $quantite);
        }

        Flight::redirect(url('produits'));
    }
}
