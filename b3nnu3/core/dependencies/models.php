<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class models
{

    const MODELDIR = "/b3nnu3/model/";
    static public $class;

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


    /**
     * create a pimple_call for every model in filetree
     * 
     * @param $i
     */
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
                
                if ($containername != "model_defaults_model" ) {
                    self::$container[$containername] = function($container) use ($class){
                        return new $class($container);                        
                    };                    
                }
            }
        }
    }
}