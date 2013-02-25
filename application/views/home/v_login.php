<br><br><br><br><br>
<table class="sectiontableentry1"> 
    <tbody>
        <tr> 

        </tr> 
        <tr> 
    <h3><?php echo $warning; ?></h3>
    <td width="15%"></td> 
    <td width="30%"> 
        <div align="center"> 
            <?php
            $link = base_url() . "mhs/ceklogin/proses";
            echo form_open($link);
            ?>

            <pre>User ID   <input name="user" type="text" class="inputbox" size="15"> 
Password  <input type="password" name="password" size="15" class="inputbox"> 
            </pre> 
            <input type="hidden" name="kode" value="login"> 
            <input name="login" type="SUBMIT" class="button" style="width: 70" class="item" value="LOGIN"> 
            <input type="reset" value="CANCEL" class="button" name="Batal" class="item" style="width: 70"> 
            </form>

        </div> 
    </td> 
</tr> 
</tbody></table> 

