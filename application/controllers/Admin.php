<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_project');
        if ($this->session->userdata('role_id') != "1") {
            redirect('user');
        }
        check_login();
    }

    public function index()
    {
        $data['title'] = "Administrator";
        $data['project'] = $this->m_project->showproject();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_admin', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer');
    }
    public function reqproject()
    {
        $data['title'] = "Requested Project";
        $data['project'] = $this->m_project->showunaccproject();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_admin', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/reqproject', $data);
        $this->load->view('templates/user_footer');
    }
    public function manageaccount()
    {
        $data['title'] = "Manage Account";
        $data['account'] = $this->m_project->showaccount();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_admin', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/manageaccount', $data);
        $this->load->view('templates/user_footer');
    }
    public function changeacc()
    {
        $id = $this->input->post('id');
        $data = [
            'id' => $id
        ];
        $result = $this->db->get_where('project', $data)->row_array();
        if ($result['is_acc'] == 1) {
            $this->db->where($data);
            $this->db->update('project', ['is_acc' => 0]);
        } else {
            $this->db->where($data);
            $this->db->update('project', ['is_acc' => 1]);
        }
    }
    public function updateaccount($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[2]');
        if ($this->form_validation->run() == true) {
            if (!$this->input->post('role')) {
                $role = 2;
            } else {
                $role = 1;
            }
            if (!$this->input->post('is_active')) {
                $is_active = 0;
            } else {
                $is_active = 1;
            }

            $data = [
                'role_id' => $role,
                'is_active' => $is_active,
                'name' => htmlspecialchars($this->input->post('name', true)),
            ];
            $id = $id;
            $this->db->where(['id' => $id]);
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! your account has been created. Please Login!</div>');
            redirect('admin/manageaccount');
        }
    }
    public function deleteaccount($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        redirect('admin/manageaccount');
    }
}
