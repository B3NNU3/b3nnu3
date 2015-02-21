<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;

class parsedown implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        $parsedown = new \Parsedown();
        $container->set('parsedown', $parsedown, Container::SCOPE_CONTAINER);
    }

}
