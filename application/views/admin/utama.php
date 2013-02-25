<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/lab-uin.png"/> 
    <title>
        <?php
        echo $title . "- Halaman Admin Panel Sistem Bebas Lab";
        ?>
    </title>
    <link media="all" rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/all.css" />
    <link media="all" rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/tcal.css" />
    <link href="<?php echo base_url() ?>assets/css/backoff.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript">window.jQuery || document.write('<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.7.2.min.js"><\/script>');</script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.main.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/tcal.js"></script>
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ie.css" /><![endif]-->

</head>
<body onload="autorefresh('<?php echo base_url() ?>webmaster/home')">
    <?php
    if ($this->session->userdata('id_user') and $this->session->userdata('status_login') == 2):
        ?>
        <div id="wrapper">
            <div id="content">
                <div class="c1">
                    <div class="controls" id="control">
                        <nav class="links">
                            <ul>

                                <li><a href="<?php echo base_url(); ?>webmaster" class="home">Home</a></li>
                                <li><a href="<?php echo base_url(); ?>webmaster/pegawai" class="pegawai">Data Pegawai</a></li>
                                <li><a href="<?php echo base_url(); ?>webmaster/jabatanaktifpegawai" class="pegawaiaktif">Jabatan Pegawai</a></li>

                             
                                <li><a href="<?php echo base_url(); ?>webmaster/verifikasi" class="ico3">Verifikasi Surat Bebas Lab
                                       <?php
                                        if ($jml_request->num_rows() > 0):
                                            echo "<span class='num'>$jml_request->num_rows</span>";
                                        endif;
                                        ?>
                                    </a></li>
                                <li><a href="<?php echo base_url(); ?>webmaster/history" class="history">Telah Bebas LAB</a></li>
                            </ul>
                        </nav>
                        <div class="profile-box">
                            <span class="profile">
                                <div class="section">
                                    <img class="image" src="<?php echo base_url() ?>assets/images/img1.png" alt="image description" width="26" height="26" />
                                    <span class="text-box">

                                        <strong class="name"><?php echo $this->session->userdata("id_user"); ?></strong>
                                        <?php
                                        if ($this->session->userdata("status_login") == 2) {
                                            echo "( Admin Lab )";
                                        } elseif ($this->session->userdata("status_login") == 1)
                                            echo "( Pegawai )";
                                        ?>
                                    </span>
                                </div>

                            </span>
                            <a href="<?php echo base_url() ?>webmaster/logout" class="btn-on" alt="Logout/keluar dari Sistem" tooltip="Logout/keluar dari Sistem">On</a>
                        </div>
                    </div>
                    <div class="tabs">
                        <div class="tab">

                            <article>
                                <!-- isi konten !-->
                                <?php echo $content ?>       

                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu Sidebar !-->
            <?php echo $menu_utama ?>
        </div>
        <?php
    endif;
    ?>
</body>
</html>