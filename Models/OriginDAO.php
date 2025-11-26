<?php
namespace Models;

use PDO;

class OriginDAO extends BasePDODAO
{
    /**
     * Récupère la liste complète des origines en base de données.
     *
     * @return array Tableau associatif contenant les données brutes des origines.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM origin";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une origine spécifique par son identifiant.
     *
     * @param string $id L'identifiant de l'origine.
     * @return array|null Le tableau de données de l'origine ou null si non trouvée.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM origin WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Ajoute une nouvelle origine en base de données.
     *
     * @param Origin $origin L'objet Origin contenant les données à insérer.
     * @return void
     */
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