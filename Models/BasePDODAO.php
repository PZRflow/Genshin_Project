<?php
namespace Models;

use PDO;
use Config\Config;

abstract class BasePDODAO
{
    private ?PDO $db = null;

    // Retourne une instance de PDO (singleton)
    protected function getDB(): PDO
    {
        if ($this->db === null) {
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');

            $this->db = new PDO($dsn, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->db;
    }

    // Exécute une requête SQL
    protected function execRequest(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->getDB()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
