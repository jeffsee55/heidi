<?php

namespace Heidi\Core;

class Router
{
    protected $routes = [];

    public static function load(String $file)
    {
        $router = new static;

        require HEIDI_PLUGIN_PATH . $file;

        return $router;
    }

    public function register(Array $routes)
    {
        foreach($routes as $action => $route)
        {
            if(is_array($route)) {
                foreach($route as $subRoot) {
                    $this->registerRoute($action, $subRoot);
                }
            } else {
                $this->registerRoute($action, $route);
            }
        }
    }

    protected function registerRoute(String $action, String $route)
    {
        $route = $this->namespaceRoute($route);
        $controllerAction = explode('@', $route);
        add_action($action, $controllerAction);
    }

    protected function namespaceRoute(String $route)
    {
        return 'Heidi\Plugin\Controllers\\' . $route;
    }
}
