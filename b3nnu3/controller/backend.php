<?php

namespace b3nnu3\controller;

use \b3nnu3\controller\defaults\database_backend;

class backend extends database_backend
{
    public $page;

    public function indexAction()
    {
        $this->pagemodel = $this->_container['model_page'];
        $this->page = $this->pagemodel->getEntryByUrlKey('backend');
        
        foreach($this->page as $key => $var){
            $this->smarty->assign($key,$var);
        }
        $this->_buildTemplate();
        $this->_renderTemplate($this->page['template'] . '/pages/default.tpl');
    }
    
    private function _buildTemplate(){
        $this->blockmodel = $this->_container['model_block'];
        $this->blocks = $this->blockmodel->getBlocksByPageId($this->page['id']);
        $this->smarty->assign('blocks',$this->blocks);
    }
}