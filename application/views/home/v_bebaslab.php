<?php
if ($cek_ta->num_rows>0):
    if ($databebaslab->num_rows > 0):
        ?>
        <p>Anda Sudah Mengirimkan Permintaan Surat Bebas Lab, dengan data sebagai berikut :<br/>
        <table width="100%" bgcolor="#ccc" cellpadding="2" cellspacing="1.5" class="listview">
            <tbody><tr bgcolor="#009900" align="center" class="style1">
                    <th>No Bebas Lab</th>
                    <th>NIM</th>
                    <th>NAMA</th>
                    <th>PRODI</th>
                    <th>STATUS</th>


                </tr>
                <?php
                foreach ($databebaslab->result_array() as $dbl) {
                    if ($dbl['STATUS'] == 0):
                        $st = "Menunggu Konfirmasi";
                    elseif ($dbl['STATUS'] == 1):
                        $st = "Sudah Diproses";
                    endif;
                    ?>
                    <tr bgcolor="#fff">
                        <td align="center"><?php echo $dbl['NO_BEBAS_LAB'] ?></td>
                        <td><?php echo $dbl['NIM'] ?></td>
                        <td><?php echo $dbl['NAMA'] ?></td>
                        <td align="center"><?php echo $dbl['NM_PRODI'] ?></td>
                        <td align="center"><?php echo $st ?></td>

                    </tr>
                    <?php
                }
                ?>  
            </tbody></table>
        <?php
        if ($lulus->num_rows == 0 && $dbl['STATUS'] != 0):
            ?>
            <p>Jika Anda Lupa / Surat Hilang silahkan mengirimkan permintaan lagi :</p>
            <?php
            $link = base_url() . "mhs/suratbebaslab/permintaan";
            echo form_open($link);
            ?>

            <input type="submit" name="tombolbebaslab" value="Kirim Permintaan Surat Bebas Lab" />
            </form>
            <?php
        endif;
        ?>
        <br/>
        <b>NB / Alur Pengurusah Surat Bebas Lab</b> : <br/>
        <ul>
            <li>- Silahkan langsung menuju Bagian Keuangan Laboratorium Terpadu guna membayar uang administrasi.</li>
            <li>- Setelah melakukan pembayaran di bagian keuangan, Anda akan mendapatkan bukti pembayaran.</li>
            <li>- Lakukan pencetakn surat di bagian Admin Lab yang berada di lantai 1 sebelah kiri dekat pintu masuk Lab</li>
            <li>- Setalah itu silahkan tunggu 2-3 Hari dan Surat bisa diambil di bagian Admin Laboratorium Terpadu</li>

        </ul>
        </p>

        <?php
    else:
        ?>
        <p>Silahkan Klik tombol berikut untuk Mengirimkan Permintaan Surat Bebas Lab :</p>
        <?php
        $link = base_url() . "mhs/suratbebaslab/permintaan";
        echo form_open($link);
        ?>

        <input type="submit" name="tombolbebaslab" value="Kirim Permintaan Surat Bebas Lab" />
        </form>
    <?php
    endif;
endif;
?>