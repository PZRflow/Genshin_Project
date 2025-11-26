<?php
namespace Controllers;

use Services\AuthService;
use Models\UserDAO;

class AuthController {
    private $templates;
    private AuthService $authService;

    /**
     * Constructeur du contrôleur d'authentification.
     *
     * @param object $templates Moteur de template.
     */
    public function __construct($templates) {
        $this->templates = $templates;
        $this->authService = new AuthService(new UserDAO());
    }

    /**
     * Affiche le formulaire de connexion.
     *
     * @return void
     */
    public function displayLogin() {
        echo $this->templates->render('login', []);
    }

    /**
     * Traite la soumission du formulaire de connexion.
     * Vérifie les identifiants et redirige ou affiche une erreur.
     *
     * @return void
     */
    public function login() {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            if ($this->authService->login($_POST['username'], $_POST['password'])) {
                header('Location: index.php');
                exit;
            } else {
                echo $this->templates->render('login', ['error' => 'Identifiants incorrects']);
                return;
            }
        }
        echo $this->templates->render('login', ['error' => 'Veuillez remplir tous les champs']);
    }

    /**
     * Déconnecte l'utilisateur et redirige vers l'accueil.
     *
     * @return void
     */
    public function logout() {
        $this->authService->logout();
        header('Location: index.php');
        exit;
    }
}