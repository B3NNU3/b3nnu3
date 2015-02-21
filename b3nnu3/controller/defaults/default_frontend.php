<?php

namespace b3nnu3\controller\defaults;

abstract class default_frontend extends controller
{
    /**
     * @var \Smarty
     */
    protected $smarty;

    /**
     * @var \Parsedown
     */
    protected $parsdown;
    /**
     * @var array array of less_files should be loaded
     */
    protected $_styles = array();
    protected $_inlineStyles = array();

    public function __construct($container)
    {
        parent::__construct($container);
        $this->_initDefaultStyles();
        $this->smarty = $this->_initSmarty();
        $this->_initCssStyles($this->smarty);
        $this->parsedown = $this->_container['parsedown'];

        $date = new \DateTime;
        $this->smarty->assign('datetime', $date);
        $this->smarty->assign('markdown', 'test');
        $this->smarty->assign('args', '');
        $this->_initMetaIndex();

    }

    protected function _initMetaIndex($metaindex = 'INDEX, FOLLOW')
    {

        $get = $this->_request->query->all();
        $atributes = $this->_request->attributes->all();
        if (count($get) OR count($atributes)) {
            $metaindex = 'NOINDEX, FOLLOW';
        }

        $this->smarty->assign('metaIndex', $metaindex);
    }

    /**
     * @return array
     */
    public function getInlineStyles()
    {
        return $this->_inlineStyles;
    }

    /**
     * @param array $inlineStyles
     */
    public function setInlineStyles($inlineStyles)
    {
        $this->_inlineStyles = $inlineStyles;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->_styles;
    }

    /**
     * @param array $styles
     */
    public function setStyles($styles)
    {
        $this->_styles = $styles;
    }

    protected function _initSmarty()
    {
        return $this->_container['smarty'];
    }

    protected function _initCssStyles(\Smarty &$smarty)
    {
        $files = $this->getStyles();
        if (!count($files)) {
            throw new \Exception('u need to set some CSS files first, use controller::setStyles()');
        }
        $less_files = array();
        foreach ($files as $file) {
            $base_path = __ROOTDIR__ . '/src/less/';
            $file_path = $base_path . $file;
            if (file_exists($file_path)) {
                $less_files[$file_path] = '/src/less/';
            } else {
                throw new \Exception('css file does\'nt exists.' . $file_path);
            }
        }
        /**
         * @var $less_cache \Less_Cache
         */
        $less_cache = $this->_container['less_cache'];
        $options = array(
            'cache_dir' => __ROOTDIR__ . '/src/css/',
            'compress' => true,
            'sourceMap' => true,
            'sourceMapWriteTo' => __ROOTDIR__ . '/src/css/source.map',
            'sourceMapURL' => '/src/css/source.map',
        );
        $filename = '/src/css/' . $less_cache->get($less_files, $options);
        $smarty->assign('css_file', $filename);
        return $this;
    }

    protected function _getInlineCss()
    {
        $files = $this->getInlineStyles();
        if (!count($files)) {
            return false;
        }
        foreach ($files as $file) {
            /**
             * @var $less \Less_Parser
             */
            $less = $this->_container['less'];
            $base_path = __ROOTDIR__ . '/src/less/';
            $file_path = $base_path . $file;
            $less->parseFile($file_path, '/src/css/');
        }
        return $less->getCss();
    }

    protected function _initDefaultStyles()
    {
        $this->setStyles(array(
            "normalize.css",
            "clearfix.css",
            "fonts.css",
            "responsiveslides.css",
            "style.less"
        ));
        return $this;
    }

    protected function _renderTemplate($template_path)
    {
        $content = $this->smarty->fetch($template_path);
        $this->_response->setContent($content);
        $this->_response->send();
    }

    protected function _loadVarsFromJson($json_path)
    {
        /**
         * @var $json \b3nnu3\core\dependencies\jsoncontent
         */
        $json = $this->_container['json_content'];
        $contentvars = $json->getArrayFromContentJson($json_path);
        if ($contentvars) {
            foreach ($contentvars as $key => $value) {
                if ($key == 'content') {
                    $controllername = get_class($this);
                    $controllername = explode("\\", $controllername);
                    $controllername = array_pop($controllername);
//                    var_dump($controllername);
                    $mdfilepath = __ROOTDIR__ . "/content/" . $controllername . "/" . $value;
                    if (file_exists($mdfilepath)) {
                        $value = $this->parsedown->text(file_get_contents($mdfilepath));
                    }
                }
                $this->smarty->assign($key, $value);
            }
        }
    }

}