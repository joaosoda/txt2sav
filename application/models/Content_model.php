<?php
class Content_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
        $this->tableName = 'content';
    }

    public function insert($fields)
    {
        $this->db->insert($this->tableName, $fields);
        return $this->db->insert_id();
    }

    public function update($id, $fields)
    {
        $this->db->where("id = $id");
        $this->db->update($this->tableName, $fields);
        return $this->db->insert_id();
    }

    public function getWhere($where)
    {
        $this->db->where($where, NULL, FALSE);
        $query = $this->db->get($this->tableName);
        return $query->result_array();
    }

    public function getLastByWhere($where)
    {
        $this->db->where($where, NULL, FALSE);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->tableName);
        return $query->row();
    }

    public function getChildren($where)
    {
        $this->db->where($where, NULL, FALSE);
        $this->db->group_by('BINARY md5', FALSE);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->tableName);
        return $query->result_array();
    }
}