<?php
namespace Controllers;

use Services\LogService;
use Services\AuthService;
use League\Plates\Engine;

class LogController {
    private Engine $templates;

    /**
     * Constructeur du contrôleur de logs.
     *
     * @param Engine $templates Moteur de template Plates.
     */
    public function __construct(Engine $templates) {
        $this->templates = $templates;
    }

    /**
     * Affiche la page de visualisation des logs.
     * Nécessite une authentification admin.
     *
     * @return void
     */
    public function displayLogs(): void {
        if (!AuthService::isAuthenticated()) {
            header('Location: index.php?action=login');
            exit;
        }

        $logFiles = LogService::getAvailableLogFiles();
        $file = $_GET['file'] ?? null;
        $logContent = null;

        if ($file && in_array($file, $logFiles)) {
            $logContent = LogService::getLogContent($file);
        }

        echo $this->templates->render('logs', [
            'logFiles' => $logFiles,
            'logContent' => $logContent,
            'currentFile' => $file
        ]);
    }
}