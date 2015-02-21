<?php

namespace b3nnu3\controller\defaults;

use \voku\db\DB;

abstract class database_frontend extends default_frontend
{
    /**
     * @var DB
     */
    public $db;

    /**
     * @return DB
     */
    public function getDb()
    {
        return $this->db;
    }

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $this->_container['database'];
    }
}