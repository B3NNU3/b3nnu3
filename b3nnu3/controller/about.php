<?php

namespace b3nnu3\controller;

use \b3nnu3\controller\defaults\default_frontend;

class about extends default_frontend
{

    public function indexAction()
    {
        $this->_loadVarsFromJson('about/index.json');
        $this->_renderTemplate('about/index.tpl');
    }
}