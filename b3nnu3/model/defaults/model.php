<?php
namespace b3nnu3\model\defaults;

use \Pimple\Container;
use \voku\db\DB;

/**
 *
 * Class model
 * @package b3nnu3\model\defaults
 */
abstract class model
{

    protected $result = array();

    /**
     * @var Container
     */
    protected $_container;

    /**
     * @var DB
     */
    protected $db;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->_container = $container;
        $this->db = $this->_container->get('database');
    }
}