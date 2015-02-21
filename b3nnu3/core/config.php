<?php
namespace b3nnu3\core;

class config
{

    private $database;
    private $smarty;
    private $less;

    public function __construct()
    {

        $this->database = array(
            'server' => "",
            'user' => '',
            'pass' => '',
            'database' => ''
        );

        $this->smarty = array(
            "template_dir" => __ROOTDIR__ . '/templates/',
            "compile_dir" => __ROOTDIR__ . '/cache/smarty/templates_c/',
            "config_dir" => __ROOTDIR__ . '/smarty/configs/',
            "cache_dir" => __ROOTDIR__ . '/cache/smarty/tmp/',
            "caching" => false,
            "compile_check" => true,
            "clearAllCache" => true
        );

        $this->less = array(
            'compress' => true,
            'cache_dir' => __ROOTDIR__ . '/src/css/partials/',
            'sourceMap' => true,
            'sourceMapWriteTo' => __ROOTDIR__ . '/src/css/source.map',
            'sourceMapURL' => '/src/css/source.map',
        );

        $this->_loadConfigFromJson();
    }

    private function _loadConfigFromJson()
    {
        $file = __ROOTDIR__ . "/b3nnu3/config.json";
        if (!file_exists($file)) {
            throw new \Exception('no Config File provided');
        }
        $jsonconfig = json_decode(file_get_contents($file), true);
        foreach ($jsonconfig as $key => $configitem) {
            if (is_array($configitem)) {
                $this->$key = array_merge($this->$key, $configitem);
            }
        }
    }

    /**
     * @return array
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**
     * @return array
     */
    public function getSmarty()
    {
        return $this->smarty;
    }

    /**
     * @return array
     */
    public function getLess()
    {
        return $this->less;
    }


}