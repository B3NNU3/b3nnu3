<?php

namespace b3nnu3\core\dependencies;

use \Symfony\Component\DependencyInjection\Container;

class jsoncontent
{

    static public function inject(Container &$container)
    {
        $jsoncontent = new self();
        $container->set('json_content', $jsoncontent, Container::SCOPE_CONTAINER);
    }

    public function getArrayFromContentJson($path = false)
    {
        if ($path) {
            $file = __ROOTDIR__ . "/content/" . $path;
        } else {
            $file = __ROOTDIR__ . "/content/" . 'index/index.json';
        }
//        var_dump($file); die();
        if (file_exists($file)) {
            $json = json_decode(file_get_contents($file), true);
            return $json;
        } else {
            return false;
        }
    }

}