<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class parsedown implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        $container['parsedown'] = function ($c) {
            return new \Parsedown();
        };
    }
}
