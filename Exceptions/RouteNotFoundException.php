<?php
namespace Exceptions;

use Exception;

class RouteNotFoundException extends Exception
{
    public function __construct(string $message = "Route non trouvée.")
    {
        parent::__construct($message);
    }
}
