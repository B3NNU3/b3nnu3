<?php

namespace b3nnu3\controller\defaults;

use \Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

abstract class controller
{
    /**
     * @var Response
     */
    protected $_response;

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * @param Response $response
     */
    public function setResponse($response)
    {
        $this->_response = $response;
    }

    /**
     * @var Request
     */
    protected $_request;

    /**
     * @param Request $request
     */
    protected function setRequest($request)
    {
        $this->_request = $request;
    }

    /**
     * @return Request
     */
    protected function getRequest()
    {
        return $this->_request;
    }

    /**
     * @var Container
     */
    protected $_container;

    /**
     * if u override __cunstruct please use parent::__construct(); before ur implementation
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {

        $this->_container = $container;

        $app = $this->_container['app'];
        $this->_request = $app->getRequest();
        $this->_defineResponse();
        $this->init();
    }

    protected function _defineResponse()
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/html');
//        $response->headers->set('Expires',600);
        $response->headers->set('Server', 'B3NNU3');
//        $response->headers->set('Content-Encoding','gzip, deflate');
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);
        $this->_response = $response;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->_container;
    }

    /**
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->_container = $container;
    }

    protected function init()
    {
    }
}