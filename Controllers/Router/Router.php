<?php
namespace Controllers\Router;

use Controllers\Router\Routes\RouteMyCollection;
use Controllers\Router\Routes\RouteToggleCollection;
use Controllers\Router\Routes\RouteAddElement;
use Controllers\Router\Routes\RouteAddPerso;
use Controllers\AuthController;
use Controllers\MainController;
use Controllers\PersonnageController;
use Controllers\Router\Routes\RouteDelPerso;
use Controllers\Router\Routes\RouteEditPerso;
use Controllers\Router\Routes\RouteIndex;
use Controllers\Router\Routes\RouteLogin;
use Controllers\Router\Routes\RouteLogout;
use Controllers\Router\Routes\RouteLogs;
use Exceptions\RouteNotFoundException;
use League\Plates\Engine;
use Services\AuthService;
use Services\PersonnageService;
use Helpers\Message;
class Router
{
    private Engine $templates;
    private array $routes = [];
    private array $controllers = [];

    public function __construct(Engine $templates)
    {
        $this->templates = $templates;
        $this->createControllerList();
        $this->createRouteList();
    }

    // Crée la liste des contrôleurs
    private function createControllerList(): void
    {
        $personnageDAO = new \Models\PersonnageDAO();
        $elementDAO = new \Models\ElementDAO();
        $unitClassDAO = new \Models\UnitClassDAO();
        $originDAO = new \Models\OriginDAO();
        $personnageService = new \Services\PersonnageService(
            $personnageDAO,
            $elementDAO,
            $unitClassDAO,
            $originDAO
        );

        $authService = new \Services\AuthService(new \Models\UserDAO());

        $this->controllers = [
            'main' => new \Controllers\MainController($this->templates, $personnageService),
            'perso' => new \Controllers\PersonnageController($this->templates, $personnageService),
            'auth' => new AuthController($this->templates, $authService),
            'log' => new \Controllers\LogController($this->templates)
        ];
    }


    // Crée la liste des routes
    private function createRouteList(): void
    {
        $this->routes = [
            'index' => new RouteIndex($this->controllers['main']),
            'add-perso' => new RouteAddPerso($this->controllers['perso']),
            'del-perso' => new RouteDelPerso($this->controllers['perso']),
            'edit-perso' => new RouteEditPerso($this->controllers['perso']),
            'add-element' => new RouteAddElement($this->controllers['perso']),
            'login' => new RouteLogin($this->controllers['auth']),
            'logout' => new RouteLogout($this->controllers['auth']),
            'logs' => new RouteLogs($this->controllers['log']),
            'my-collection' => new RouteMyCollection($this->controllers['perso']),
            'toggle-collection' => new RouteToggleCollection($this->controllers['perso'])
        ];
    }

    // Gère le routage en fonction de $_GET et $_POST
    public function routing(array $get, array $post): void
    {
        try {
            $action = $get['action'] ?? 'index';
            $method = $_SERVER['REQUEST_METHOD'];

            if (!isset($this->routes[$action])) {
                throw new RouteNotFoundException("Route '$action' non trouvée.");
            }

            $route = $this->routes[$action];
            $route->action($method === 'POST' ? $post : $get);

        } catch (RouteNotFoundException $e) {
            // Redirige vers l'index avec un message d'erreur
            $this->controllers['main']->index(new Message("Erreur : " . $e->getMessage(), "error"));

        } catch (\Exception $e) {
            // Affiche une page d'erreur générique
            echo $this->templates->render('error', [
                'message' => $e->getMessage()
            ]);
        }
    }
}
