<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;
use \voku\db\DB;

class simple_mysqli
{

    static public function inject(Container &$container)
    {
        $app = $container->get('app');
        $options = $app->config->getDatabase();
        /**
         * @var $database DB
         */
        $database = DB::getInstance(
            $server = $options['server'],
            $user = $options['user'],
            $pass = $options['pass'],
            $database = $options['database']
        );
        $container->set('database', $database, Container::SCOPE_CONTAINER);
    }
}