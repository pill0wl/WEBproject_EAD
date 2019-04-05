<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_project');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $id = $this->input->get('id');
        if ($id) {
            $data['title'] = "Detail Project";
<<<<<<< HEAD
            $data['project'] = $this->m_project->showdetailproject($id)->row_array();
=======
            $data['project'] = $this->m_project->showproject()->row_array();
>>>>>>> d647304d7f5e1e0e7caea869f3de2195c8e727bc
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['joined'] = $this->db->query("SELECT * FROM user_project INNER JOIN project ON user_project.project_id = project.id WHERE user_id = " . $data['user']['id'] . " and project.id = " . $id . "")->row_array();
            $this->load->view('templates/project_header', $data);
            $this->load->view('project/view', $data);
            $this->load->view('templates/project_footer');
        }
    }
    public function joinproject($id)
    {
        $this->form_validation->set_rules('team', 'team', 'trim|required');
        if ($this->form_validation->run() == true) {
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $projec_id = $id;
            $user_id = $data['user']['id'];
            $team = $this->input->post('team');
            $info = [
                'user_id' => $user_id,
                'project_id' => $projec_id,
                'team' => $team
            ];
            $this->db->insert('user_project', $info);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Joined!</div>');
            redirect('project?id=' . $id);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed!</div>');
            redirect('project?id=' . $id);
        }
    }
    public function leaveproject($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $projec_id = $id;
        $user_id = $data['user']['id'];
        $this->db->where('project_id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_project');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Leaved!</div>');
        redirect('project?id=' . $id);
    }
}
