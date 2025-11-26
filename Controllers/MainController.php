<?php
namespace Controllers;

use League\Plates\Engine;
use Models\PersonnageDAO;
use Services\PersonnageService;
use Helpers\Message;

class MainController
{
    private Engine $templates;
    private PersonnageService $personnageService;

    /**
     * Constructeur du contrôleur principal.
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
     * Affiche la page d'accueil avec la liste des personnages.
     *
     * @param Message|null $message Message optionnel à afficher (succès/erreur).
     * @return void
     */
    public function index(?Message $message = null): void
    {
        $personnages = $this->personnageService->getAllPersonnages();
        echo $this->templates->render('home', [
            'personnages' => $personnages,
            'message' => $message
        ]);
    }


}