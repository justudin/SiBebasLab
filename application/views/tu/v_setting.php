<div class="text-section">
    <h1>Setting</h1>
    <p>Setting Biaya Pembuatan Surat Bebas Lab</p>
</div>
<div class="text-isi">
    <div id="form-container">
        <?php
        foreach ($biaya->result_array() as $st) {
            
        }
        $link = base_url() . "keuangan/setting/updated";
        echo form_open($link);
        ?>
        <span style="color:red;"><?php echo $warning; ?></span>
        <div class="field">
            <label>Biaya</label>
            <input type="hidden" name="id" value="<?php echo $st['NO_BIAYA'] ?>"/>
            <input type="text" name="harga" size="30" value="<?php echo $st['JUMLAH'] ?>"/>
        </div>
        <div class="field">
            <input type="submit" name="ubah" value="Update" class="submit-button" />
        </div>
        </form>
    </div>
</div>
