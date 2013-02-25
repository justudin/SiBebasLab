<div class="text-section">
    <h1>Tambah Pegawai Keuangan Laboratorium</h1>
</div>
<div class="text-isi">
    <div id="form-container">
        <span style="color:red;"><?php echo validation_errors(); ?></span>
        <?php
        $link = base_url() . "keuangan/tambah" . $menu . "/proses";
        echo form_open($link);
        ?>

        <table width="100%" height="130px"> 
            <tr>
                <td>Pilih Nama Pegawai<br/>
                    <select name="nama">
                        <option>--Pilih Nama Pegawai--</option>
                        <?php
                        foreach ($pegawai->result_array() as $pg) {
                            echo "<option name='nama' value='$pg[NO_PEG]'>" . $pg['NM_PEG'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Simpan Data" name="simpan" class="submit-button"  /></td>
            </tr>
        </table>
        </form>
    </div>
</div>