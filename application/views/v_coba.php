<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
        <title>Login Panel Administrator Sistem Bebas Lab</title> 
    
    </head> 
    <body> 
        <table width="80%">
            <tr>
                <td>NIM</td>
                <td>NAMA</td>
            </tr>
            <?php
            $jum = 0;
            $jum2 = 0;
            foreach ($dtbebaslab->result_array() as $dbs) {
                $tmp[] = $dbs['NIM'];
                $jum++;
            }
            foreach ($dtmhs->result_array() as $dt) {
                $tmp2[] = $dt['NIM'];
                $jum2++;
            }

            for($i=0;$i<=$jum;$i++){
                for($j=0;$j<=$jum2;$j++){
                    echo $tmp[$i]." ".$tmp2[$j]."<br />";
                }
            }

            /*$no1=1;
            $jml1=count($dtbebaslab->result());
            foreach ($dtbebaslab->result_array() as $dbs) {
                   $nim[$no1]=$dbs['NIM'];
                   $no1++;
            }
            $no2=1;
            $jml2=count($dtmhs->result());
            
            foreach ($dtmhs->result_array() as $dt) {
                $nim2[$no2]=$dt['NIM'];
                $nama2[$no2]=$dt['NAMA'];
                $no2++;
            }
             * */
            
            //perulangan data dari server
            /*for ($i = 1; $i <= $jml2; $i++) {
                for($j=1; $j <= $jml1; $j++){
                    if( $nim[$j] != $nim2[$i]){
                       
                    } else return false;
                    
                }
                echo $nim2[$i]."<br/>";
            }
            */
            ?>
        </table>
    </body> 
</html> 