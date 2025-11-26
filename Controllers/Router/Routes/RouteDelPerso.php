<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;

class RouteDelPerso extends Route
{
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
            $this->controller->index($e->getMessage());
        }
    }

    protected function post(array $params): void
    {
        $this->get($params);
    }
}
