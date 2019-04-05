<?php

class M_Project extends CI_Model
{
    function showproject()
    {
        return $this->db->query("SELECT * FROM PROJECT");
    }
    function showmyproject($id)
    {
        return $this->db->query("SELECT * FROM PROJECT WHERE author='" . $id . "'");
    }
    function showdetailproject($id)
    {
        return $this->db->query("SELECT * FROM PROJECT WHERE id='" . $id . "'");
    }
    function showaccproject()
    {
        return $this->db->query("SELECT * FROM PROJECT WHERE is_acc = 1 ");
    }
    function showjoinedproject($id)
    {
        return $this->db->query("SELECT * FROM user_project INNER JOIN project ON user_project.project_id = project.id WHERE user_id ='" . $id . "'");
    }
    function showproject2($id)
    {
        return $this->db->query("SELECT * FROM user_project INNER JOIN project ON user_project.project_id = project.id WHERE project_id ='" . $id . "'");
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
