<?php
namespace b3nnu3\model;

class page extends defaults\model
{

    public function getAllEntries()
    {
        $result = $this->db->query("SELECT * FROM default_pages");
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
            $result = $this->db->query("SELECT * FROM default_pages WHERE url_key = ?", array($url_key));
            return $result->fetchArray();
        }
        return false;
    }
    
    public function getBlocksByPageId($id){
        $result = $this->db->query("SELECT * FROM default_pages_blocks WHERE default_pages_id = ?", array($id));
        return $result->fetchArray();
    }
    
}