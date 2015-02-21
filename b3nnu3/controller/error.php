<?php

namespace b3nnu3\controller;

use \b3nnu3\core\notfound;

class error extends defaults\default_frontend
{

    /**
     * @var \Exception
     */
    private $_exception;

    public function indexAction()
    {
        $this->_response->setStatusCode('404');
        $this->_initMetaIndex('NOINDEX, NOFOLLOW');

        $this->_loadVarsFromJson('error/index.json');

        if (is_object($this->_exception)) {
            $this->smarty->assign('error_message', $this->_exception->getMessage());
        } else {
            $this->smarty->assign('error_message', 'Ein unbekannter Fehler ist aufgetreten!');
        }
        $this->_renderTemplate('error/index.tpl');
    }

    public function setException(notfound $exception)
    {
        $this->_exception = $exception;
    }
}