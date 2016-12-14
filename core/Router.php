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

    public function group($namespace, Array $controllers)
    {
        foreach($controllers as $controller => $routes)
        {
            $this->register($namespace, $controller, $routes);
        }
    }

    /**
	 * Delegate each route to be registered as an action
	 *
	 * @param array $routes
	 *
	 * @return null
	 */
    public function register($namespace, $controller, Array $routes)
    {
        foreach($routes as $action => $route)
        {
            $this->registerRoute($namespace, $controller, $action, $route);
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
    protected function registerRoute($namespace, String $controller, String $action, String $route)
    {
        $controller = $this->namespaceController($namespace, $controller);
        add_action($action, [new $controller, $route]);
    }

    /**
	 * Prefix the route with appropriate controller namespace
	 *
	 * @param string $route
	 *
	 * @return string
	 */
    protected function namespaceController($namespace, String $controller)
    {
        return 'Heidi\Plugin\Controllers\\' . $namespace . '\\' . $controller;
    }
}
