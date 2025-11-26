<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;
class RouteEditPerso extends Route
{
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        try {
            $id = $this->getParam($params, 'id');
            $this->controller->displayEditPerso($id, $params['message'] ?? null);
        } catch (Exception $e) {
            $this->controller->index($e->getMessage());
        }
    }

    protected function post(array $params): void
    {
        try {
            $data = [
                'id' => $this->getParam($params, 'id'),
                'name' => $this->getParam($params, 'name'),
                'element' => $this->getParam($params, 'element'),
                'unitclass' => $this->getParam($params, 'unitclass'),
                'rarity' => $this->getParam($params, 'rarity'),
                'origin' => $params['origin'] ?? null,
                'url_img' => $this->getParam($params, 'url_img')
            ];
            $this->controller->editPerso($data);
        } catch (Exception $e) {
            $this->controller->displayEditPerso($params['id'], $e->getMessage());
        }
    }
}
