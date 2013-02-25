<div class="text-section">
    <h1>Tambah Pegawai Laboratorium</h1>
</div>
<div class="text-isi">
    <div id="form-container">
        <span style="color:red;"><?php echo validation_errors(); ?></span>
        <?php
        $link = base_url() . "webmaster/tambah" . $menu . "/proses";
        echo form_open($link);
        ?>

        <table width="100%"> 
            <tr>
                <td>NIP<br/>
                    <input type="text" name="nip" size="40" />
                </td>
            </tr>
            <tr>
                <td>Nama Lengkap<br/>
                    <input type="text" name="nama" size="40" />
                </td>
            </tr>
            <tr>
                <td>Tempat Lahir<br/>
                    <input type="text" name="tmp_lahir" size="40" />
                </td>
            </tr>
            <tr>
                <td>Tanggal Lahir (HHBBTT - misal : 130290)<br/>
                    <input type="text" name="tgl_lahir" size="6" />
                </td>
            </tr>
            <tr>
                <td>No Telp<br/>
                    <input type="text" name="telp" size="40" />
                </td>
            </tr>
            <tr>
                <td>Alamat<br/>
                    <input type="text" name="alamat" size="40" />
                </td>
            </tr>
            <tr>
                <td>Email<br/>
                    <input type="text" name="email" size="40" />
                </td>
            </tr>

            <tr>
                <td><input type="submit" value="Simpan Data" name="simpan" class="submit-button" /></td>
            </tr>
        </table>
        </form>
    </div>
</div>