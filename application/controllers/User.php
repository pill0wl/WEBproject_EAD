<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_project');
        if ($this->session->userdata('role_id') != "2") {
            redirect('admin');
        }
        check_login();
    }
    public function index()
    {
        $data['title'] = "Project List";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['project'] = $this->m_project->showjoinedproject($data['user']['id']);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_user', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer', $data);
    }
    public function addproject()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required|min_length[5]|max_length[128]');
        $this->form_validation->set_rules('desc', 'desc', 'trim|required|min_length[5]|max_length[512]');
        $this->form_validation->set_rules('img', '', 'callback_file_check');
        if ($this->form_validation->run() == true) {
            $upload_img = $_FILES['img']['name'];
            if ($upload_img) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/project';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img')) {
                    $new_image = $this->upload->data('file_name');
                    //$this->db->set('img',$new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Upload image failed!</div>');
                    redirect('user/addproject');
                }
            }
            if (!$this->input->post('is_acc')) {
                $is_acc = 0;
            } else {
                $is_acc = 1;
            }
            $author['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data = [
                'judul' => $this->input->post('title', true),
                'deskripsi' => $this->input->post('desc', true),
                'img' => $new_image,
                'is_acc' => $is_acc,
                'author' => $author['user']['name'],
                'date_created' => date('Y-m-d')
            ];
            $this->db->insert('project', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success!</div>');
            redirect('user/addproject');
        } else {
            $data['title'] = "Add Project";
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar_user', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/addproject', $data);
            $this->load->view('templates/user_footer');
        }
    }
}
