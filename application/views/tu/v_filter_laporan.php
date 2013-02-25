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
    <div id="form-container">


        <fieldset>
            <?php
            $link = base_url() . "keuangan/laporan/custom/cari";
            echo form_open($link);
            ?>

            <div class="field">
                <label for="Name">Tanggal Awal </label>
                <input type="text" value="" name="tgl_mulai"  class="tcal" title="yyyy-mm-dd"  id="tgl1"/>
            </div>
            <div class="field">
                <label for="Name">Tanggal Akhir </label>
                <input type="text" value="" name="tgl_akhir"  class="tcal" title="yyyy-mm-dd"  id="tgl2"/>
            </div>

            <div class="field">
                <input type="submit" value="Tampilkan Laporan" class="submit-button" />
            </div>

            </form>
        </fieldset>

        </form>
    </div>
</div>