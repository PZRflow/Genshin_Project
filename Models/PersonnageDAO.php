<?php
namespace Models;

use PDO;
use Services\LogService;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages de la base de données.
     *
     * @return array Tableau contenant les données brutes des personnages.
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un personnage spécifique par son ID.
     *
     * @param string $id L'identifiant du personnage.
     * @return array|null Les données brutes du personnage ou null.
     */
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Ajoute un nouveau personnage en base de données.
     * Enregistre l'action dans les logs.
     *
     * @param Personnage $personnage L'objet Personnage à insérer.
     * @return void
     */
    public function add(Personnage $personnage): void
    {
        $sql = "INSERT INTO personnage (id, name, element, unitclass, rarity, origin, url_img)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $elementID = is_object($personnage->getElementObj()) ? $personnage->getElementObj()->getId() : $personnage->getElement();
        $unitClassID = is_object($personnage->getUnitClassObj()) ? $personnage->getUnitClassObj()->getId() : $personnage->getUnitclass();
        $originID = is_object($personnage->getOriginObj()) ? $personnage->getOriginObj()->getId() : $personnage->getOrigin();

        $this->execRequest($sql, [
            $personnage->getId(),
            $personnage->getName(),
            $elementID,
            $unitClassID,
            $personnage->getRarity(),
            $originID,
            $personnage->getUrlImg()
        ]);

        if (class_exists('Services\LogService')) {
            LogService::logAction("CREATE", "Personnage \"{$personnage->getName()}\" ajouté (ID: {$personnage->getId()})");
        }
    }

    /**
     * Met à jour les informations d'un personnage existant.
     * Enregistre l'action dans les logs.
     *
     * @param Personnage $personnage L'objet Personnage mis à jour.
     * @return void
     */
    public function update(Personnage $personnage): void
    {
        $sql = "UPDATE personnage
                SET name = ?, element = ?, unitclass = ?, rarity = ?, origin = ?, url_img = ?
                WHERE id = ?";

        $elementID = is_object($personnage->getElementObj()) ? $personnage->getElementObj()->getId() : $personnage->getElement();
        $unitClassID = is_object($personnage->getUnitClassObj()) ? $personnage->getUnitClassObj()->getId() : $personnage->getUnitclass();
        $originID = is_object($personnage->getOriginObj()) ? $personnage->getOriginObj()->getId() : $personnage->getOrigin();

        $this->execRequest($sql, [
            $personnage->getName(),
            $elementID,
            $unitClassID,
            $personnage->getRarity(),
            $originID,
            $personnage->getUrlImg(),
            $personnage->getId()
        ]);

        if (class_exists('Services\LogService')) {
            LogService::logAction("UPDATE", "Personnage \"{$personnage->getName()}\" modifié (ID: {$personnage->getId()})");
        }
    }

    /**
     * Supprime un personnage de la base de données.
     * Enregistre l'action dans les logs.
     *
     * @param string $id L'identifiant du personnage à supprimer.
     * @return void
     */
    public function delete(string $id): void
    {
        $sql = "DELETE FROM personnage WHERE id = ?";
        $this->execRequest($sql, [$id]);

        if (class_exists('Services\LogService')) {
            LogService::logAction("DELETE", "Personnage supprimé (ID: $id)");
        }
    }

    /**
     * Vérifie si un personnage appartient à la collection d'un utilisateur.
     *
     * @param string $userId L'identifiant de l'utilisateur.
     * @param string $persoId L'identifiant du personnage.
     * @return bool Vrai si le personnage est dans la collection.
     */
    public function isInCollection(string $userId, string $persoId): bool {
        $sql = "SELECT count(*) as count FROM collection WHERE user_id = ? AND personnage_id = ?";
        $stmt = $this->execRequest($sql, [$userId, $persoId]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count'] > 0;
    }

    /**
     * Ajoute ou retire un personnage de la collection d'un utilisateur.
     *
     * @param string $userId L'identifiant de l'utilisateur.
     * @param string $persoId L'identifiant du personnage.
     * @return void
     */
    public function toggleCollection(string $userId, string $persoId): void {
        if ($this->isInCollection($userId, $persoId)) {
            $sql = "DELETE FROM collection WHERE user_id = ? AND personnage_id = ?";
            $this->execRequest($sql, [$userId, $persoId]);
        } else {
            $sql = "INSERT INTO collection (user_id, personnage_id) VALUES (?, ?)";
            $this->execRequest($sql, [$userId, $persoId]);
        }
    }

    /**
     * Récupère tous les personnages possédés par un utilisateur.
     *
     * @param string $userId L'identifiant de l'utilisateur.
     * @return array Tableau des données brutes des personnages de la collection.
     */
    public function getAllByUserId(string $userId): array {
        $sql = "SELECT p.* FROM personnage p
                JOIN collection c ON p.id = c.personnage_id
                WHERE c.user_id = ?";
        $stmt = $this->execRequest($sql, [$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}