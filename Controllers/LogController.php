<?php
namespace Controllers;

use Services\LogService;
use Services\AuthService; // N'oublie pas d'importer ça
use League\Plates\Engine;

class LogController {
    private Engine $templates;

    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }

    public function displayLogs(): void {
        // 1. SÉCURITÉ : On vérifie si l'admin est connecté
        if (!AuthService::isAuthenticated()) {
            header('Location: index.php?action=login');
            exit;
        }

        $logFiles = LogService::getAvailableLogFiles();
        $file = $_GET['file'] ?? null;
        $logContent = null;

        // 2. On récupère le contenu si un fichier est demandé
        // J'ajoute in_array pour éviter qu'on essaie d'ouvrir un fichier hors de la liste
        if ($file && in_array($file, $logFiles)) {
            $logContent = LogService::getLogContent($file);
        }

        // 3. On envoie les données à la vue
        echo $this->templates->render('logs', [
            'logFiles' => $logFiles,
            'logContent' => $logContent,
            'currentFile' => $file // Important pour le style CSS du bouton actif
        ]);
    }
}