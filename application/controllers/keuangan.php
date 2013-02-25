<?php

class Keuangan extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->helper('form');
        $this->load->model('m_webmaster');
        $this->load->helper(array('form', 'url', 'text_helper', 'date'));
        $this->load->library(array('Pagination', 'image_lib', 'FPDF'));
        
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
        $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
        $data['title'] = "Home Bagian Keuangan Sistem Bebas Lab";
        $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
        $data['content'] = $this->load->view('tu/home', $data, TRUE);
        $this->load->view('tu/utama', $data);
    }

    //fungsi cek status login
    private function cek_status() {
        if ($this->session->userdata('id_user') != '' and $this->session->userdata('status_login') == '1') {
            return true;
        } return false;
    }

    //FUNGSI REQUEST BEBAS LAB
    function request() {
        if ($this->cek_status()):
            $data['warning'] = "";
            $data['title'] = "Tambah Request Surat Bebas Lab";
            $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
            $data['content'] = $this->load->view('tu/bebas_lab/v_request', $data, TRUE);
            $this->load->view('tu/utama', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi tambah request
    function tambahrequest() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "proses") {

                $nim = $this->input->post('nim');

                $cek_ta = $this->m_webmaster->cek_ta($nim);

                if ($cek_ta->num_rows > 0):
                    $this->m_webmaster->Simpan_data_bebas_lab($nim);
                    $hrg = $this->m_webmaster->biaya_lab();
                    foreach ($hrg->result() as $jm) {
                        $jumlah = $jm->JUMLAH;
                    }
                    $this->m_webmaster->Simpan_data_keuangan($nim, $jumlah);
                    $data['warning'] = "sukses";
                    $data['title'] = "Tambah Request Surat Bebas Lab";
                    $data['datadiri'] = $this->m_webmaster->Ambil_data_mhs_nim($nim);

                    $data['title'] = "Tambah Request Surat Bebas Lab";
                    $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                    $data['content'] = $this->load->view('tu/bebas_lab/v_request', $data, TRUE);
                    $this->load->view('tu/utama', $data);
                else:
                    $data['warning'] = "Maaf Mahasiswa yang Bersangkutan Belum Boleh Meminta Surat Bebas Lab dikarenakan Belum Mengambil Skripsi.";
                    $data['title'] = "Tambah Request Surat Bebas Lab";
                    redirect('keuangan/tambahrequest/gagal');
                endif;
            }
            else if ($op == 'gagal') {
                $data['warning'] = "Maaf Mahasiswa yang Bersangkutan Belum Boleh Meminta Surat Bebas Lab dikarenakan Belum Mengambil Skripsi.";
                $data['title'] = "Tambah Request Surat Bebas Lab";
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/bebas_lab/v_request', $data, TRUE);
                $this->load->view('tu/utama', $data);
            } else {

                $data['warning'] = "";
                $data['jml_cetak'] = $this->m_webmaster->Total_siap_cetak();
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "request";
                $data['title'] = "Tambah Request Surat Bebas Lab";
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/bebas_lab/v_request', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi confirm request
    function confirmrequest() {
        if ($this->cek_status()):
            $id = base64_decode($this->uri->segment(3));
            $nim = $id;
            $hrg = $this->m_webmaster->biaya_lab();
            foreach ($hrg->result() as $jm) {
                $jumlah = $jm->JUMLAH;
            }
            //print kwitansi
            $data['datamhs'] = $this->m_webmaster->Ambil_data_mhs_nim($id);
            $data['harga'] = $jumlah;
            $data['pegawaitu'] = $this->m_webmaster->get_pegawaitu();
            $this->load->view('tu/v_cetak_kuitansi', $data);
        else:
            redirect('login', 'refresh');
        endif;
    }

     //fungsi cetakbebaslab
    function cetakbebaslab() {
        if ($this->cek_status()):
            $id = base64_decode($this->uri->segment(3));
            //print bebas lab
            $datamhs = $this->m_webmaster->Ambil_data_mhs_nim($id);
            $data2['datamhs'] = $this->m_webmaster->Ambil_data_mhs_nim($id);
            foreach ($datamhs->result() as $mhs) {
                $kd_prodi = $mhs->KD_PRODI;
            }
            $data2['datappl'] = $this->m_webmaster->get_ppl($kd_prodi);
            $data2['dirutlab'] = $this->m_webmaster->get_dirut();
            $tgl = mdate("%d-%M-%y");
            $this->load->view('admin/bebas_lab/v_cetak', $data2);

        else:
            redirect('login', 'refresh');
        endif;
    }
    
    function cetakall() {
        $dec = base64_decode($this->uri->segment(3));
        $dt= explode('+',$dec);
        $id= $dt[0];
        $nim = $id;
        $hrg = $this->m_webmaster->biaya_lab();
        foreach ($hrg->result() as $jm) {
            $jumlah = $jm->JUMLAH;
        }
        //print kwitansi
        $data2['harga'] = $jumlah;
        $data2['pegawaitu'] = $this->m_webmaster->get_pegawaitu();
        //print bebas lab
        $datamhs = $this->m_webmaster->Ambil_data_mhs_nim($id);
        $data2['datamhs'] = $this->m_webmaster->Ambil_data_mhs_nim($id);
        foreach ($datamhs->result() as $mhs) {
            $kd_prodi = $mhs->KD_PRODI;
        }
        $data2['datappl'] = $this->m_webmaster->get_ppl($kd_prodi);
        $data2['dirutlab'] = $this->m_webmaster->get_dirut();
        $tgl = mdate("%d-%M-%y");
        $this->load->view('tu/v_cetak_all', $data2);
    }
    //fungsi laporan
    function laporan() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "hariini") {
                $page = $this->uri->segment(4);
                $limit = 15;
                if (!$page):
                    $offset = 0;
                    $bts = 15;
                else:
                    $offset = $page;
                    $bts = 15 + $page;
                endif;
                $data["page"] = $page;
                $config['base_url'] = base_url() . '/keuangan/laporan/hariini';
                $tglawal = date('d-M-y');
                $tglkurangi = strtotime ( '-1 day' , strtotime ( $tglawal ) ) ;
                $tgl=date( 'd-M-y' , $tglkurangi );
                $total = $this->m_webmaster->Total_data_laporan($tgl);
                $config['total_rows'] = $total->num_rows();
                $config['per_page'] = $limit;
                $config['uri_segment'] = 4;
                $config['first_link'] = 'Awal';
                $config['last_link'] = 'Akhir';
                $config['next_link'] = 'Selanjutnya';
                $config['prev_link'] = 'Sebelumnya';
                $this->pagination->initialize($config);
                $data['paginator'] = $this->pagination->create_links();
                $data['jml_uang'] = $this->m_webmaster->Jml_uang($tgl);
                $data['laporan'] = $this->m_webmaster->Ambil_laporan_filter($offset, $bts, $tgl);
                $data['title'] = "Manajemen Data Laporan Keuangan Surat Bebas Lab";
                $data['menu'] = "laporan";
                $data['opsi'] = "Hari Ini " . $tgl;
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/v_laporan', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }elseif ($op == "bulanini") {
                $page = $this->uri->segment(4);
                $limit = 15;
                if (!$page):
                    $offset = 0;
                    $bts = 15;
                else:
                    $offset = $page;
                    $bts = 15 + $page;
                endif;
                $data["page"] = $page;
                $config['base_url'] = base_url() . '/keuangan/laporan/bulanini';
                $tgl = mdate('%M-%y');
                $total = $this->m_webmaster->Total_data_laporan($tgl);
                $config['total_rows'] = $total->num_rows();
                $config['per_page'] = $limit;
                $config['uri_segment'] = 4;
                $config['first_link'] = 'Awal';
                $config['last_link'] = 'Akhir';
                $config['next_link'] = 'Selanjutnya';
                $config['prev_link'] = 'Sebelumnya';
                $this->pagination->initialize($config);
                $data['paginator'] = $this->pagination->create_links();
                $data['laporan'] = $this->m_webmaster->Ambil_laporan_filter($offset, $bts, $tgl);
                $data['title'] = "Manajemen Data Laporan Keuangan Surat Bebas Lab";
                $data['menu'] = "laporan";
                $data['opsi'] = "Bulan Ini ";
                $data['jml_uang'] = $this->m_webmaster->Jml_uang($tgl);
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/v_laporan', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }elseif ($op == "custom") {
                $awal = $this->uri->segment(4);
                if (!$awal) {
                    $data['title'] = "Manajemen Data Laporan Keuangan Surat Bebas Lab";
                    $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                    $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                    $data['content'] = $this->load->view('tu/v_filter_laporan', $data, TRUE);
                    $this->load->view('tu/utama', $data);
                } elseif ($awal == "cari") {
                    $cek = $this->uri->segment(5);
                    if (!$cek):
                        $tgl1 = $this->input->post('tgl_mulai');
                        $tgl2 = $this->input->post('tgl_akhir');
                    else:
                        $tgl1 = $this->uri->segment(5);
                        $tgl2 = $this->uri->segment(6);
                    endif;
                    $page = $this->uri->segment(7);
                    $limit = 15;
                    if (!$page):
                        $offset = 0;
                        $bts = 15;
                    else:
                        $offset = $page;
                        $bts = 15 + $page;
                    endif;
                    $data["page"] = $page;
                    $config['base_url'] = base_url() . '/keuangan/laporan/custom/cari/' . $tgl1 . '/' . $tgl2;
                    $total = $this->m_webmaster->Total_data_laporan_tgl($tgl1, $tgl2);
                    $config['total_rows'] = $total->num_rows();
                    $config['per_page'] = $limit;
                    $config['uri_segment'] = 7;
                    $config['first_link'] = 'Awal';
                    $config['last_link'] = 'Akhir';
                    $config['next_link'] = 'Selanjutnya';
                    $config['prev_link'] = 'Sebelumnya';
                    $this->pagination->initialize($config);
                    $data['paginator'] = $this->pagination->create_links();
                    $data['laporan'] = $this->m_webmaster->Ambil_laporan_filter_tgl($offset, $bts, $tgl1, $tgl2);
                    $data['title'] = "Manajemen Data Laporan Keuangan Surat Bebas Lab";
                    $data['menu'] = "laporan";
                    $data['tgl1'] = $tgl1;
                    $data['tgl2'] = $tgl2;
                    $data['opsi'] = "Tanggal " . $tgl1 . " s/d " . $tgl2;
                    $data['jml_uang'] = $this->m_webmaster->Jml_uang_tgl($tgl1, $tgl2);
                    $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                    $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                    $data['content'] = $this->load->view('tu/v_laporan', $data, TRUE);
                    $this->load->view('tu/utama', $data);
                }
            } elseif ($op == "cetak_pdf") {
                $link = $this->uri->segment(4);
                if ($link == 'hariini'):
                    $tglawal = date('d-M-y');
                    $tglkurangi = strtotime('-1 day', strtotime($tglawal));
                    $tgl = date('d-M-y', $tglkurangi);
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_hariini($tgl);
                elseif ($link == 'bulanini'):
                    $tgl = mdate('%M-%y');
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_hariini($tgl);
                elseif ($link == 'custom'):
                    $tgl1 = $this->uri->segment(5);
                    $tgl2 = $this->uri->segment(6);

                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_custom($tgl1, $tgl2);
                else:
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_semua();
                endif;

                $this->load->view('tu/v_cetak_pdf', $data);
            } elseif ($op == "cetak_xls") {
                $link = $this->uri->segment(4);
                if ($link == 'hariini'):
                    $tglawal = date('d-M-y');
                    $tglkurangi = strtotime('-1 day', strtotime($tglawal));
                    $tgl = date('d-M-y', $tglkurangi);
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_hariini($tgl);
                elseif ($link == 'bulanini'):
                    $tgl = mdate('%M-%y');
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_hariini($tgl);
                elseif ($link == 'custom'):
                    $tgl1 = $this->uri->segment(5);
                    $tgl2 = $this->uri->segment(6);

                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_custom($tgl1, $tgl2);
                else:
                    $data['datatransaksi'] = $this->m_webmaster->Ambil_laporan_semua();
                endif;
                $this->load->helper('xls');
		query_to_xls($data['datatransaksi'], TRUE, 'Laporan Keuangan.xls');
                
                //$this->load->view('tu/v_cetak_xls', $data);
            } else {
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
                $config['base_url'] = base_url() . '/keuangan/laporan/';
                $total = $this->m_webmaster->Total_data("LAB_D_TRANSAKSI_LAB");
                $config['total_rows'] = $total->num_rows();
                $config['per_page'] = $limit;
                $config['uri_segment'] = 3;
                $config['first_link'] = 'Awal';
                $config['last_link'] = 'Akhir';
                $config['next_link'] = 'Selanjutnya';
                $config['prev_link'] = 'Sebelumnya';
                $this->pagination->initialize($config);
                $data['paginator'] = $this->pagination->create_links();
                $data['laporan'] = $this->m_webmaster->Ambil_laporan($offset, $bts);
                $data['title'] = "Manajemen Data Laporan Keuangan Surat Bebas Lab";
                $data['menu'] = "laporan";
                $data['opsi'] = "Semua ";
                $data['jml_uang'] = $this->m_webmaster->Jml_laporan();
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/v_laporan', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi pegawaikeuangan
    function pegawaikeuangan() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "updated") {

                redirect('keuangan/pegawaikeuangan/sukses');
            } else {
                $data['title'] = "Manajemen Data Pegawai Keuangan Lab";
                $data['menu'] = "pegawaikeuangan";
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['pegawai'] = $this->m_webmaster->get_pegawai_tu();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', $data, TRUE);
                $data['content'] = $this->load->view('tu/v_pegawai', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi tambah data pegawai keuangan
    function tambahpegawaikeuangan() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "proses") {
                $data2 = array();
                $data2['NO_PEG'] = $this->input->post('nama');
                $data2['KD_JABATAN'] = '21';

                $this->m_webmaster->Simpan_data('LAB_D_JABATAN_AKTIF', $data2);

                redirect('keuangan/pegawaikeuangan');
            } else {
                $data['title'] = "Tambah Data Pegawai Keuangan Lab";
                $data['menu'] = "pegawaikeuangan";
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['pegawai'] = $this->m_webmaster->Ambil_data("LAB_D_PEGAWAI_LAB");
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', $data, TRUE);
                $data['content'] = $this->load->view('tu/v_tambahpegawai', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //FUNGSI EDIT PEGAWAI Keuangan
    function editpegawaikeuangan() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "updated") {
                $id = $this->input->post('no');
                $status = $this->input->post('status');
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $this->m_webmaster->Update_status_pegawai_tu($status, $id);
                redirect('keuangan/pegawaikeuangan');
            } else {
                $data['jml_request'] = $this->m_webmaster->Total_bebas_lab_request();
                $data['menu'] = "pegawaikeuangan";
                $data['title'] = "Edit Status Data Pegawai Keuangan Lab";
                $data['edit'] = $this->m_webmaster->get_pegawai_tu_where($op);
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', '', TRUE);
                $data['content'] = $this->load->view('tu/v_editpegawai', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi hapus jabatan aktif pegawai keuangan
    function hapuspegawaikeuangan() {
        if ($this->cek_status()):
            $id = $this->uri->segment(3);
            $this->m_webmaster->Delete_data($id, "NO_JABATAN", "LAB_D_JABATAN_AKTIF");
            redirect('keuangan/pegawaikeuangan');
        else:
            redirect('login', 'refresh');
        endif;
    }

    //fungsi setting
    function setting() {
        if ($this->cek_status()):
            $op = $this->uri->segment(3);
            if ($op == "updated") {
                $id = $this->input->post('id');
                $jml = $this->input->post('harga');
                $this->m_webmaster->Update_biaya_lab($jml, $id);

                redirect('keuangan/setting/sukses');
            } elseif ($op == "sukses") {
                $data['title'] = "Manajemen Data Request Masuk Surat Bebas Lab";
                $data['menu'] = "setting";
                $data['warning'] = "Biaya Berhasil diuabah!";
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['biaya'] = $this->m_webmaster->biaya_lab();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', $data, TRUE);
                $data['content'] = $this->load->view('tu/v_setting', $data, TRUE);
                $this->load->view('tu/utama', $data);
            } else {

                $data['title'] = "Manajemen Data Request Masuk Surat Bebas Lab";
                $data['menu'] = "setting";
                $data['warning'] = "";
                $data['jml_request'] = $this->m_webmaster->Total_keuangan_request();
                $data['biaya'] = $this->m_webmaster->biaya_lab();
                $data['menu_utama'] = $this->load->view('tu/vmenu_utama', $data, TRUE);
                $data['content'] = $this->load->view('tu/v_setting', $data, TRUE);
                $this->load->view('tu/utama', $data);
            }
        else:
            redirect('login', 'refresh');
        endif;
    }

}