<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class M_mhs extends CI_Model {

    //fungsi untuk login
    function login($data) {
        $user = $data['ID_USER'];
        $pass = $data['PASSWORD'];
        $query = $this->db->query("select a.id_user,a.password,a.id_akses,b.kd_prodi,b.nim,b.nama, c.NM_PRODI, c.KD_JURUSAN from d_user_portal a,d_mahasiswa b,MASTER_PRODI c
                                 where a.ID_USER=b.NIM and a.ID_USER= UPPER ('$user') and a.PASSWORD = UPPER ('$pass') and b.KD_PRODI=c.KD_PRODI");

        if ($query->num_rows > 0) {
            $row = $query->row();
            $data['ID_USER'] = $row->ID_USER;
            $data['KD_PRODI'] = $row->KD_PRODI;
            $data['NAMA'] = $row->NAMA;
            $data['NM_PRODI'] = $row->NM_PRODI;
            $data['ID_AKSES'] = $row->ID_AKSES;
            return $data;
        }
        else
            return false;
    }

    //fungsi get data bebas lab
    function get_bebas_lab($nim) {
        $q = $this->db->query("SELECT a.NIM, a.NAMA, b.NO_BEBAS_LAB, TO_CHAR(b.TGL_MASUK,'DD MONTH YYYY') AS TGL_MASUK, TO_CHAR(b.TGL_CETAK,'DD MONTH YYYY') AS TGL_CETAK, b.STATUS, c.NM_PRODI, CATATAN FROM D_MAHASISWA a, LAB_D_BEBAS_LAB b, MASTER_PRODI c where a.KD_PRODI=c.KD_PRODI and b.NIM=a.NIM and b.NIM='$nim'");
        return $q;
    }

    //fungsi permintaan surat bebas lab
    function Input_bebas_lab($nim) {
        $q = $this->db->query("insert into LAB_D_BEBAS_LAB(NIM,TGL_MASUK,STATUS,CETAK,BAYAR) values ('$nim',sysdate,'0','N','BELUM')");
        return $q;
    }

    //cek apakah sudah lulus apa belum?
    //
        function cek_lulus($nim) {
        $q = $this->db->query("SELECT * FROM D_ALUMNI WHERE NIM='$nim'");
        return $q;
    }

    //cek jumlah sks
    function cek_sks($nim) {
        $q = $this->db->query("select sum(SKS) as JUM_SKS from D_TRANSKRIP WHERE NIM='$nim'");
        return $q;
    }

    //cek sudah ngambil TA apa blm
    function cek_ta($nim) {
        $q = $this->db->query("SELECT A.KD_MK, B.NM_MK , B.NM_MK_SINGKAT
                                FROM D_TRANSKRIP_HISTORI A
                                INNER JOIN MD_MATAKULIAH_KUR_PRODI B
                                ON A.KD_MK=B.KD_MK
                                WHERE A.NIM='$nim' AND
                                A.KD_MK IN (
                                SELECT A.KD_MK
                                FROM MD_MATAKULIAH_KUR_PRODI A
                                INNER JOIN MASTER_PRODI B
                                ON A.KD_PRODI=B.KD_PRODI
                                WHERE UPPER(NM_MK_SINGKAT) LIKE '%SKRIP%' OR
                                UPPER(NM_MK)='TUGAS AKHIR'
                                )");
        return $q;
    }

    //fungsi simpan Data
    function Simpan_data($tabel, $data) {
        $s = $this->db->insert($tabel, $data);
        return $s;
    }

}

/*End of m_mhs.php*/