<div class="text-section">
    <h1>EDIT Data Pegawai Laboratorium</h1>
</div>
<div class="text-isi">
    <div id="form-container">
        <span style="color:red;"><?php echo validation_errors(); ?></span>
        <?php
        foreach ($edit->result_array as $ed) {
            
        }
        $link = base_url() . "webmaster/edit" . $menu . "/updated";
        echo form_open($link);
        ?>
        <table width="100%"> 
            <tr>
                <td>NIP<br/>
                    <input type="text" name="nip" value="<?php echo $ed['NIP'] ?>" size="40" />
                    <input type="hidden" name="nopeg" value="<?php echo $ed['NO_PEG'] ?>"  size="40" />
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap<br/>
                    <input type="text" name="nama" value="<?php echo $ed['NM_PEG'] ?>" size="40" />
                </td>
            </tr>
            <tr>
                <td>Tempat Lahir<br/>
                    <input type="text" name="tmp_lahir" value="<?php echo $ed['TMP_LAHIR'] ?>" size="40" />
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir (HHBBTT - misal : 130290)<br/>
                    <input type="text" name="tgl_lahir" value="<?php echo $ed['TGL'] ?>" size="6" />
                </td>
            </tr>
            <tr>
                <td>No Telp<br/>
                    <input type="text" name="telp" value="<?php echo $ed['TELP'] ?>"  size="40" />
                </td>
            </tr>
            <tr>
                <td>Alamat<br/>
                    <input type="text" name="alamat" value="<?php echo $ed['ALAMAT'] ?>"  size="40" />
                </td>
            </tr>
            <tr>
                <td>Email<br/>
                    <input type="text" name="email" value="<?php echo $ed['EMAIL'] ?>" size="40" />
                </td>
            </tr>

            <tr height="30px">
                <td><input type="submit" value="Update Data" name="simpan" class="submit-button"/></td>
            </tr>
        </table>
        </form>
    </div>
</div>