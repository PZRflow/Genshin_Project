<?php
namespace Controllers\Router\Routes;

use Controllers\LogController;

class RouteLogs extends Route
{
    /**
     * Constructeur de la route des journaux système.
     *
     * @param LogController $controller Contrôleur de gestion des logs.
     */
    public function __construct(LogController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params = []): void
    {
        $this->controller->displayLogs();
    }

    protected function post(array $params = []): void
    {
    }
}