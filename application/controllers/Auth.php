<?php

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }
    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->Auth_model->login($username, $password);

        if ($result) {
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('username', $username);
            redirect('admin');
        } else {
            $this->session->set_flashdata('message_login_error', 'Login Gagal, Username dan Password Salah!');
            redirect('auth');
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('username');

        redirect('auth');
    }
}
?>