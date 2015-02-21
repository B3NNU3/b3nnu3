<?php

namespace b3nnu3\controller;

use \b3nnu3\controller\defaults\default_frontend;

/**
 * Class index
 * @package b3nnu3\controller
 * TODO get content from database
 * TODO upload .md files to DB
 * TODO define placeholders in template
 * TODO load Content for each placholder
 */
class index extends default_frontend
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $this->_loadVarsFromJson('index/index.json');
        $this->_renderTemplate('index/index.tpl');
    }
}