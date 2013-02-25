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
            <th colspan="1">AKSI</th>
        </tr>
        <?php
        $confirm = base_url() . "keuangan/confirm" . $menu;
        $hapus = base_url() . "keuangan/hapus" . $menu;
        $no = $page + 1;
        foreach ($request->result_array() as $rq) {
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $rq['NIM']; ?></td>
                <td><?php echo $rq['NAMA']; ?></td>
                <td align="center"><?php echo $rq['NM_PRODI']; ?></td>
                <td align="center"><?php echo $rq['TGL_MASUK']; ?></td>
                <td align="center"><a href='<?php echo $confirm . "/" . $rq['NO_BEBAS_LAB']; ?>' title='Pembayaran Surat Bebas Lab' target="_new"><img src='<?php echo base_url(); ?>assets/images/bayar.png' border='0'></a>
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </table><br />
    <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
</div>	