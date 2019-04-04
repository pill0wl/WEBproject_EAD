<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != "2") {
            redirect('admin');
        }
        check_login();
    }
    public function index()
    {
        $data['title'] = "Project List";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar_user', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/user_footer');
        }
    }
}
