<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;
use Helpers\Message;

class RouteAddPerso extends Route
{
    /**
     * Constructeur de la route d'ajout de personnage.
     *
     * @param PersonnageController $controller Contrôleur de gestion des personnages.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    protected function get(array $params): void
    {
        $this->controller->displayAddPerso($params['message'] ?? null);
    }

    protected function post(array $params): void
    {
        try {
            $data = [
                'name' => $this->getParam($params, 'name'),
                'element' => $this->getParam($params, 'element'),
                'unitclass' => $this->getParam($params, 'unitclass'),
                'rarity' => $this->getParam($params, 'rarity'),
                'origin' => $params['origin'] ?? null,
                'url_img' => $this->getParam($params, 'url_img')
            ];
            $this->controller->addPerso($data);
        } catch (Exception $e) {
            $message = new Message($e->getMessage(), "error");
            $this->controller->displayAddPerso($message);
        }
    }
}