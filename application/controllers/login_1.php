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
            $aipiso = "http://service.uin-suka.ac.id/";
            $keyone = "8f304662ebfee3932f2e810aa8fb628717";
            $keytwo = $this->input->post('username');
            $keytri = $this->input->post('password');
            $grepe2 = file_get_contents("$aipiso/servad/adlogauth.php?aud=$keyone&uss=$keytwo&pss=$keytri");
            $keter1 = "Server Wisuda Gagal ";
            $keter2 = " Server Service";
            $keter3 = ", cobalah beberapa saat lagi!";
            $keter4 = " Server Pembayaran ";
            if (strlen($grepe2) < 1)
                echo $e1 . $keter1 . "Terhubung dengan" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == "0")
                echo $e1 . $keter1 . "Terhubung dengan Akun" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == 1)
                echo $e1 . $keter1 . "Terhubung dengan IP" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == 2)
                echo $e1 . $keter1 . "Autentikasi dengan" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == 3)
                echo $e1 . $keter1 . "Terkoneksi dengan" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == 4)
                echo $e1 . "User atau Password tidak sesuai" . $keter3 . $e3;
            elseif ($grepe2 == 5)
                echo $e1 . $keter1 . "mengambil data Anda dari" . $keter2 . $keter3 . $e3;
            elseif ($grepe2 == 6)
                echo $e1 . $keter1 . "menemukan data Anda di" . $keter2 . $keter3 . $e3;
            elseif (strpos($grepe2, "427")) {
                $jesoneki = json_decode($grepe2, true);
                $nip = $jesoneki[0]['427'];
                $grouuser = $jesoneki[0]['art'];
                echo $grepe2;
                /*
            if ($this->input->post('login') == 'LOGIN' && $data = $this->m_webmaster->login_service($nip)) {
                $login['id_user'] = $data['id_user'];
                $login['status_login'] = $data['status'];
                $login['nama'] = $data['nama'];
                $login['username'] = $data['username'];
                $this->session->set_userdata($login);
                if ($data['status'] == '2'):
                    redirect('webmaster', 'refresh');
                else:
                    redirect('keuangan', 'refresh');
                endif;
            }else
                redirect('login/ceklogin/salah');
                 * 
                 */
            }
        }
        if ($op == 'salah') {
            $data['warning'] = "Username atau Password salah!";
            $this->load->view('v_login', $data);
        }
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */