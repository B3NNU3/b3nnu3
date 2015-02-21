<?php
namespace b3nnu3\model\news;


class categories extends \b3nnu3\model\news
{

    public function getAllEntries($sort = false)
    {
        if (!isset($this->result['all_entries'])) {
            $result = $this->db->query("SELECT * FROM news_categories");
            $this->result['all_entries'] = $result->fetchAllArray();
        }
        return $this->result['all_entries'];
    }

    /**
     * @param $url_key string
     * @return array|bool|null
     * @throws \Exception
     */
    public function getEntryByUrlKey($url_key)
    {
        if (is_string($url_key)) {
            if (!isset($this->result['entry_by_url'][$url_key])) {
                $result = $this->db->query("SELECT * FROM news_categories WHERE url_key = ?", array($url_key));
                $this->result['entry_by_url'][$url_key] = $result->fetchArray();
            }
            return $this->result['entry_by_url'][$url_key];
        }
        return false;
    }

    /**
     * return array newslist + cat_info OR false
     *
     * @param $url_key
     * @return mixed
     * @throws \Exception
     */
    public function getNewsByCategoryKey($url_key)
    {
        if (is_string($url_key)) {
            if (!isset($this->result['news_by_category'][$url_key])) {
                $result = $this->db->query("SELECT id,title,description FROM news_categories WHERE url_key = ?", array($url_key));
                $this->result['news_by_category'][$url_key] = $result->fetchArray();
                if (!$this->result['news_by_category'][$url_key]) {
                    return false;
                }
                $result = $this->db->query("SELECT n.title as title, n.url_key as url_key, n.content as content FROM news as n,news_to_categories as ntc WHERE ntc.category_id = ? AND ntc.news_id = n.id", array($this->result['news_by_category'][$url_key]['id']));
                $this->result['news_by_category'][$url_key]['news'] = $result->fetchAllArray();
            }
            return $this->result['news_by_category'][$url_key];
        }
    }
}