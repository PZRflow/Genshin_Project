<?php
namespace Controllers\Router\Routes;


class RouteLogs extends Route
{
    public function get(array $params = []): void
    {
        $this->controller->displayLogs();
    }

    // Méthode POST : ne fait rien (ou redirige vers GET si nécessaire)
    public function post(array $params = []): void
    {
    }
}
