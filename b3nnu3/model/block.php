<?php
namespace b3nnu3\model;

class block extends defaults\model
{

    public function getAllEntries()
    {
        $result = $this->db->query("SELECT * FROM default_pages_blocks");
        return $result->fetchAllArray();
    }
    
    public function getBlocksByPageId($id){
        $result = $this->db->query("SELECT * FROM default_pages_blocks WHERE default_pages_id = ?", array($id));
        $blocks = $result->fetchAllArray();
        foreach($blocks as &$block){
            $result= $this->db->query("SELECT * FROM ".$block['cms_content_type']." WHERE id = ? ", array($block['cms_content_id']));
            $block = $result->fetchAllArray();
        }
        return $blocks;
    }    
}