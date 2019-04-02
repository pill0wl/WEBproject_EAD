<?php

class M_Project extends CI_Model
{
    function showproject()
    {
        return $this->db->query("SELECT * FROM PROJECT");
    }
}
 