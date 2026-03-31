<?php

class CaisseController
{
    public static function choisir()
    {
        if (!isset($_SESSION['user_id'])) {
              Flight::redirect(url('login'));
            return;
        }

        $db = Flight::db();
        $model = new Caisse($db);
        $caisses = $model->findAll();

        Flight::render('choisir_caisse', ['caisses' => $caisses]);
    }

    public static function valider()
    {
        if (!isset($_SESSION['user_id'])) {
                Flight::redirect(url('login'));
            return;
        }

        $caisseId = Flight::request()->data->caisse_id;

        if ($caisseId) {
            $db = Flight::db();
            $model = new Caisse($db);
            $caisse = $model->findById($caisseId);

            if ($caisse) {
                $_SESSION['caisse_id'] = $caisse['id'];
                $_SESSION['caisse_numero'] = $caisse['numero'];
                $_SESSION['caisse_libelle'] = $caisse['libelle'];
                    Flight::redirect(url('accueil'));
                return;
            }
        }

            Flight::redirect(url('caisses'));
    }

    public static function changer()
    {
        unset($_SESSION['caisse_id'], $_SESSION['caisse_numero'], $_SESSION['caisse_libelle']);
            Flight::redirect(url('caisses'));
    }
}
