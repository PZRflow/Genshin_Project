<?php
namespace Models;

use PDO;

class UserDAO extends BasePDODAO {

    /**
     * Récupère un utilisateur via son nom d'utilisateur.
     *
     * @param string $username Le nom d'utilisateur à rechercher.
     * @return User|null L'objet User trouvé ou null.
     */
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