<div class="text-section">
    <h1>Manajemen Data Pegawai</h1>
</div>
<div class="text-isi">
    <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
        <tr bgcolor="#D6F3FF" align="center">
            <th>No.</th>
            <th>NIP</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>TELP</th>
            <th colspan="2">AKSI</th>
        </tr>
        <?php
        $edit = base_url() . "webmaster/edit" . $menu;
        $hapus = base_url() . "webmaster/hapus" . $menu;
        $tambah = base_url() . "webmaster/tambah" . $menu;
        $no = $page + 1;
        foreach ($pegawai->result_array() as $pg) {
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $pg['NIP']; ?></td>
                <td><?php echo $pg['NM_PEG']; ?></td>
                <td><?php echo $pg['EMAIL']; ?></td>
                <td><?php echo $pg['TELP']; ?></td>
                <td align="center"><a href='<?php echo $edit . "/" . $pg['NO_PEG']; ?>' title='Edit Content'>
                        <img src='<?php echo base_url(); ?>assets/images/edit-icon.gif' border='0'></a></td>
                <td align="center">
                    <a href='<?php echo $hapus . "/" . $pg['NO_PEG']; ?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
                        <img src='<?php echo base_url(); ?>assets/images/hapus-icon.gif' border='0'></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table><br />
    <a href="<?php echo $tambah; ?>" class="button large teal">
        Tambah Data Pegawai</a>
    <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
</div>
