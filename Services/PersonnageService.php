<?php
namespace Services;

use Models\Personnage;
use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\UnitClassDAO;
use Models\OriginDAO;
use Models\Element;
use Models\UnitClass;
use Models\Origin;

class PersonnageService
{
    private PersonnageDAO $personnageDAO;
    private ElementDAO $elementDAO;
    private UnitClassDAO $unitClassDAO;
    private OriginDAO $originDAO;

    public function __construct(
        PersonnageDAO $personnageDAO,
        ElementDAO $elementDAO,
        UnitClassDAO $unitClassDAO,
        OriginDAO $originDAO
    ) {
        $this->personnageDAO = $personnageDAO;
        $this->elementDAO = $elementDAO;
        $this->unitClassDAO = $unitClassDAO;
        $this->originDAO = $originDAO;
    }

    // Récupère tous les personnages (avec leurs éléments/unitclass/origines)
    public function getAllPersonnages(): array
    {
        $personnagesData = $this->personnageDAO->getAll();
        $personnages = [];
        foreach ($personnagesData as $data) {
            $personnage = new Personnage($data);

            // Récupère les objets liés
            $elementData = $this->elementDAO->getByID($data['element']);
            $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
            $originData = $this->originDAO->getByID($data['origin']);

            // Associe les objets au personnage
            $personnage->setElementObj($elementData ? new Element($elementData) : null);
            $personnage->setUnitClassObj($unitClassData ? new UnitClass($unitClassData) : null);
            $personnage->setOriginObj($originData ? new Origin($originData) : null);

            $personnages[] = $personnage;
        }
        return $personnages;
    }


    // Récupère un personnage par son ID
    public function getPersonnageById(string $id): ?Personnage
    {
        $data = $this->personnageDAO->getByID($id);
        if (!$data) {
            return null;
        }

        $personnage = new Personnage($data);

        // Récupère les objets liés
        if (isset($data['element'])) {
            $elementData = $this->elementDAO->getByID($data['element']);
            $personnage->setElementObj($elementData ? new Element($elementData) : null);
        }

        if (isset($data['unitclass'])) {
            $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
            $personnage->setUnitClassObj($unitClassData ? new UnitClass($unitClassData) : null);
        }

        if (isset($data['origin'])) {
            $originData = $this->originDAO->getByID($data['origin']);
            $personnage->setOriginObj($originData ? new Origin($originData) : null);
        }

        return $personnage;
    }

    // Ajoute un personnage
    public function addPersonnage(Personnage $personnage): void
    {
        $this->personnageDAO->add($personnage);
    }

    // Met à jour un personnage
    public function updatePersonnage(Personnage $personnage): void
    {
        $this->personnageDAO->update($personnage);
    }

    // Supprime un personnage
    public function deletePersonnage(string $id): void
    {
        $this->personnageDAO->delete($id);
    }

    // Bascule l'état de collection
    public function toggleCollection(string $userId, string $persoId): void {
        $this->personnageDAO->toggleCollection($userId, $persoId);
    }

    // Récupère la collection d'un utilisateur sous forme d'Objets Personnage
    public function getCollection(string $userId): array {
        $dataList = $this->personnageDAO->getAllByUserId($userId);
        $personnages = [];

        // On réutilise la même logique que getAllPersonnages()
        foreach ($dataList as $data) {
            $personnage = new Personnage($data);

            // Hydrater les objets liés (Element, Class...)
            $elementData = $this->elementDAO->getByID($data['element']);
            $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
            $originData = $data['origin'] ? $this->originDAO->getByID($data['origin']) : null;

            $personnage->setElementObj($elementData ? new Element($elementData) : null);
            $personnage->setUnitClassObj($unitClassData ? new UnitClass($unitClassData) : null);
            $personnage->setOriginObj($originData ? new Origin($originData) : null);

            $personnages[] = $personnage;
        }
        return $personnages;
    }

    // Pour savoir si un perso spécifique est possédé (utile pour l'affichage du bouton +/-)
    public function isOwned(string $userId, string $persoId): bool {
        return $this->personnageDAO->isInCollection($userId, $persoId);
    }



}
