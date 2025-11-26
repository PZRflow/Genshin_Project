<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;

class RouteAddElement extends Route
{
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    public function get(array $params = []): void
    {
        $this->controller->displayAddElementForm();
    }

    public function post(array $params = []): void
    {
        try {
            $data = [
                'type' => $this->getParam($params, 'type'),
                'name' => $this->getParam($params, 'name'),
                'url_img' => $this->getParam($params, 'url_img'),
            ];
            $this->controller->addElement($data);
        } catch (Exception $e) {
            $message = new \Helpers\Message($e->getMessage(), "error");
            $this->controller->displayAddElementForm($message);
        }
    }
}
