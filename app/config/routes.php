<?php

// --- Authentification ---
Flight::route('GET /login', ['AuthController', 'loginForm']);
Flight::route('POST /login', ['AuthController', 'login']);
Flight::route('GET /logout', ['AuthController', 'logout']);

// --- Choix de caisse ---
Flight::route('GET /caisses', ['CaisseController', 'choisir']);
Flight::route('POST /caisses/valider', ['CaisseController', 'valider']);

// --- Page d'accueil (caisse sélectionnée) ---
Flight::route('GET /', ['AccueilController', 'index']);
Flight::route('GET /accueil', ['AccueilController', 'index']);

// --- Achats ---
Flight::route('GET /achats', ['AchatController', 'index']);
Flight::route('POST /achats/ajouter', ['AchatController', 'ajouter']);
Flight::route('POST /achats/supprimer', ['AchatController', 'supprimer']);
Flight::route('POST /achats/cloturer', ['AchatController', 'cloturer']);

// --- Historique ---
Flight::route('GET /historique', ['HistoriqueController', 'index']);
Flight::route('GET /historique/@id', ['HistoriqueController', 'detail']);

// --- Produits (gestion) ---
Flight::route('GET /produits', ['ProduitController', 'index']);
Flight::route('GET /produits/ajouter', ['ProduitController', 'ajouterForm']);
Flight::route('POST /produits/ajouter', ['ProduitController', 'ajouter']);

// --- Changer de caisse ---
Flight::route('GET /changer-caisse', ['CaisseController', 'changer']);
