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
    public function explore()
    {
        $data['title'] = "Explore";
        $data['project'] = $this->m_project->showaccproject();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_user', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/explore', $data);
        $this->load->view('templates/user_footer');
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
            $author['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data = [
                'judul' => $this->input->post('title', true),
                'deskripsi' => $this->input->post('desc', true),
                'img' => $new_image,
                'is_acc' => 0,
                'author' => $author['user']['name'],
                'date_created' => date('Y-m-d')
            ];
            $this->db->insert('project', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success!</div>');
            redirect('user/addproject');
        } else {
            $data['title'] = "Add Project";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar_user', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/addproject', $data);
            $this->load->view('templates/user_footer');
        }
    }
    public function manageproject()
    {
        $data['title'] = "My Project";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['project'] = $this->m_project->showmyproject($data['user']['name']);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_user', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/manageproject', $data);
        $this->load->view('templates/user_footer');
    }
    public function updateprofile()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[2]');
        $tmp = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('img', '', 'callback_file_check');
        if ($this->form_validation->run() == true) {
            $upload_img = $_FILES['img']['name'];
            if ($upload_img) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Upload image failed!</div>');
                    redirect('user/manageproject');
                }
            }
            if ($this->input->post('password2')) {
                if ($this->input->post('password2') != $this->input->post('password3')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not match!</div>');
                    redirect('user/myaccount');
                } else {
                    if (password_verify($password, $tmp['password'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('user/myaccount');
                    } else {
                        $this->db->set('password', password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT));
                        $this->db->where(['id' => $tmp['id']]);
                        $this->db->update('user');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile been updated!</div>');
                        redirect('user/myaccount');
                    }
                }
            } else {

                $this->db->set('name', $this->input->post('name'));
                $this->db->where(['id' => $tmp['id']]);
                $this->db->update('user');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile been updated!</div>');
                redirect('user/myaccount');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed!</div>');
            redirect('user/myaccount');
        }
    }
    public function myaccount()
    {
        $data['title'] = "My Account";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_user', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/myaccount', $data);
        $this->load->view('templates/user_footer');
    }
    public function deleteproject($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('project');
        redirect('user/manageproject');
    }
    public function updateproject($id)
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
                    $this->db->set('img', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Upload image failed!</div>');
                    redirect('user/manageproject');
                }
            }
            $author['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data = [
                'judul' => $this->input->post('title', true),
                'deskripsi' => $this->input->post('desc', true),
                'author' => $author['user']['name'],
                'date_created' => date('Y-m-d')
            ];
            $this->db->where(['id' => $id]);
            $this->db->update('project', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Project has been updated!</div>');
            redirect('user/manageproject');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed!</div>');
            redirect('user/manageproject');
        }
    }

    //callback
    public function file_check($str)
    {
        $allowed_mime_type_arr = array('image/gif', 'image/jpeg', 'image/png', 'image/x-png');
        $mime = get_mime_by_extension($_FILES['img']['name']);
        if (isset($_FILES['img']['name']) && $_FILES['img']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
}
