<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class less_php implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        $container['less'] = function($c){
            $app = $c['app'];
            $options = $app->config->getLess();        
            return new \Less_Parser($options);
        };

        $container['less_cache'] = function($c){
            return new \Less_Cache();            
        };
    }
}
