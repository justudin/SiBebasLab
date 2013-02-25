<div class="text-section"> 
    <h1>Manajemen Data Histori Surat Bebas Lab</h1>
</div>
<div class="text-isi">
    <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
        <tr bgcolor="#D6F3FF" align="center">
            <th>No.</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>PRODI</th>
            <th>FAKULTAS</th>
            <th>TGL BAYAR</th>
            <th>JAM BAYAR</th>
            <th>TGL BEBAS</th>
             <th>JAM BEBAS</th>
        </tr>
        <?php
        $cetak = base_url() . "webmaster/cetak" . $menu;
        $hapus = base_url() . "webmaster/hapus" . $menu;
        $tambah = base_url() . "webmaster/tambah" . $menu;
        $no = $page + 1;
       
        if(count($request->result())>0){
        foreach ($request->result_array() as $rq) {
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td ><?php echo $rq['NIM']; ?></td>
                <td><?php echo $rq['NAMA']; ?></td>
                <td align="center"><?php echo $rq['NM_PRODI']; ?></td>
                <td align="center"><?php echo $rq['NM_FAK']; ?></td>
                <td align="center"><?php echo $rq['TGL_BAYAR']; ?></td>
                <td align="center"><?php echo $rq['JAM_BAYAR']; ?></td>
                <td align="center"><?php echo $rq['TGL_BEBAS']; ?></td>
                <td align="center"><?php echo $rq['JAM_BEBAS']; ?></td>

            </tr>
            <?php
            $no++;
        }
        } else {
            echo "<tr>
                <td colspan=9 align=center>DATA MASIH KOSONG</td>
                </tr>";
        }
        ?>
    </table><br />
    <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
</div>	