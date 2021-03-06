<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;

class models
{

    const MODELDIR = "/b3nnu3/model/";

    static private $instances = array();
    /**
     * @var Container
     */
    static private $container;

    static public function inject(Container &$container)
    {
        self::$container = $container;
        $modelroot = __ROOTDIR__ . self::MODELDIR;
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($modelroot));
        self::iterateDirectory($iterator);
    }


    static public function iterateDirectory($i)
    {
        foreach ($i as $path) {
            if ($path->isDir()) {
                self::iterateDirectory($path);
            } else {
                $search = array(__ROOTDIR__, "/", ".php");
                $replace = array("", '\\', "");
                $class = str_replace($search, $replace, $path);
                $search = array(self::MODELDIR, __ROOTDIR__, "/", ".php");
                $replace = array("", "", '_', "");
                $containername = "model_" . str_replace($search, $replace, $path);
                if ($containername != "model_defaults_model") {
                    $class = self::getInstance($class);
                    self::$container->set($containername, $class);
                }
            }
        }
    }

    static public function getInstance($className)
    {
        if (!isset(self::$instances[$className])) {
            self::$instances[$className] = new $className(self::$container);
        }
        return self::$instances[$className];
    }
}