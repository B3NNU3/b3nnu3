<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;

class wideimage implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        $wideimage = new \WideImage\WideImage();
        $container->set('wideimage', $wideimage, Container::SCOPE_CONTAINER);
    }

}
