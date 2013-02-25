<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename = Data_Laporan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
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
    $no = 1;
    foreach ($datatransaksi->result_array() as $rq) {
        ?>
        <tr bgcolor='#fff'>
            <td align='center'><?php echo $no; ?></td>
            <td><?php echo $rq['NIM']; ?></td>
            <td><?php echo $rq['NAMA']; ?></td>
            <td><?php echo $rq['NM_PRODI']; ?></td>
            <td align="center"><?php echo $rq['TGL_BAYAR']; ?></td>
            <td align="center"><?php echo $rq['JUMLAH']; ?></td>

        </tr>
        <?php
        $total = $total + $rq['JUMLAH'];

        $no++;
    }
    ?>
</table>
<br/>
<?php
echo "Total Pemasukan : Rp " . number_format($total, 0, ',', '.')
?>