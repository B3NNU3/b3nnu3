<?php

namespace b3nnu3\core\interfaces;

use \Pimple\Container;

interface dependency
{

    static function inject(Container &$container);
}
