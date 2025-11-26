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

    /**
     * Constructeur du service de gestion des personnages.
     *
     * @param PersonnageDAO $personnageDAO
     * @param ElementDAO $elementDAO
     * @param UnitClassDAO $unitClassDAO
     * @param OriginDAO $originDAO
     */
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

    /**
     * Récupère tous les personnages et hydrate leurs objets liés (Element, Classe, Origine).
     *
     * @return array Liste d'objets Personnage complets.
     */
    public function getAllPersonnages(): array
    {
        $personnagesData = $this->personnageDAO->getAll();
        $personnages = [];
        foreach ($personnagesData as $data) {
            $personnage = new Personnage($data);

            $elementData = $this->elementDAO->getByID($data['element']);
            $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
            $originData = $this->originDAO->getByID($data['origin']);

            $personnage->setElementObj($elementData ? new Element($elementData) : null);
            $personnage->setUnitClassObj($unitClassData ? new UnitClass($unitClassData) : null);
            $personnage->setOriginObj($originData ? new Origin($originData) : null);

            $personnages[] = $personnage;
        }
        return $personnages;
    }

    /**
     * Récupère un personnage complet par son identifiant.
     *
     * @param string $id L'identifiant du personnage.
     * @return Personnage|null Le personnage hydraté ou null.
     */
    public function getPersonnageById(string $id): ?Personnage
    {
        $data = $this->personnageDAO->getByID($id);
        if (!$data) {
            return null;
        }

        $personnage = new Personnage($data);

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

    /**
     * Ajoute un nouveau personnage via le DAO.
     *
     * @param Personnage $personnage
     * @return void
     */
    public function addPersonnage(Personnage $personnage): void
    {
        $this->personnageDAO->add($personnage);
    }

    /**
     * Met à jour un personnage existant.
     *
     * @param Personnage $personnage
     * @return void
     */
    public function updatePersonnage(Personnage $personnage): void
    {
        $this->personnageDAO->update($personnage);
    }

    /**
     * Supprime un personnage par son ID.
     *
     * @param string $id
     * @return void
     */
    public function deletePersonnage(string $id): void
    {
        $this->personnageDAO->delete($id);
    }

    /**
     * Ajoute ou retire un personnage de la collection d'un utilisateur.
     *
     * @param string $userId ID de l'utilisateur.
     * @param string $persoId ID du personnage.
     * @return void
     */
    public function toggleCollection(string $userId, string $persoId): void {
        $this->personnageDAO->toggleCollection($userId, $persoId);
    }

    /**
     * Récupère la collection de personnages d'un utilisateur spécifique.
     *
     * @param string $userId ID de l'utilisateur.
     * @return array Liste d'objets Personnage de la collection.
     */
    public function getCollection(string $userId): array {
        $dataList = $this->personnageDAO->getAllByUserId($userId);
        $personnages = [];

        foreach ($dataList as $data) {
            $personnage = new Personnage($data);

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

    /**
     * Vérifie si un utilisateur possède un personnage spécifique.
     *
     * @param string $userId ID de l'utilisateur.
     * @param string $persoId ID du personnage.
     * @return bool Vrai si possédé, faux sinon.
     */
    public function isOwned(string $userId, string $persoId): bool {
        return $this->personnageDAO->isInCollection($userId, $persoId);
    }
}