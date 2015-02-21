<?php

namespace b3nnu3\controller;

/**
 * Class media
 * @package b3nnu3\controller
 * TODO get all /media images via ajax
 * TODO send browser size with ajax
 * TODO get image in size depend on browsersize from cache
 *
 */
class media extends defaults\no_template
{

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        throw new \b3nnu3\core\notfound('Nothing to See here!');
    }

    /**
     * @param $method
     * @param $args
     */
    public function __call($method, $args)
    {
        if ($method == 'imagesAction') {
            $attributes = $this->_request->attributes->all();
            $url = implode("/", $attributes);

            $img_path = __ROOTDIR__ . '/_media/images/' . $url;
            /**
             * @var $wideimage \WideImage\WideImage
             */
            $wideimage = $this->_container['wideimage'];
            $this->_response->send();
            $img = $wideimage->load($img_path);
            $img = $img->resize('800', NULL, 'inside', 'down');

            $img->output('png', 5);
        }
    }
}