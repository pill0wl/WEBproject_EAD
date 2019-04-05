<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('role_id') == "1") {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else {
            //do nothing
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login!';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //user ad
        if ($user) {
            //user aktif
            if ($user['is_active'] == 1) {
                //cek pw
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    if ($user['role_id'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('admin');
                    } else {
                        $this->session->set_userdata($data);
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah boi!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered! Bikin dulu boi!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('role_id') == "1") {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else {
            //do nothing
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!',
            'required' => 'Password required!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration!';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            $token = base64_encode(random_bytes(16));
            $data_token = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'token' => $token,
                'date_created' => time()
            ];
            $this->_sendemail($token, 'verify');

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $data_token);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! Please check your email</div>');

            redirect('auth');
        }
    }


    public function _sendemail($token, $type)
    {
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_user' => 'projectead14@gmail.com',    // Ganti dengan email gmail kamu
            'smtp_pass' => 'Lol33221',      // Password gmail kamu
            'smtp_port' => 465,
            'crlf'      => "\r\n",
            'newline'   => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('projectead14@gmail.com', 'Project EAD');

        // Email penerima
        $this->email->to($this->input->post('email')); // Ganti dengan email tujuan kamu

        if ($type == 'verify') {
            $this->email->subject('Project EAD Account Verification');
            // Isi email
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        }
        if ($type == 'forgot') {
            $this->email->subject('Project EAD Reset Password');
            // Isi email
            $this->email->message('Click this link to reset your account password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset password</a>');
        }

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }
    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot password!';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => '1']);
            if ($user) {
                $token = base64_encode(random_bytes(16));
                $data_token = [
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->_sendemail($token, 'forgot');
                $this->db->insert('user_token', $data_token);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Email not registered or account not activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please change your password</div>');
                    $this->changepassword();
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token expired!</div>');
                    redirect('auth/forgotpassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong token</div>');
                redirect('auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong email</div>');
            redirect('auth/forgotpassword');
        }
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account activation success! Please login</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong token</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email</div>');
            redirect('auth');
        }
    }
    public function changepassword()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!',
            'required' => 'Password required!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change password!';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! Please login!</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Successful! You have been logout!</div>');
        redirect('');
    }
}
