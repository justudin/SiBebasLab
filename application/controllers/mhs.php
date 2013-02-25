<?php

class Mhs extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->helper('form');
        $this->load->model('m_mhs');
    }

    function index() {
        if ($this->cek_status()):
            $nim = $this->session->userdata('nim');
            $data['cek_ta'] = $this->m_mhs->cek_ta($nim);
            $data['menu_utama'] = $this->load->view('home/v_menu', $data, TRUE);
            $data['content'] = $this->load->view('home/home', $data, TRUE);
            $this->load->view('home/v_utama', $data);
        else:

            $data['warning'] = "";
            $data['menu_utama'] = $this->load->view('home/v_menu', $data, TRUE);
            $data['content'] = $this->load->view('home/v_login', $data, TRUE);
            $this->load->view('home/v_utama', $data);
        endif;
    }

    //proses surat bebas lab
    function suratbebaslab() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            $nim = $this->session->userdata('nim');
            $cek_ta = $this->m_mhs->cek_ta($nim);
            if ($cek_ta->num_rows>0):
                if ($op == "permintaan"):

                    $this->m_mhs->Input_bebas_lab($nim);
                    redirect('mhs/suratbebaslab', 'refresh');
                else:
                    $nim = $this->session->userdata('nim');
                    $data['lulus'] = $this->m_mhs->cek_lulus($nim);
                    //$data['jum_sks'] = $this->m_mhs->cek_sks($nim);
                    $data['cek_ta'] = $this->m_mhs->cek_ta($nim);
                    $data['menu_utama'] = $this->load->view('home/v_menu', $data, TRUE);

                    $data['databebaslab'] = $this->m_mhs->get_bebas_lab($nim);
                    $data['content'] = $this->load->view('home/v_bebaslab', $data, TRUE);
                    $this->load->view('home/v_utama', $data);
                endif;
            else:
                $this->index();
            endif;

        endif;
    }

    //cek status login or gak
    private function cek_status() {
        if ($this->session->userdata('nim') != '' and $this->session->userdata('nama_mhs') != '' and $this->session->userdata('kd_prodi') != '' and $this->session->userdata('id_akses') == '1') {
            return true;
        } return false;
    }

    //proses login
    public function ceklogin($op) {
        if ($op == 'proses') {
            $data['ID_USER'] = $this->input->post('user');
            $data['PASSWORD'] = $this->input->post('password');
            if ($this->input->post('login') == 'LOGIN' && $data = $this->m_mhs->login($data)) {
                $login['nim'] = $data['ID_USER'];
                $login['kd_prodi'] = $data['KD_PRODI'];
                $login['nama_mhs'] = $data['NAMA'];
                $login['nm_prodi'] = $data['NM_PRODI'];
                $login['id_akses'] = $data['ID_AKSES'];
                $this->session->set_userdata($login);
                redirect('/', 'refresh');
            }else
                redirect('mhs/ceklogin/salah');
        }
        if ($op == 'salah') {
            $data['warning'] = "Username atau Password salah!";
            $data['menu_utama'] = $this->load->view('home/v_menu', '', TRUE);
            $data['content'] = $this->load->view('home/v_login', $data, TRUE);
            $this->load->view('home/v_utama', $data);
        }
    }

    //proses logout
    function logout() {
        $this->session->unset_userdata('nim');
        $this->session->unset_userdata('kd_prodi');
        $this->session->unset_userdata('nama_mhs');
        $this->session->unset_userdata('nm_prodi');
        $this->session->unset_userdata('id_akses');
        redirect('/', 'refresh');
    }

}

//
//
//