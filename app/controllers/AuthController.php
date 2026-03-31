<?php

class AuthController
{
    public static function loginForm()
    {
        if (isset($_SESSION['user_id'])) {
              Flight::redirect(url('caisses'));
            return;
        }
        Flight::render('login');
    }

    public static function login()
    {
        $login = trim(Flight::request()->data->login);
        $password = trim(Flight::request()->data->password);

        $db = Flight::db();
        $model = new Utilisateur($db);
        $user = $model->findByLogin($login);

        if ($user and $password === $user['mot_de_passe']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];
            $_SESSION['user_login'] = $user['login'];
                Flight::redirect(url('caisses'));
        } else {
            Flight::render('login', ['error' => 'Login ou mot de passe incorrect']);
        }
    }

    public static function logout()
    {
        session_destroy();
            Flight::redirect(url('login'));
    }
}
