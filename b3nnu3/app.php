<?php
namespace b3nnu3;

use b3nnu3\core\notfound;
use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\DependencyInjection\Container;

/**
 * Class app
 * @package b3nnu3
 */
class app
{

    /*! some path definitions*/
    const CONTROLLER_PATH = "b3nnu3\\controller\\";
    const DEPENDENCY_PATH = "b3nnu3\\core\\dependencies\\";
    const METHOD_SUFFIX = "Action";

    private $request;
    public $config;

    /**
     * @return \Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Request $request
     */
    public function setRequest(\Request $request)
    {
        $this->request = $request;
    }

    /**
     *
     */
    public function start()
    {
        try {
            $this->initConfig();
            $container = $this->_prepareContainer();
            $this->request = Request::createFromGlobals();
            $this->_getResponseByRequest($container);
        } catch (\Exception $e) {
            /**
             * TODO log exception
             */
            echo "ein unerwarteter Fehler ist aufgetreten\n\n";
            echo $e->getMessage();
//            var_dump($e);
        }
    }

    /**
     * @param Container $container
     */
    private function _getResponseByRequest(Container $container)
    {
        $urlbuilder = new core\urlbuilder($this->request);
        try {
            $controllername = self::CONTROLLER_PATH . $urlbuilder->getController();
            if (!class_exists($controllername)) {
                throw new notfound('Seite nicht gefunden!');
            }
            $controller = new $controllername($container);
            $methodname = $urlbuilder->getMethod() . self::METHOD_SUFFIX;
            if (!method_exists($controller, $methodname) && !method_exists($controller, '__call')) {
                throw new notfound('Unterseite nicht gefunden!');
            }
            $controller->$methodname();
        } catch (notfound $e) {
            $errorcontrollername = self::CONTROLLER_PATH . 'error';
            /**
             * @var $errorcontroller \b3nnu3\controller\error
             */
            $errorcontroller = new $errorcontrollername($container);
            $errorcontroller->setException($e);
            $errorcontroller->indexAction();
        }
    }

    /**
     * @return Container
     */
    private function _prepareContainer()
    {
        $container = new Container();
        $container->set('app', $this);
        /** add external composer depencies */
        $dependencies = $this->_solveDependencies();
        foreach ($dependencies as $class) {
            $dependency_class = self::DEPENDENCY_PATH . $class;
            if (class_exists($dependency_class)) {
                /* @var $dependency_class \b3nnu3\core\dependency */
                $dependency_class::inject($container);
            }
        }

        /** add own dependencies */
        \b3nnu3\core\dependencies\jsoncontent::inject($container);
        \b3nnu3\core\dependencies\models::inject($container);
        return $container;
    }

    /**
     *  returns array of classes to map into project
     *
     *  each class has mapping class implements \b3nnu3\core\dependency
     *  to inject itself into symphony-Container
     *
     * @return array
     */
    private function _solveDependencies()
    {
        $composer_json = json_decode(file_get_contents('composer.json'), true);
        $dependencies = array();
        if (is_array($composer_json) && array_key_exists('require', $composer_json)) {
            foreach ($composer_json['require'] as $class => $version) {
                $class = explode('/', $class);
                $class = array_pop($class);
                $class = str_replace(array('.', '-', '+', ','), '_', $class);
                $dependencies[] = strtolower($class);
            }
        }
        return $dependencies;
    }

    private function initConfig()
    {
        $this->config = new core\config();
    }
}