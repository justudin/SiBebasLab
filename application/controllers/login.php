<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('m_webmaster');
    }

    public function index() {
        $data['warning'] = "";
        $this->load->view('v_login', $data);
        if ($this->session->userdata('status_login') == 2) {
            redirect('webmaster');
        } elseif ($this->session->userdata('status_login') == 1) {
            redirect('keuangan');
        }
    }

    public function ceklogin($op) {
        if ($op == 'proses') {
            $data['USERNAME'] = $this->input->post('username');
            //$data['PASSWORD'] = md5($this->input->post('password'));
            $data['PASSWORD'] = $this->input->post('password');
            $nip=$this->input->post('username');
            if ($this->input->post('login') == 'LOGIN' && $data = $this->m_webmaster->login_service($nip)) {
                $login['id_user'] = $data['id_user'];
                $login['status_login'] = $data['level'];
                $this->session->set_userdata($login);
                if ($data['level'] == '2'):
                    //echo $this->session->userdata('id_user')." LEVEL".$this->session->userdata('status_login');
                    redirect('webmaster', 'refresh');
                else:
                    //echo $this->session->userdata('id_user')." LEVEL".$this->session->userdata('status_login');
                    redirect('keuangan', 'refresh');
                endif;
            }else
                redirect('login/ceklogin/salah');
             
        }
        if ($op == 'salah') {
            $data['warning'] = "Username atau Password salah!";
            $this->load->view('v_login', $data);
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */