<br> 
<?php
if ($this->session->userdata("id_akses") == 1):
    ?>
    Login<br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=gantipassword">Ganti Password</a> <br> 
    <a href="<?php echo base_url() . "mhs/logout" ?>">Logout</a> <br> 
    <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=krs">Input KRS</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=khs">KHS Semester</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=khskum">KHS Kumulatif</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=ip">Sejarah IP</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=kuliahmhs">Jadwal Kuliah</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=ujianmhs">Jadwal Ujian</a> <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp?menu=absenmhs">Presensi Mahasiswa</a>  <br> 
    <br> 
    <?php
    
    if ($cek_ta->num_rows >0):
        ?>
        <a href="<?php echo base_url() . 'mhs/suratbebaslab'; ?>">Permohonan Surat Bebas LAB</a> <br>

        <?php
    else:
        echo "Permohonan Surat Bebas LAB<br>";
    endif;
    ?>
    <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp">Home</a><br> 
    <br> 
    <br>

    </br>
    <?php
else:
    ?>
    <a href="<?php echo base_url(); ?>">Login</a><br> 
    Ganti Password <br> 
    Logout <br/>
    Input KRS <br> 
    <br> 
    KHS Semester <br> 
    KHS Kumulatif <br> 
    Sejarah IP <br> 
    Jadwal Kuliah <br> 
    Jadwal Ujian <br> 
    Presensi Mahasiswa<br> 
    <br> 

    Jadwal Kuliah Dosen<br> 
    Presensi Kuliah Dosen <br> 
    <br/>
    Permohonan Surat Bebas Lab
    <br> 
    <br> 
    <a href="http://sia.uin-suka.ac.id/st/index.asp">Home</a><br> 
    <br> 
    <br>
<?php
endif;
?>