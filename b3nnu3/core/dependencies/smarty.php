<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class smarty implements \b3nnu3\core\interfaces\dependency
{

    static function inject(Container &$container)
    {
        self::_initSmarty($container);
    }

    private static function _initSmarty(Container &$container)
    {
        $container['smarty'] = function($c){
            $app = $c['app'];
            $options = $app->config->getSmarty();

            $smarty = new \Smarty;
            $smarty->caching = $options['caching'];
            $smarty->compile_check = $options['compile_check'];
            if ($options['clearAllCache']) {
                $smarty->clearAllCache();
            }
            $smarty->template_dir = $options['template_dir'];
            $smarty->compile_dir = $options['compile_dir'];
            $smarty->config_dir = $options['config_dir'];
            $smarty->cache_dir = $options['cache_dir'];
            self::_addSmartyPlugins($smarty);
            return $smarty;
        };
    }

    private static function _addSmartyPlugins(\Smarty &$smarty)
    {
        $smarty->registerPlugin('function', 'link', array("b3nnu3\\core\\dependencies\\smarty", '_smarty_link_file'), $cacheable = false);
    }

    /**
     * @param $params
     * @param $smarty
     * @return string
     *
     * TODO create cachedir by size
     * TODO create cached image
     * TODO check if cached image exists
     */
    public function _smarty_link_file($params, &$smarty)
    {
        $url = $params['file'];
//        if(array_key_exists('file',$params)){
//            if(array_key_exists('resize',$params)){
//
//                require( __ROOT__.'libs/imagewide/WideImage.php');
//                $img_path = __ROOT__ . $params['file'];
//                $size = explode('x',$params['resize']);
//                $img = \WideImage::load($img_path);
//                $resized = $img->resize($size[0],$size[1]);
//
//            }
//        }
        return (string)$url;
    }

}
