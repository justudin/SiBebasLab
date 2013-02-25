<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="<?= base_url() ?>assets/css/template_sia.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/logo-uin.jpg"/> 
        <title>
            GodamKuSuKa
        </title>
        <style type="text/css"> 
            <!--
            .style1 {color: #CCCCCC}
            .item {color: #000}
            -->
        </style>
    </head>
    <body class=""> 
        <table width="1000"> 
            <tbody>
                <tr height="30"> 
                    <td class="contentheading style1" bgcolor="#008100"> 
                        <img src="<?php echo base_url(); ?>assets/images/uin.gif" width="90" /> Sistem Informasi Akademik UIN Sunan Kalijaga Yogyakarta
                    </td> 
                </tr> 
                <tr><td> 
                        <table width="100%" class="tab-page"> 
                            <tbody><tr valign="top"> 
                                    <td width="20%" class="contenttoc" bgcolor="#eeeeee"> 
                                        <table> 
                                            <tbody><tr><td class="contenttoc"> 
                                                        <div class="separator"> 

                                                            <?= $menu_utama ?>
                                                        </div> 
                                                    </td></tr>
                                            </tbody></table> 

                                    </td><td width="70%" align="Center"> 
                                        <?= $content ?> 
                                    </td> 
                                </tr> 
                            </tbody></table> 
                    </td></tr> 
            </tbody></table> 

    </body>
</html>