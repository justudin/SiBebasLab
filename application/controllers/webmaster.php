<?php

class Webmaster extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->helper('form');
        $this->load->model('m_webmaster');
        $this->load->helper(array('form', 'url', 'text_helper', 'date'));
        $this->load->library(array('Pagination', 'image_lib', 'FPDF','session'));
    }

    function index() {
        //default index
        if ($this->cek_status()):
            
            $this->home();
        else:
            redirect('login');
        endif;
    }

    private function home() {
        $data['title'] = "Home Admin Panel Sistem Bebas Lab";
        $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
        $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
        $data['content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/utama', $data);
    }

    //fungsi cek status login
    private function cek_status() {
        if ($this->session->userdata('id_user') != '' and $this->session->userdata('status_login') == '2') {
            return true;
        } return false;
    }

    function pegawai() {
        if ($this->cek_status()):
            $page = $this->uri->segment(3);
            $limit = 15;
            if (!$page):
                $offset = 0;
                $bts = 15;
            else:
                $offset = $page;
                $bts = 15 + $page;
            endif;
            $data["page"] = $page;
            $config['base_url'] = base_url() . '/webmaster/pegawai/';
            $total = $this->m_webmaster->Total_data("LAB_D_PEGAWAI_LAB");
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['pegawai'] = $this->m_webmaster->Ambil_data_pegawai($offset, $bts);
            $data['title'] = "Manajemen Data Pegawai Lab";
            $data['menu'] = "pegawai";
            $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
            $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
            $data['content'] = $this->load->view('admin/pegawai/v_pegawai', $data, TRUE);
            $this->load->view('admin/utama', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi tambah pegawai

    function tambahpegawai() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "proses") {
                $data2 = array();
                $nip = $this->input->post('nip');
                $nm = $this->input->post('nama');
                $tmp = $this->input->post('tmp_lahir');
                $tgl = $this->input->post('tgl_lahir');
                $email = $this->input->post('email');
                $telp = $this->input->post('telp');
                $alamat = $this->input->post('alamat');
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $this->m_webmaster->Input_pegawai($nip, $nm, $tgl, $tmp, $email, $telp, $alamat);
                redirect('webmaster/pegawai', 'refresh');
            } else {
                $data['menu'] = "pegawai";
                $data['title'] = "Tambah Data Pegawai Lab";
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/pegawai/v_tambahpegawai', $data, TRUE);
                $this->load->view('admin/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //FUNGSI EDIT PEGAWAI
    function editpegawai() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "updated") {
                $data2 = array();
                $id = $this->input->post('nopeg');
                $nip = $this->input->post('nip');
                $nm = $this->input->post('nama');
                $tmp = $this->input->post('tmp_lahir');
                $tgl = $this->input->post('tgl_lahir');
                $email = $this->input->post('email');
                $telp = $this->input->post('telp');
                $alamat = $this->input->post('alamat');
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $this->m_webmaster->Update_pegawai($nip, $nm, $tgl, $tmp, $email, $telp, $alamat, $id);
                redirect('webmaster/pegawai', 'refresh');
            } else {

                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "pegawai";
                $data['title'] = "Edit Data Pegawai Lab";
                $data['edit'] = $this->m_webmaster->Edit_pegawai($op);
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/pegawai/v_editpegawai', $data, TRUE);
                $this->load->view('admin/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi hapus pegawai
    function hapuspegawai() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);

            $this->m_webmaster->Delete_data($id, "NO_PEG", "LAB_D_PEGAWAI_LAB");
            redirect('webmaster/pegawai');
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi Jabatan Aktif Pegawai
    //
    function jabatanaktifpegawai() {
        if ($this->cek_status()):
            $page = $this->uri->segment(3);
            $limit = 15;
            if (!$page):
                $offset = 0;
                $bts = 15;
            else:
                $offset = $page;
                $bts = 15 + $page;
            endif;
            $data["page"] = $page;
            $config['base_url'] = base_url() . '/webmaster/jabatanaktifpegawai/';
            $total = $this->m_webmaster->Total_data("LAB_D_JABATAN_AKTIF");
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['pegawai'] = $this->m_webmaster->Ambil_jabatan($offset, $bts);
            $data['title'] = "Manajemen Data Jabatan Aktif Pegawai Lab";
            $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
            $data['menu'] = "jabatanaktifpegawai";
            $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
            $data['content'] = $this->load->view('admin/pegawai/v_jabatanaktif', $data, TRUE);
            $this->load->view('admin/utama', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi tambah jabatanaktifpegawai
    //
    function tambahjabatanaktifpegawai() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "proses") {
                $data2 = array();
                $data2['NO_PEG'] = $this->input->post('nama');
                $data2['KD_JABATAN'] = $this->input->post('jabatan');

                $this->m_webmaster->Simpan_data('LAB_D_JABATAN_AKTIF', $data2);
                redirect('webmaster/jabatanaktifpegawai', 'refresh');
            } else {

                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "jabatanaktifpegawai";
                $data['title'] = "Tambah Jabatan Aktif Pegawai Lab";
                $data['pegawai'] = $this->m_webmaster->Ambil_data("LAB_D_PEGAWAI_LAB");
                $data['jabatanpegawai'] = $this->m_webmaster->Ambil_data("LAB_D_JABATAN_LAB");
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/pegawai/v_tambahjabatanaktif', $data, TRUE);
                $this->load->view('admin/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi hapus jabatan aktif pegawai
    function hapusjabatanaktifpegawai() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);
            $this->m_webmaster->Delete_data($id, "NO_JABATAN", "LAB_D_JABATAN_AKTIF");
            redirect('webmaster/jabatanaktifpegawai');
        else:
            redirect('login', 'refresh');
        endif;
    }

    //FUNGSI REQUEST BEBAS LAB
    function request() {
        if ($this->cek_status()):
            $page = $this->uri->segment(3);
            $limit = 15;
            if (!$page):
                $offset = 0;
                $bts = 15;
            else:
                $offset = $page;
                $bts = 15 + $page;
            endif;
            $data["page"] = $page;
            $config['base_url'] = base_url() . '/webmaster/request/';
            $total = $this->m_webmaster->Total_bebas_lab_request();
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['request'] = $this->m_webmaster->Ambil_request_admin($offset, $bts);
            $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
            $data['title'] = "Manajemen Data Request Masuk Surat Bebas Lab";
            $data['menu'] = "request";
            $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
            $data['content'] = $this->load->view('admin/bebas_lab/v_request', $data, TRUE);
            $this->load->view('admin/utama', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi tambahrequest
    //
    function tambahrequest() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "proses") {
                $data2 = array();
                $nim = $this->input->post('nim');
                $data2['NIM'] = $this->input->post('nim');
                $data2['TGL_MASUK'] = mdate("%d-%M-%y");
                $data2['STATUS'] = "0";
                $data2['BAYAR'] = "BELUM";
                $data2['CETAK'] = "N";
                $cek_ta = $this->m_webmaster->cek_ta($nim);

                if ($cek_ta->num_rows > 0):
                    $this->m_webmaster->Simpan_data('LAB_D_BEBAS_LAB', $data2);
                    $data['warning'] = "Maaf Anda Belum Boleh Meminta Surat Bebas Lab!";
                    $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                    redirect('webmaster/request', 'refresh');
                else:
                    $data['warning'] = "Maaf Anda Belum Boleh Meminta Surat Bebas Lab dikarenakan Anda Belum Mengambil Skripsi!!";
                    $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                    redirect('webmaster/tambahrequest/gagal');
                endif;
            }
            else if ($op == 'gagal') {
                $data['warning'] = "Maaf Anda Belum Boleh Meminta Surat Bebas Lab dikarenakan Anda Belum Mengambil Skripsi!!";
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "request";
                $data['title'] = "Tambah Request Surat Bebas Lab";

                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/bebas_lab/v_tambahrequest', $data, TRUE);
                $this->load->view('admin/utama', $data);
            } else {

                $data['warning'] = "";
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "request";
                $data['title'] = "Tambah Request Surat Bebas Lab";
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/bebas_lab/v_tambahrequest', $data, TRUE);
                $this->load->view('admin/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi hapus request
    function hapusrequest() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);

            $this->m_webmaster->Delete_data($id, "NO_BEBAS_LAB", "D_BEBAS_LAB");
            redirect('webmaster/request');
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi confirm request
    function confirmrequest() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);
            $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
            $this->m_webmaster->Update_status_lab('1', $id);
            redirect('webmaster/request');
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi cetak surat bebas lab
    function cetaksiapcetak() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);
            $datamhs = $this->m_webmaster->Ambil_data_mhs($id);
            $data['datamhs'] = $this->m_webmaster->Ambil_data_mhs($id);
            foreach ($datamhs->result() as $mhs) {
                $kd_prodi = $mhs->KD_PRODI;
            }
            $data['datappl'] = $this->m_webmaster->get_ppl($kd_prodi);
            $data['dirutlab'] = $this->m_webmaster->get_dirut();
            $tgl = mdate("%d-%M-%y");
            $this->load->view('admin/bebas_lab/v_cetak', $data);
            $this->m_webmaster->Update_cetak_surat($tgl, $id);

        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi history yang sudah pernah mencetak surat bebas lab
    function verifikasi() {
        if ($this->cek_status()):
            $page = $this->uri->segment(3);
            if ($page == "cari") {
                $hal = $this->uri->segment(4);
                $limit = 20;
                if (!$hal):
                    $offset = 0;
                    $bts = 20;
                else:
                    $offset = $hal;
                    $bts = 20 + $hal;
                endif;
                $cari = $this->input->post('cari');
                $data["page"] = $hal;
                $config['base_url'] = base_url() . '/webmaster/verifikasi/cari/';
                $total = $this->m_webmaster->Total_bebas_lab_cetak_cari($cari);
                $config['total_rows'] = $total->num_rows();
                $config['per_page'] = $limit;
                $config['uri_segment'] = 3;
                $config['first_link'] = 'Awal';
                $config['last_link'] = 'Akhir';
                $config['next_link'] = 'Selanjutnya';
                $config['prev_link'] = 'Sebelumnya';
                $this->pagination->initialize($config);
                $data['paginator'] = $this->pagination->create_links();

                $data['cetak'] = $this->m_webmaster->Ambil_cetak_cari($cari);
                $data['title'] = "Manajemen Data Siap Cetak Surat Bebas Lab";
                $data['menu'] = "siapcetak/cari";
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/bebas_lab/v_siapcetak', $data, TRUE);
                $this->load->view('admin/utama', $data);
            } else if ($page == "simpan") {
                $data1 = $this->input->post('optbebas'); //menerima id yg byk
                foreach ($data1 as $key => $id) {
                    $this->m_webmaster->Update_status_lab($id);
                }
                $data2=$this->input->post('nim'); //menerima id yg byk
                foreach ($data2 as $key => $nim) {
                    $this->send_email($nim);
                }
                
                redirect('webmaster/verifikasi');
            } else {
                $limit = 20;
                if (!$page):
                    $offset = 0;
                    $bts = 20;
                else:
                    $offset = $page;
                    $bts = 20 + $page;
                endif;
                $data["page"] = $page;
                $config['base_url'] = base_url() . '/webmaster/verifikasi/';
                $total = $this->m_webmaster->Total_bebas_lab_cetak();
                $config['total_rows'] = $total->num_rows();
                $config['per_page'] = $limit;
                $config['uri_segment'] = 3;
                $config['first_link'] = 'Awal';
                $config['last_link'] = 'Akhir';
                $config['next_link'] = 'Selanjutnya';
                $config['prev_link'] = 'Sebelumnya';
                $this->pagination->initialize($config);
                $data['paginator'] = $this->pagination->create_links();
                $data['title'] = "Manajemen Data Siap Cetak Surat Bebas Lab";
                $data['cetak'] = $this->m_webmaster->Ambil_cetak($offset, $limit);
                $data['menu'] = "siapcetak";
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('admin/bebas_lab/v_siapcetak', $data, TRUE);
                $this->load->view('admin/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //
    //fungsi history yang sudah pernah mencetak surat bebas lab
    function history() {
        if ($this->cek_status()):
            $page = $this->uri->segment(3);
            $limit = 20;
            if (!$page):
                $offset = 0;
                $bts = 20;
            else:
                $offset = $page;
                $bts = 20 + $page;
            endif;
            $data["page"] = $page;
            $config['base_url'] = base_url() . '/webmaster/history/';
            $total = $this->m_webmaster->Total_bebas_lab();
            $config['total_rows'] = $total->num_rows();
            $config['per_page'] = $limit;
            $config['uri_segment'] = 3;
            $config['first_link'] = 'Awal';
            $config['last_link'] = 'Akhir';
            $config['next_link'] = 'Selanjutnya';
            $config['prev_link'] = 'Sebelumnya';
            $this->pagination->initialize($config);
            $data['paginator'] = $this->pagination->create_links();
            $data['request'] = $this->m_webmaster->Ambil_history($offset, $bts);
            $data['title'] = "Manajemen Data History Surat Bebas Lab";
            $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
            $data['menu'] = "request";
            $data['menu_utama'] = $this->load->view('admin/vmenu_utama', '', TRUE);
            $data['content'] = $this->load->view('admin/bebas_lab/v_history', $data, TRUE);
            $this->load->view('admin/utama', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

    function send_email($nim) {
        $datamhs = $this->m_webmaster->Ambil_data_mhs_nim($nim);
        foreach ($datamhs->result() as $mhs) {
            $nm = $mhs->NAMA;
            $prodi = $mhs->NM_PRODI;
            $fak = $mhs->NM_FAK;
        }
        $to = $nim . "@student.uin-suka.ac.id";
        $subject = "[Surat Bebas Lab] Informasi Pengambilan Surat Bebas Lab";
        $txt = "Dear $nm,\n\nSurat Bebas Lab Anda sudah bisa diambil.\nDengan Informasi Data Diri Anda Sebagai Berikut:\nNIM         : $nim\nNAMA        : $nm\nPRODI       : $prodi\nFAKULTAS    : $fak\n\nSilahkan membawa KTM untuk mengambil suratnya di bagian admin lab lantai 1 sebelah timur.\n\nSekian dan Terimakasih,\n\nSalam\n\n\nAdmin Sistem Bebas Lab";
        $headers = "From: admin@bebaslab.uin-suka.ac.id" . "\r\n" .
                "BCC: sisteml8b@gmail.com";

        mail($to, $subject, $txt, $headers);
    }

    //
    //fungsi untuk logout
    function logout() {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('status_login');
        redirect('login', 'refresh');
    }

}

//