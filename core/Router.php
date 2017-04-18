<?php

/**
 * Class Router
 */
class Router
{

    /**
     * @var mixed
     */
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments);
                $controllerName = ucfirst($controllerName);


                $actionName = ucfirst(array_shift($segments));

                $parameters = $segments;


                $controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);

                    $controllerObject = new $controllerName;
                    $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                    if (!$result) {
                        break;
                    }
                } else {
                    throw new Exception('No Such controller: '.$controllerFile);
                }
            }
        }
    }
}