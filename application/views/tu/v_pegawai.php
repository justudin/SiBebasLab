<div class="text-section">
    <h1>Manajemen Data Pegawai Keuangan Laboratorium</h1>
</div>
<div class="text-isi">
    <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
        <tr bgcolor="#D6F3FF" align="center">
            <th>No.</th>
            <th>NAMA</th>
            <th>JABATAN</th>
            <th>STATUS</th>
            <th colspan="2">Aksi</th>
        </tr>
        <?php
        $edit = base_url() . "keuangan/edit" . $menu;
        $hapus = base_url() . "keuangan/hapus" . $menu;
        $tambah = base_url() . "keuangan/tambah" . $menu;
        $no =1;
        foreach ($pegawai->result_array() as $pg) {
            if($pg['STATUS']=="" or $pg['STATUS']=="0" ):
                $st='Tidak Aktif';
            else:
                $st='Aktif';
            endif;
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $pg['NM_PEG']; ?></td>
                <td align="center"><?php echo $pg['NM_JABATAN']; ?></td>
                <td align="center"><?php echo $st;?></td>
                <td align="center">
                    <a href='<?php echo $edit . "/" . $pg['NO_JABATAN']; ?>' title='Edit Content'>
                        <img src='<?php echo base_url(); ?>assets/images/edit-icon.gif' border='0'></a>
                </td>
                <td align="center">
                    <a href='<?php echo $hapus . "/" . $pg['NO_JABATAN']; ?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'>
                        <img src='<?php echo base_url(); ?>assets/images/hapus-icon.gif' border='0'></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table><br />
    <a href="<?php echo $tambah; ?>" class="button large teal">Tambah Data Pegawai Keuangan</a>
</div>	