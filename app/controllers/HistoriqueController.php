<?php

class HistoriqueController
{
    public static function index()
    {
        if (!isset($_SESSION['user_id']) or !isset($_SESSION['caisse_id'])) {
                Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $achatModel = new Achat($db);
        $achats = $achatModel->findAllClotures($_SESSION['caisse_id']);

        Flight::render('layout', [
            'content' => 'historique',
            'titre' => 'Historique des achats',
            'achats' => $achats
        ]);
    }

    public static function detail($id)
    {
        if (!isset($_SESSION['user_id'])) {
                Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $achatModel = new Achat($db);
        $ligneModel = new LigneAchat($db);

        $achat = $achatModel->findById($id);
        $lignes = $ligneModel->findByAchat($id);

        if (!$achat) {
            Flight::redirect(url('historique'));
            return;
        }

        Flight::render('layout', [
            'content' => 'historique_detail',
            'titre' => 'Détail achat #' . $id,
            'achat' => $achat,
            'lignes' => $lignes
        ]);
    }
}
