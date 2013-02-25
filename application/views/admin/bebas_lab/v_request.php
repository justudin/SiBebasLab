<div class="text-section"> 
    <h1>Manajemen Data Permintaan Surat Bebas Lab</h1>
</div>
<div class="text-isi">
    <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
        <tr bgcolor="#D6F3FF" align="center">
            <th>No.</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>PRODI</th>
            <th>TGL MASUK</th>
            <th colspan="2">AKSI</th>
        </tr>
        <?php
        $confirm = base_url() . "webmaster/confirm" . $menu;
        $hapus = base_url() . "webmaster/hapus" . $menu;
        $tambah = base_url() . "webmaster/tambah" . $menu;
        $no = $page + 1;
        foreach ($request->result_array() as $rq) {
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $rq['NIM']; ?></td>
                <td><?php echo $rq['NAMA']; ?></td>
                <td align="center"><?php echo $rq['NM_PRODI']; ?></td>
                <td align="center"><?php echo $rq['TGL_MASUK']; ?></td>
                <td align="center"><a href='<?php echo $confirm . "/" . $rq['NO_BEBAS_LAB']; ?>' title='Konfirmasi Disetujui untuk Mendapatkan Surat Bebas Lab'><img src='<?php echo base_url(); ?>assets/images/konfirmasi.gif' border='0' align="center">KONFIRMASI</a>
                </td>
                <td align="center">
                    <a href='<?php echo $hapus . "/" . $rq['NO_BEBAS_LAB']; ?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
                        <img src='<?php echo base_url(); ?>assets/images/hapus-icon.gif' border='0'></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table><br />
    <a href="<?php echo $tambah; ?>" class="button large teal">Tambah Permintaan Surat Bebas Lab</a>
    <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
</div>	