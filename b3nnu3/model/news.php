<?php
namespace b3nnu3\model;

class news extends defaults\model
{

    public function getAllEntries($sort = false)
    {
        $result = $this->db->query("SELECT * FROM news");
        return $result->fetchAllArray();
    }

    /**
     * @param $url_key string
     * @return array|bool|null
     * @throws \Exception
     */
    public function getEntryByUrlKey($url_key)
    {
        if (is_string($url_key)) {
            $result = $this->db->query("SELECT * FROM news WHERE url_key = ?", array($url_key));
            return $result->fetchArray();
        }
        return false;
    }
}