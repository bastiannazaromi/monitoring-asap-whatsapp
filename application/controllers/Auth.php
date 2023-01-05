<?php

use Twilio\TwiML\Voice\Echo_;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('nama'))) {
            if ($this->uri->segment(2) != 'logout') {
                redirect('admin');
            }
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            # code...
            $data = [
                'title' => 'Login',
                'page'  => 'auth/login',
            ];

            $this->load->view('auth/index', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_admin', ['nama' => $nama])->row();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $data = [
                    'nama'  => $user->nama,
                ];

                $this->session->set_userdata($data);
                redirect('admin');
            } else {
                redirect('auth');
            }
        } else {
            redirect('auth');
        }
    }

    // CODE UNTUK LOGOUT
    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('nama'));
        redirect('auth', 'refresh');
    }
}
