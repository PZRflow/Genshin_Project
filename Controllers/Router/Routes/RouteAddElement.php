<?php
namespace Controllers\Router\Routes;

use Controllers\PersonnageController;
use Exception;

class RouteAddElement extends Route
{
    /**
     * Constructeur de la route d'ajout d'élément.
     *
     * @param PersonnageController $controller Contrôleur de gestion des personnages.
     */
    public function __construct(PersonnageController $controller)
    {
        parent::__construct($controller);
    }

    /**
     * Affiche le formulaire d'ajout d'élément (GET).
     *
     * @param array $params Paramètres de la requête.
     * @return void
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddElementForm();
    }

    /**
     * Traite la soumission du formulaire d'ajout d'élément (POST).
     *
     * @param array $params Données soumises via le formulaire.
     * @return void
     */
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