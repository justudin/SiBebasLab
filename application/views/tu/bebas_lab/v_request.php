
<div class="text-section">
    <h1>Request Surat Bebas Lab</h1>
</div>
<div class="text-isi">
    <div id="form-container">

        <?php
        $link = base_url() . "keuangan/tambahrequest/proses";
        echo form_open($link);
        ?>

        <fieldset>
            <form>
                <div class="field">
                    <label for="Name">NIM </label>
                    <input type="text" value="" id="nim" name="nim" />
                </div>

                <div class="field">
                    <input type="submit" value="OK" class="submit-button" />
                </div>

            </form>
        </fieldset>
        <?php
        if ($warning == "sukses"):
            foreach ($datadiri->result_array() as $dd) {
                $link1 = base_url() . "keuangan/cetakall";
                //$link2 = base_url() . "keuangan/cetakbebaslab";
                echo "
                
                <table width='80%'>
                    <tr>
                        <td>NIM</td>
                        <td>: $dd[NIM] 
                            <input type='hidden' value='$dd[NIM]' name='nim' /></td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>: $dd[NAMA]</td>
                    </tr>
                    <tr>
                        <td>PRODI</td>
                        <td>: $dd[NM_PRODI]</td>
                    </tr>
                    <tr>
                        <td>FAKULTAS</td>
                        <td>: $dd[NM_FAK]</td>
                    </tr>
                    </table>";
                $key="l4b5!st3m";
                $dec=$dd['NIM']."+".$key;
                $nim=base64_encode($dec);
                ?>
                    <br/>
                    <a onclick="window.open('<?php echo $link1."/".$nim;?>');" target="_blank">
                        <input type='button' name='cetak' value='CETAK' class='submit-button'/> </a>
                   
              
             <?php
            }
        else:
            echo "<span style='color:red;'>$warning</span>";
        endif;
        ?>

        </form>
    </div>
</div>