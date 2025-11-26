<?php
namespace Models;

use PDO;

class UnitClassDAO extends BasePDODAO
{
    // Récupère tous les éléments
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un élément par son ID
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM unitclass WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajoute un élément
    public function add(UnitClass $unitClass): void
    {
        $sql = "INSERT INTO unitclass (id, name, url_img) VALUES (?, ?, ?)";
        $this->execRequest($sql, [
            $unitClass->getId(),
            $unitClass->getName(),
            $unitClass->getUrlImg()
        ]);
    }
}
