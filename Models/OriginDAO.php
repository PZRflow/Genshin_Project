<?php
namespace Models;

use PDO;

class OriginDAO extends BasePDODAO
{
    // Récupère tous les éléments
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin"; // Vérifie le nom de ta table
        $stmt = $this->execRequest($sql);

        // CORRECTION : On renvoie directement le tableau brut
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Récupère un élément par son ID
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM origin WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajoute un élément
    public function add(Origin $origin): void
    {
        $sql = "INSERT INTO origin (id, name, url_img) VALUES (?, ?, ?)";
        $this->execRequest($sql, [
            $origin->getId(),
            $origin->getName(),
            $origin->getUrlImg()
        ]);
    }
}
