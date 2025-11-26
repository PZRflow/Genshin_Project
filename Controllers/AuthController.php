<?php
namespace Controllers;

use Services\AuthService;
use Models\UserDAO;

class AuthController {
    // Note: Dans ton MainController tu as sûrement un système de template, adapte si besoin.
    private $templates;
    private AuthService $authService;

    public function __construct($templates) {
        $this->templates = $templates;
        $this->authService = new AuthService(new UserDAO());
    }

    // Affiche le formulaire
    public function displayLogin() {
        echo $this->templates->render('login', []);
    }

    // Traite le formulaire
    public function login() {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            if ($this->authService->login($_POST['username'], $_POST['password'])) {
                // Succès : Redirection vers l'accueil
                header('Location: index.php');
                exit;
            } else {
                // Echec
                echo $this->templates->render('login', ['error' => 'Identifiants incorrects']);
                return;
            }
        }
        // Si champs vides
        echo $this->templates->render('login', ['error' => 'Veuillez remplir tous les champs']);
    }

    public function logout() {
        $this->authService->logout();
        header('Location: index.php');
        exit;
    }
}