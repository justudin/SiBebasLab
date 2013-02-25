<div class="text-section">
    <h1>Laporan Keuangan</h1>
    <p>Ini adalah halaman laporan keuangan
    </p>
</div>
<div class="text-isi">
    <p>Pilih Laporan Keuangan berdasarkan: 
        <a href="<?php echo base_url() . "keuangan/laporan" ?>"  class="button teal large">Semua</a>
        <a href="<?php echo base_url() . "keuangan/laporan/hariini" ?>"  class="button teal large">Hari ini</a>
        <a href="<?php echo base_url() . "keuangan/laporan/bulanini" ?>"  class="button teal large">Bulan ini</a>
        <a href="<?php echo base_url() . "keuangan/laporan/custom" ?>"  class="button teal large">Filter Lain</a>
    </p>
    <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
        <tr bgcolor="#D6F3FF" align="center">
            <th>No.</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>PRODI</th>
            <th>TGL BAYAR</th>
            <th>JUMLAH</th>

        </tr>
        <?php
        $total = 0;
        $no = $page + 1;
        if (count($laporan->result()) > 0) {
        foreach ($laporan->result_array() as $rq) {
            ?>
            <tr bgcolor='#fff'>
                <td align='center'><?php echo $no; ?></td>
                <td><?php echo $rq['NIM']; ?></td>
                <td><?php echo $rq['NAMA']; ?></td>
                <td><?php echo $rq['NM_PRODI']; ?></td>
                <td align="center"><?php echo $rq['TGL_BAYAR']; ?></td>
                <td align="right"><?php echo number_format($rq['JUMLAH'],0,',','.').",-"; ?></td>

            </tr>
            <?php
            $no++;
        }
        }else{
            echo "<tr>
                <td colspan=6 align=center>DATA MASIH KOSONG</td>
                </tr>";
        }
            $link="";
         $op = $this->uri->segment(3);
         if($op=='custom'){
             $link="/".$tgl1."/".$tgl2;
         }
         
        ?>
    </table>
    <br/>
    <a href="<?php echo base_url() . "keuangan/laporan/cetak_xls/" . $op.$link ?>" target="_new" class="button teal large">Cetak XLS</a>
    <a href="<?php echo base_url() . "keuangan/laporan/cetak_pdf/" . $op.$link ?>" target="_new" class="button teal large">Cetak Pdf</a>
    <?php
    foreach ($jml_uang->result() as $jml) {
        $total = $jml->TOTAL;
    }
    echo "Total Pemasukan " . $opsi . " : Rp " . number_format($total, 0, ',', '.').",-";
    ?>
    <br />
    <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
    
</div>	