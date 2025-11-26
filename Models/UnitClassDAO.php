<?php
namespace Models;

use PDO;

class UnitClassDAO extends BasePDODAO
{
    /**
     * Récupère toutes les classes d'unités de la base de données.
     *
     * @return array Tableau associatif contenant les données brutes des classes.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM unitclass";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une classe d'unité spécifique par son identifiant.
     *
     * @param string $id L'identifiant de la classe.
     * @return array|null Les données brutes de la classe ou null.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM unitclass WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Ajoute une nouvelle classe d'unité en base de données.
     *
     * @param UnitClass $unitClass L'objet UnitClass à insérer.
     * @return void
     */
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