<?php

namespace b3nnu3\core\dependencies;

use \Pimple\Container;

class jsoncontent
{

    static public function inject(Container &$container)
    {
        $container['json_content'] = function(){
            return new self(); 
        };        
    }

    public function getArrayFromContentJson($path = false)
    {
        if ($path) {
            $file = __ROOTDIR__ . "/content/" . $path;
        } else {
            $file = __ROOTDIR__ . "/content/" . 'index/index.json';
        }
        if (file_exists($file)) {
            $json = json_decode(file_get_contents($file), true);
            return $json;
        } else {
            return false;
        }
    }

}