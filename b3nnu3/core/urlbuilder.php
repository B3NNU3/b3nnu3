<?php

namespace b3nnu3\core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class urlbuilder
 * @package b3nnu3\core
 */
class urlbuilder
{

    /**
     * @var mixed|string
     */
    private $_controller;
    /**
     * @var mixed|string
     */
    private $_method;
    /**
     * @var array
     */
    private $_params = array();

    /**
     * @param Request $request
     */
    public function __construct(Request &$request)
    {
        $this->_redirectOnIndex($request);
        $uri = $request->server->get('REQUEST_URI');
        $uri = explode('/', $uri);
        array_shift($uri);
        array_pop($uri);

        $this->_controller = (count($uri) ? array_shift($uri) : 'index');
        $this->_method = (count($uri) ? array_shift($uri) : 'index');
        if (count($uri)) {
            for ($i = 0; count($uri); $i++) {
                $this->_params[$i] = (count($uri) ? array_shift($uri) : null);
            }
        }
        $this->_addUriParamsToRequest($request);
    }

    private function _addUriParamsToRequest(Request &$request)
    {
        $request->attributes->add($this->_params);
    }

    /**
     * if controller or method is index rewrite to parent folder
     *
     * @param $request
     */
    private function _redirectOnIndex($request)
    {
        $uri = $request->server->get('REQUEST_URI');
        $uri = explode('/', $uri);
        array_shift($uri);
        array_pop($uri);
        if (count($uri) && reset($uri) == 'index') {
            $response = new RedirectResponse('/', 301);
            $response->send();
            exit;
        }
        $parent = array_shift($uri);
        if (count($uri) && reset($uri) == 'index') {
            $response = new RedirectResponse('/' . $parent, 301);
            $response->send();
            exit;
        }
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->_params = $params;
    }

    /**
     * @return mixed|string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     * @param mixed|string $method
     */
    public function setMethod($method)
    {
        $this->_method = $method;
    }

    /**
     * @return mixed|string
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @param mixed|string $controller
     */
    public function setController($controller)
    {
        $this->_controller = $controller;
    }


}