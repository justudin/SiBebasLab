<div class="text-section">
    <h1>EDIT Status Pegawai Keuangan Laboratorium</h1>
</div>
<div class="text-isi">
    <div id="form-container">
        <span style="color:red;"><?php echo validation_errors(); ?></span>
        <?php
        foreach ($edit->result_array as $ed) {
            
        }
        $link = base_url() . "keuangan/edit" . $menu . "/updated";
        echo form_open($link);
        ?>
        <table width="100%"> 
            <tr>
                <td>Nama Lengkap<br/>
                    <input type="text" name="nama" value="<?php echo $ed['NM_PEG'] ?>" size="40" readonly />
                    <input type="hidden" name="no" value="<?php echo $ed['NO_JABATAN'] ?>" size="40" />
                </td>
            </tr>
            <tr>
                <td>Status<br/>
                    <select name="status">
                         <option>--Pilih Status--</option>
                        <option name='status' value='1'>Aktif</option>
                        <option name='status' value='0'>Tidak Aktif</option>
                    </select>
                </td>
            </tr>

            <tr height="30px">
                <td><input type="submit" value="Update Data" name="simpan" class="submit-button"/></td>
            </tr>
        </table>
        </form>
    </div>
</div>