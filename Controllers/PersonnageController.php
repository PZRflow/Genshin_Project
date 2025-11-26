<?php
namespace Controllers;

use League\Plates\Engine;
use Models\Personnage;
use Services\PersonnageService;
use Helpers\Message;

class PersonnageController
{
    private Engine $templates;
    private PersonnageService $personnageService;

    /**
     * Constructeur du contrôleur de personnages.
     *
     * @param Engine $templates Moteur de template Plates.
     * @param PersonnageService $personnageService Service de gestion des personnages.
     */
    public function __construct(Engine $templates, PersonnageService $personnageService)
    {
        $this->templates = $templates;
        $this->personnageService = $personnageService;
    }

    /**
     * Affiche le formulaire d'ajout d'un personnage avec les listes déroulantes nécessaires.
     *
     * @param Message|null $message Message optionnel à afficher.
     * @return void
     */
    public function displayAddPerso(?Message $message = null): void
    {
        $elementDAO = new \Models\ElementDAO();
        $unitClassDAO = new \Models\UnitClassDAO();
        $originDAO = new \Models\OriginDAO();

        $elements = $elementDAO->getAll();
        $unitClasses = $unitClassDAO->getAll();
        $origins = $originDAO->getAll();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'elements' => $elements,
            'unitClasses' => $unitClasses,
            'origins' => $origins
        ]);
    }

    /**
     * Traite l'ajout d'un personnage en base de données.
     *
     * @param array $data Les données du formulaire.
     * @return void
     */
    public function addPerso(array $data): void
    {
        try {
            $personnage = new Personnage([
                'id' => uniqid(),
                'name' => $data['name'],
                'element' => $data['element'],
                'unitclass' => $data['unitclass'],
                'rarity' => $data['rarity'],
                'origin' => $data['origin'] ?? null,
                'url_img' => $data['url_img']
            ]);
            $this->personnageService->addPersonnage($personnage);
            $message = new Message("Personnage ajouté avec succès !", "success");
            $this->index($message);
        } catch (\Exception $e) {
            $message = new Message("Erreur : " . $e->getMessage(), "error");
            $this->displayAddPerso($message);
        }
    }

    /**
     * Affiche le formulaire de modification d'un personnage existant.
     *
     * @param string $id L'identifiant du personnage à modifier.
     * @param Message|null $message Message optionnel à afficher.
     * @return void
     */
    public function displayEditPerso(string $id, ?Message $message = null): void
    {
        $personnage = $this->personnageService->getPersonnageById($id);
        if (!$personnage) {
            $message = new Message("Personnage non trouvé.", "error");
            $this->index($message);
            return;
        }

        $elementDAO = new \Models\ElementDAO();
        $unitClassDAO = new \Models\UnitClassDAO();
        $originDAO = new \Models\OriginDAO();

        $elements = $elementDAO->getAll();
        $unitClasses = $unitClassDAO->getAll();
        $origins = $originDAO->getAll();

        echo $this->templates->render('edit-perso', [
            'personnage' => $personnage,
            'message' => $message,
            'elements' => $elements,
            'unitClasses' => $unitClasses,
            'origins' => $origins
        ]);
    }

    /**
     * Traite la mise à jour d'un personnage en base de données.
     *
     * @param array $data Les nouvelles données du personnage.
     * @return void
     */
    public function editPerso(array $data): void
    {
        try {
            $personnage = new Personnage([
                'id' => $data['id'],
                'name' => $data['name'],
                'element' => $data['element'],
                'unitclass' => $data['unitclass'],
                'rarity' => $data['rarity'],
                'origin' => $data['origin'] ?? null,
                'url_img' => $data['url_img']
            ]);
            $this->personnageService->updatePersonnage($personnage);
            $message = new Message("Personnage mis à jour avec succès !", "success");
            $this->index($message);
        } catch (\Exception $e) {
            $message = new Message("Erreur : " . $e->getMessage(), "error");
            $this->displayEditPerso($data['id'], $message);
        }
    }

    /**
     * Supprime un personnage par son identifiant.
     *
     * @param string $id L'identifiant du personnage.
     * @return void
     */
    public function deletePerso(string $id): void
    {
        try {
            $this->personnageService->deletePersonnage($id);
            $message = new Message("Personnage supprimé avec succès !", "success");
            $this->index($message);
        } catch (\Exception $e) {
            $message = new Message("Erreur : " . $e->getMessage(), "error");
            $this->index($message);
        }
    }

    /**
     * Redirige vers la méthode index du MainController pour afficher l'accueil.
     *
     * @param Message|null $message Message optionnel à afficher.
     * @return void
     */
    public function index(?Message $message = null): void
    {
        (new MainController($this->templates, $this->personnageService))->index($message);
    }

    /**
     * Ajoute un nouvel élément (Type, Origine ou Classe) en base de données.
     *
     * @param array $data Les données de l'élément (type, nom, image).
     * @return void
     */
    public function addElement(array $data): void
    {
        try {
            if (empty($data['type']) || empty($data['name']) || empty($data['url_img'])) {
                throw new \Exception("Tous les champs sont obligatoires.");
            }

            $dao = match ($data['type']) {
                'element' => new \Models\ElementDAO(),
                'origin' => new \Models\OriginDAO(),
                'unitclass' => new \Models\UnitClassDAO(),
                default => throw new \Exception("Type d'élément invalide."),
            };

            $elementData = [
                'id' => uniqid(),
                'name' => $data['name'],
                'url_img' => $data['url_img'],
            ];

            $element = match ($data['type']) {
                'element' => new \Models\Element($elementData),
                'origin' => new \Models\Origin($elementData),
                'unitclass' => new \Models\UnitClass($elementData),
            };

            $dao->add($element);

            $message = new Message("Élément ajouté avec succès !", "success");
            $this->index($message);

        } catch (\Exception $e) {
            $message = new Message("Erreur : " . $e->getMessage(), "error");
            $this->displayAddElementForm($message);
        }
    }

    /**
     * Affiche le formulaire d'ajout d'un élément.
     *
     * @param Message|null $message Message optionnel à afficher.
     * @return void
     */
    public function displayAddElementForm(?Message $message = null): void
    {
        echo $this->templates->render('add-element', [
            'message' => $message
        ]);
    }

    /**
     * Ajoute ou retire un personnage de la collection de l'utilisateur connecté.
     * Redirige vers la page précédente.
     *
     * @return void
     */
    public function toggleCollection() {
        if (!\Services\AuthService::isAuthenticated()) {
            header('Location: index.php?action=login');
            exit;
        }

        if (isset($_GET['id'])) {
            $userId = \Services\AuthService::getCurrentUserId();
            $persoId = $_GET['id'];

            $this->personnageService->toggleCollection($userId, $persoId);
        }

        header('Location: index.php');
        exit;
    }

    /**
     * Affiche la page "Ma Collection" contenant uniquement les personnages de l'utilisateur.
     *
     * @return void
     */
    public function displayCollection() {
        if (!\Services\AuthService::isAuthenticated()) {
            header('Location: index.php?action=login');
            exit;
        }

        $userId = \Services\AuthService::getCurrentUserId();
        $myPersos = $this->personnageService->getCollection($userId);

        echo $this->templates->render('home', [
            'personnages' => $myPersos,
            'title' => 'Ma Collection',
            'isCollectionPage' => true
        ]);
    }
}