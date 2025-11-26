<?php
namespace Controllers\Router\Routes;

use Controllers\AuthController;
use Exception;

class RouteLogin extends Route
{
    public function __construct(AuthController $controller)
    {
        parent::__construct($controller);
    }

    // Affiche le formulaire de connexion
    protected function get(array $params): void
    {
        $this->controller->displayLogin($params['message'] ?? null);
    }

    // Traite la connexion
    protected function post(array $params): void
    {
        try {
            $data = [
                'username' => $this->getParam($params, 'username'),
                'password' => $this->getParam($params, 'password')
            ];
            $this->controller->login($data);
        } catch (Exception $e) {
            $this->controller->displayLogin($e->getMessage());
        }
    }
}
