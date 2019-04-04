<?php

class M_Project extends CI_Model
{
    function showproject()
    {
        return $this->db->query("SELECT * FROM PROJECT");
    }
    function showunaccproject()
    {
        return $this->db->query("SELECT * FROM PROJECT WHERE is_acc = 0 ");
    }
    function showaccount()
    {
        return $this->db->query("SELECT * FROM user");
    }
}
