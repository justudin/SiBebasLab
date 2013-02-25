<div class="text-section"> 
    <h1>Manajemen Surat Bebas Lab yang Di Verifikasi</h1>
</div>

<div class="text-isi">
    <form method="post" action="<?php echo base_url() . "webmaster/verifikasi/simpan"; ?>" name="bebaslab">
        <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1" class="listview">
            <tr bgcolor="#D6F3FF" align="center">
                <th>No.</th>
                <th>NIM</th>
                <th>NAMA</th>
                <th>PRODI</th>
                <th>FAKULTAS</th>
                <th>TGL BAYAR</th>
                <th>JAM BAYAR</th>
                <th>BEBAS LAB</th>
            </tr>
            <?php
            $confirm = base_url() . "webmaster/verifikasi" . $menu;
            $no = $page + 1;
            if (count($cetak->result()) > 0) {
                foreach ($cetak->result_array() as $rq) {
                    ?>
                    <tr bgcolor='#fff'>
                        <td align='center'><?php echo $no; ?></td>
                        <input name="nim[]" type="hidden" value="<?php echo $rq['NIM']; ?>" />
                        <td><?php echo $rq['NIM']; ?></td>
                        <td><?php echo $rq['NAMA']; ?></td>
                        <td align="center"><?php echo $rq['NM_PRODI']; ?></td>
                        <td align="center"><?php echo $rq['NM_FAK']; ?></td>
                        <td align="center"><?php echo $rq['TGL_BAYAR']; ?></td>
                        <td align="center"><?php echo $rq['JAM_BAYAR']; ?></td>
                        <td align="center"><input name="optbebas[]" type="checkbox" value="<?php echo $rq['NO_BEBAS_LAB']; ?>" />
                            
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                echo "</table>
                <br />
        <input type='submit' value='Simpan' name='simpan' class='submit-button'>
        </form>";
            } else {
                echo "<tr>
                <td colspan=8 align=center>DATA MASIH KOSONG</td>
                </tr>
                </table>
                </form>";
            }
            ?>


            <br/>
            <div class="pagination"><ul><center><?php echo $paginator; ?></center></ul></div>
            </div>	