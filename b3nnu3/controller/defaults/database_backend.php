<?php

namespace b3nnu3\controller\defaults;

abstract class database_backend extends database_frontend
{
    public function __construct($container)
    {
        parent::__construct($container);        
    }
}