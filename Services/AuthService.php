<?php
namespace Services;

use Models\UserDAO;

class AuthService {
    private UserDAO $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
        // Démarre la session si ce n'est pas déjà fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(string $username, string $password): bool {
        $user = $this->userDAO->getByUsername($username);

        // Si l'user existe et que le mot de passe correspond au hash
        if ($user && password_verify($password, $user->getHashPwd())) {
            // On stocke les infos en session
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            return true;
        }
        return false;
    }

    public function logout(): void {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
    }

    // Vérifie si quelqu'un est connecté
    public static function isAuthenticated(): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    // Récupère l'ID du user connecté
    public static function getCurrentUserId(): ?string {
        return $_SESSION['user_id'] ?? null;
    }
}