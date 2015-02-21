<?php

namespace b3nnu3\block;

use b3nnu3\core\dependencies\smarty;
use \Symfony\Component\DependencyInjection\Container;

abstract class frontend
{

    /**
     * @var Container
     */
    protected $container;
    /**
     * @var \Smarty
     */
    protected $smarty;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->smarty = $this->container->get('smarty');
        $this->init();
    }

    public function init()
    {
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if ($name != "container" && $name != "smarty" && is_string($name)) {
            $this->$name = $value;
        }
    }
}