<?php
namespace Services;

use Models\UserDAO;

class AuthService {
    private UserDAO $userDAO;

    /**
     * Constructeur du service d'authentification.
     * Démarre la session si elle n'est pas active.
     *
     * @param UserDAO $userDAO DAO pour l'accès aux utilisateurs.
     */
    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Tente de connecter un utilisateur.
     *
     * @param string $username Le nom d'utilisateur.
     * @param string $password Le mot de passe en clair.
     * @return bool Vrai si la connexion réussit, faux sinon.
     */
    public function login(string $username, string $password): bool {
        $user = $this->userDAO->getByUsername($username);

        if ($user && password_verify($password, $user->getHashPwd())) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            return true;
        }
        return false;
    }

    /**
     * Déconnecte l'utilisateur courant et détruit la session.
     *
     * @return void
     */
    public function logout(): void {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
    }

    /**
     * Vérifie si un utilisateur est actuellement connecté.
     *
     * @return bool Vrai si une session utilisateur existe.
     */
    public static function isAuthenticated(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    /**
     * Récupère l'identifiant de l'utilisateur connecté.
     *
     * @return string|null L'ID de l'utilisateur ou null si non connecté.
     */
    public static function getCurrentUserId(): ?string {
        return $_SESSION['user_id'] ?? null;
    }
}