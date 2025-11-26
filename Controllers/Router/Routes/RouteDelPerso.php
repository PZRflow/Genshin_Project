<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;
use Helpers\Message;

class RouteDelPerso extends Route
{
    /**
     * Constructeur de la route de suppression de personnage.
     *
     * @param PersonnageController $controller Contrôleur de gestion des personnages.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        try {
            $id = $this->getParam($params, 'id');
            $this->controller->deletePerso($id);
        } catch (Exception $e) {
            $message = new Message($e->getMessage(), "error");
            $this->controller->index($message);
        }
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}