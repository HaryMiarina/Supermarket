<?php

class AccueilController
{
    public static function index()
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect(url('login'));
            return;
        }
        if (!isset($_SESSION['caisse_id'])) {
            Flight::redirect(url('caisses'));
            return;
        }

        Flight::render('layout', [
            'content' => 'accueil',
            'titre' => 'Accueil'
        ]);
    }
}
