<?php
namespace Models;

use PDO;

class UserDAO extends BasePDODAO {

    // Récupère un utilisateur par son username
    public function getByUsername(string $username): ?User {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->execRequest($sql, [$username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new User($data);
        }
        return null;
    }
}