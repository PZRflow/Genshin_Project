<?php
namespace Controllers\Router\Routes;

use Controllers\AuthController;
use Exception;

class RouteLogin extends Route
{
    /**
     * Constructeur de la route de connexion.
     *
     * @param AuthController $controller Contrôleur d'authentification.
     */
    public function __construct(AuthController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        $this->controller->displayLogin($params['message'] ?? null);
    }

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