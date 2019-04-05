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
    public function manageproject()
    {
        $data['title'] = "Manage Project";
        $data['project'] = $this->m_project->showproject();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_admin', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/manageproject', $data);
        $this->load->view('templates/user_footer');
    }
    public function myaccount()
    {
        $data['title'] = "My Account";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar_admin', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/myaccount', $data);
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
                    redirect('admin/manageproject');
                }
            }
            if ($this->input->post('password2')) {
                if ($this->input->post('password2') != $this->input->post('password3')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password not match!</div>');
                    redirect('admin/myaccount');
                } else {
                    if (password_verify($password, $tmp['password'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('admin/myaccount');
                    } else {
                        $this->db->set('password', password_hash(trim($this->input->post('password')), PASSWORD_DEFAULT));
                        $this->db->where(['id' => $tmp['id']]);
                        $this->db->update('user');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile been updated!</div>');
                        redirect('admin/myaccount');
                    }
                }
            } else {

                $this->db->set('name', $this->input->post('name'));
                $this->db->where(['id' => $tmp['id']]);
                $this->db->update('user');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile been updated!</div>');
                redirect('admin/myaccount');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed!</div>');
            redirect('admin/myaccount');
        }
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
                    redirect('admin/manageproject');
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
            redirect('admin/manageproject');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add project failed!</div>');
            redirect('admin/manageproject');
        }
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
                    redirect('admin/manageproject');
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
                'is_acc' => $is_acc,
                'author' => $author['user']['name'],
                'date_created' => date('Y-m-d')
            ];
            $this->db->where(['id' => $id]);
            $this->db->update('project', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Project has been updated!</div>');
            redirect('admin/manageproject');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed!</div>');
            redirect('admin/manageproject');
        }
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
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
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
                'email' => htmlspecialchars($this->input->post('email', true))
            ];
            $id = $id;
            $result = $this->db->get_where('user', ['id' => $id])->row_array();
            if ($result['email'] != $this->input->post('email', true)) {
                $result2 = $this->db->get_where('user', ['email' => $this->input->post('email', true)])->row_array();
                if ($result2) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update failed! Email has been taken by other account</div>');
                    redirect('admin/manageaccount');
                }
                $this->db->where(['id' => $id]);
                $this->db->update('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! account has been updated!</div>');
                redirect('admin/manageaccount');
            } else {
                $this->db->where(['id' => $id]);
                $this->db->update('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! account has been updated!</div>');
                redirect('admin/manageaccount');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update failed!</div>');
            redirect('admin/manageaccount');
        }
    }
    public function deleteproject($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('project');
        redirect('admin/manageproject');
    }
    public function deleteaccount($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
        redirect('admin/manageaccount');
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
