<?php
namespace Models;

use PDO;
use Services\LogService;

class PersonnageDAO extends BasePDODAO
{
    // Récupère tous les personnages sous forme de tableaux bruts
    public function getAll(): array
    {
        $sql = "SELECT * FROM personnage";
        $stmt = $this->execRequest($sql);
        // On retourne directement le tableau de tableaux.
        // C'est le Service qui fera new Personnage($data)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un personnage par son ID (Tableau brut ou null)
    public function getByID(string $id): ?array
    {
        $sql = "SELECT * FROM personnage WHERE id = ?";
        $stmt = $this->execRequest($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Ajoute un personnage
    public function add(Personnage $personnage): void
    {
        $sql = "INSERT INTO personnage (id, name, element, unitclass, rarity, origin, url_img)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // ATTENTION : Ici, il faut s'assurer d'envoyer les ID (int) et pas les Objets complets.
        // Si ton getter retourne un objet, il faut faire ->getId(). Sinon, on garde la valeur.

        // Exemple de logique ternaire pour gérer si c'est un Objet ou un Int
        $elementID = is_object($personnage->getElementObj()) ? $personnage->getElementObj()->getId() : $personnage->getElement();
        $unitClassID = is_object($personnage->getUnitClassObj()) ? $personnage->getUnitClassObj()->getId() : $personnage->getUnitclass();
        $originID = is_object($personnage->getOriginObj()) ? $personnage->getOriginObj()->getId() : $personnage->getOrigin();

        $this->execRequest($sql, [
            $personnage->getId(),
            $personnage->getName(),
            $elementID,     // On envoie l'ID
            $unitClassID,   // On envoie l'ID
            $personnage->getRarity(),
            $originID,      // On envoie l'ID
            $personnage->getUrlImg()
        ]);

        // Si tu as une classe LogService statique :
        if (class_exists('Services\LogService')) {
            LogService::logAction("CREATE", "Personnage \"{$personnage->getName()}\" ajouté (ID: {$personnage->getId()})");
        }
    }

    // Met à jour un personnage
    public function update(Personnage $personnage): void
    {
        $sql = "UPDATE personnage
                SET name = ?, element = ?, unitclass = ?, rarity = ?, origin = ?, url_img = ?
                WHERE id = ?";

        // Même logique de sécurité pour les IDs
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

    // Supprime un personnage
    public function delete(string $id): void
    {
        $sql = "DELETE FROM personnage WHERE id = ?";
        $this->execRequest($sql, [$id]);

        if (class_exists('Services\LogService')) {
            LogService::logAction("DELETE", "Personnage supprimé (ID: $id)");
        }
    }

    // --- GESTION COLLECTION (PARTIE 06) ---

    // Vérifie si un user possède un perso
    public function isInCollection(string $userId, string $persoId): bool {
        $sql = "SELECT count(*) as count FROM collection WHERE user_id = ? AND personnage_id = ?";
        $stmt = $this->execRequest($sql, [$userId, $persoId]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count'] > 0;
    }

    // Ajoute ou retire le perso de la collection (Switch)
    public function toggleCollection(string $userId, string $persoId): void {
        if ($this->isInCollection($userId, $persoId)) {
            // S'il l'a déjà, on supprime (DELETE)
            $sql = "DELETE FROM collection WHERE user_id = ? AND personnage_id = ?";
            $this->execRequest($sql, [$userId, $persoId]);
        } else {
            // S'il ne l'a pas, on ajoute (INSERT)
            $sql = "INSERT INTO collection (user_id, personnage_id) VALUES (?, ?)";
            $this->execRequest($sql, [$userId, $persoId]);
        }
    }

    // Récupère uniquement les personnages de la collection d'un user
    // Retourne des tableaux bruts pour que le Service les transforme
    public function getAllByUserId(string $userId): array {
        $sql = "SELECT p.* FROM personnage p
                JOIN collection c ON p.id = c.personnage_id
                WHERE c.user_id = ?";
        $stmt = $this->execRequest($sql, [$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}