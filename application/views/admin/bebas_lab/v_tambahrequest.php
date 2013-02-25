<div class="text-section">
    <h1>Tambah Request Surat Bebas Lab</h1>
</div>
<div class="text-isi">
    <div id="form-container">
        <span style="color:red;"><?php echo $warning; ?></span>
        <?php
        $link = base_url() . "webmaster/tambah" . $menu . "/proses";
        echo form_open($link);
        ?>

        <fieldset>
            <form>
                <div class="field">
                    <label for="Name">NIM </label>
                    <input type="text" value="" id="nim" name="nim" />
                </div>

                <div class="field">
                    <input type="submit" value="Tambah" class="submit-button" />
                </div>

            </form>
        </fieldset>

        </form>
    </div>
</div>