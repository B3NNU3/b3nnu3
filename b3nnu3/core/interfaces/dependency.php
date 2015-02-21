<?php

namespace b3nnu3\core\interfaces;

use \Symfony\Component\DependencyInjection\Container;

interface dependency
{

    static function inject(Container &$container);
}
