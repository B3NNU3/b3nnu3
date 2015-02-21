<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;
use \voku\db\DB;

class simple_mysqli
{

    static public function inject(Container &$container)
    {
        $container['database'] = function ($c) {
            $app = $c['app'];
            $options = $app->config->getDatabase();
            /**
             * @var $database DB
             */
            return DB::getInstance(
                $server = $options['server'],
                $user = $options['user'],
                $pass = $options['pass'],
                $database = $options['database']
            );
        };        
    }
}