<?php
namespace Models;

use PDO;

class ElementDAO extends BasePDODAO
{
    /**
     * Récupère la liste complète des éléments en base de données.
     *
     * @return array Tableau associatif contenant les données brutes des éléments.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM element";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un élément spécifique par son identifiant.
     *
     * @param string $id L'identifiant de l'élément.
     * @return array|null Le tableau de données de l'élément ou null si non trouvé.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM element WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Ajoute un nouvel élément en base de données.
     *
     * @param Element $element L'objet Element contenant les données à insérer.
     * @return void
     */
    public function add(Element $element): void
    {
        $sql = "INSERT INTO element (id, name, url_img) VALUES (?, ?, ?)";
        $this->execRequest($sql, [
            $element->getId(),
            $element->getName(),
            $element->getUrlImg()
        ]);
    }

    /**
     * Méthode alternative de création (Note : semble redondante avec add).
     *
     * @param Element $element L'objet Element à créer.
     * @return bool
     */
    public function create(Element $element): bool {
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg()
        ]);
        return true;
    }
}