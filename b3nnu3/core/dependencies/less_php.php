<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;

class less_php implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {

        $app = $container->get('app');
        $options = $app->config->getLess();

//        $options = array(
//            'compress'          =>true,
//            'cache_dir'         => __ROOTDIR__ .'/src/css/partials/',
//            'sourceMap'         => true,
//            'sourceMapWriteTo'  => __ROOTDIR__ . '/src/css/source.map',
//            'sourceMapURL'      => '/src/css/source.map',
//        );
        $less = new \Less_Parser($options);
        $container->set('less', $less, Container::SCOPE_CONTAINER);
        $less_cache = new \Less_Cache();
        $container->set('less_cache', $less_cache, Container::SCOPE_CONTAINER);
    }
}
