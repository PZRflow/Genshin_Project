<?php
namespace Models;

use PDO;

class ElementDAO extends BasePDODAO
{
    // Récupère tous les éléments
// Dans Models/ElementDAO.php

    public function getAll(): array
    {
        $sql = "SELECT * FROM element"; // Ou le nom exact de ta table
        $stmt = $this->execRequest($sql);

        // CORRECTION : On retourne directement le tableau brut
        // Au lieu de faire une boucle foreach { new Element(...) }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    // Récupère un élément par son ID
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM element WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajoute un élément
    public function add(Element $element): void
    {
        $sql = "INSERT INTO element (id, name, url_img) VALUES (?, ?, ?)";
        $this->execRequest($sql, [
            $element->getId(),
            $element->getName(),
            $element->getUrlImg()
        ]);
    }

    public function create(Element $element): bool {
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg()
        ]);
    }

}
