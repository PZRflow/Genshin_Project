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

    public function __construct(Engine $templates, PersonnageService $personnageService)
    {
        $this->templates = $templates;
        $this->personnageService = $personnageService;
    }

    public function index(?Message $message = null): void
    {
        $personnages = $this->personnageService->getAllPersonnages();
        echo $this->templates->render('home', [
            'personnages' => $personnages,
            'message' => $message
        ]);
    }

    public function logs(): void
    {
        echo $this->templates->render('logs');
    }
}