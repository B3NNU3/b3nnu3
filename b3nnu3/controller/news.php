<?php

namespace b3nnu3\controller;

use \Pimple\Container;

/**
 * Class media
 * @package b3nnu3\controller
 * TODO get all /media images via ajax
 * TODO send browser size with ajax
 * TODO get image in size depend on browsersize from cache
 *
 */
class news extends defaults\database_frontend
{
    /**
     * @var \b3nnu3\model\news
     */
    protected $newsmodel;
    /**
     * @var \b3nnu3\model\news\categories
     */
    protected $categorysmodel;

    protected function init()
    {
        $this->newsmodel = $this->_container['model_news'];
        $this->categorysmodel = $this->_container['model_news_categories'];

    }

    public function indexAction()
    {
        $news = $this->newsmodel->getAllEntries();
        if (!$news) {
            $this->_EntryNotFound();
        }
        foreach ($news as &$item) {
            $item['content'] = $this->parsedown->text($item['content']);
        }
        $this->smarty->assign('news', $news);
        $this->_loadVarsFromJson('news/index.json');
        $this->_renderTemplate('news/index.tpl');
    }

    public function __call($method, $args)
    {
        $detail_key = str_replace('Action', '', $method);
        $news = $this->newsmodel->getEntryByUrlKey($detail_key);
        if (!$news) {
            $this->_EntryNotFound();
        }
        $news['content'] = $this->parsedown->text($news['content']);
        $this->smarty->assign('news', $news);
        $this->_loadVarsFromJson('news/index.json');
        $this->_renderTemplate('news/details.tpl');
    }

    public function categoryAction()
    {
        $url_key = $this->_request->attributes->all();
        if (!count($url_key)) {
            $this->_EntryNotFound();
        }
        $url_key = reset($url_key);
        $category = $this->categorysmodel->getNewsByCategoryKey($url_key);#
        if (!$category) {
            $this->_EntryNotFound();
        }
        foreach ($category['news'] as &$item) {
            $item['content'] = $this->parsedown->text($item['content']);
        }
        $this->_loadVarsFromJson('news/index.json');
        $this->smarty->assign('news', $category['news']);
        $this->smarty->assign('title', $category['title']);
        $this->_renderTemplate('news/index.tpl');
    }

    protected function _EntryNotFound()
    {
        throw new \b3nnu3\core\notfound('Den Eintrag den Du suchst gibts es nicht mehr.');
    }


}