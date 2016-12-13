<?php

namespace Heidi\Core;

/**
 * The Router class
 *
 * @since  0.1
 */
class Router
{
    /**
	 * Property blade.
	 *
	 * @var Array
	 */
    protected $routes = [];

    /**
	 * Load file with route list and provide instance
	 *
	 * @param string $file
	 *
	 * @return object Router
	 */
    public static function load(String $file)
    {
        $router = new static;

        require HEIDI_PLUGIN_PATH . $file;

        return $router;
    }

    /**
	 * Delegate each route to be registered as an action
	 *
	 * @param array $routes
	 *
	 * @return null
	 */
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

    /**
	 * Hook in to Wordpress action hooks for every route
	 *
	 * @param string $action
	 * @param string $route
	 *
	 * @return null
	 */
    protected function registerRoute(String $action, String $route)
    {
        $route = $this->namespaceRoute($route);
        $controllerAction = explode('@', $route);
        add_action($action, $controllerAction);
    }

    /**
	 * Prefix the route with appropriate controller namespace
	 *
	 * @param string $route
	 *
	 * @return string
	 */
    protected function namespaceRoute(String $route)
    {
        return 'Heidi\Plugin\Controllers\\' . $route;
    }
}
