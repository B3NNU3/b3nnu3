<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class wideimage implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        $container['wideimage'] = function ($c) {
            return new \WideImage\WideImage();
        };        
    }

}
