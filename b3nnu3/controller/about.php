<?php

namespace b3nnu3\controller;

use \b3nnu3\controller\defaults\default_frontend;

class about extends default_frontend
{

    public function indexAction()
    {

        /**
         * @var $json \b3nnu3\core\dependencies\jsoncontent
         */
        $json = $this->_container->get('json_content');
        $contentvars = $json->getArrayFromContentJson('about/index.json');
        foreach ($contentvars as $key => $value) {
            if ($key == 'content') {
                $parsedown = $this->_container->get('parsedown');
                $mdfilepath = __ROOTDIR__ . "/content/about/" . $value;
                if (file_exists($mdfilepath)) {
                    $value = $parsedown->text(file_get_contents($mdfilepath));
                }
            }
            $this->smarty->assign($key, $value);
        }

        $content = $this->smarty->fetch('about/index.tpl');
        $this->_response->setContent($content);
        $this->_response->send();
    }
}