<?php session_start();
require_once 'customer/library/customer.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">


    <?php
    include './php_includes/db.php';
    include './php_includes/language.php';

    ?>
    <head>
        <?php include './php_includes/head.php'; ?>
    
        

    </head>

    <body style="background: #E9E9E9; " onload="onPageLoad();" onunload="onPageUnload();">
        <div id="body_content">
            
            <?php include './php_includes/main_menu.php'; ?>

            <!-- HOME MENU BANNER --> 
            <div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
                <img src="images/Banner_1_Page1" 
                     style="height: 58px; width: 1000px; margin-left: 12px; "  />
            </div> 

            <!-- EOSKATES LOGO -->
            <img src="images/EOSkate_Logo.png" usemap="#map_home_logo" style=" position: absolute; height: 28px; width: 136px; margin-left: 18px; margin-top: 20px; z-index: 1;" />
            <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 136, 28" /></map>

            
<!-- ####### TEAM ######### -->


						<div id="body_content" style=" width: 1003px; height: 400px; left: 12px; position: absolute; top: 80px;  ">

<table border="0"  width="100%" cellpadding="0" cellspacing="12" >

	<tr>
		<td align="center" colspan=3 ><font size="4">Offical Partners</font></td>
	</tr>
	<tr align="center">
		<td width="33%">
			<a href="http://www.rollerenligne.com" target="_blank" >
				<img src="Team/REL_FR_9x5_flag.jpg" height="60" />
			</a>
		</td>
		<td width="33%">
			<a href="http://www.interflon.com/fr" target="_blank" >
				<img src="Team/Interflon_9x5.jpg" height="80" />
			</a>
		</td>
		<td width="33%">
			<a href="http://solutions-resto.com/" target="_blank" >
				<img src="Team/SR_B_logo_Coul_HD.png" height="60" />
			</a>
		
		</td>
	</tr>
	<tr align="center" valign="bottom">
		<td>
			<a href="http://www.cuncu-customboots.com" target="_blank" >
				<img src="Team/cuncu.png" height="60" />
			</a>
		</td>
		<td>
			<a href="http://www.eoskates.com/" target="_blank" >
				<img src="Team/ninja-bearings.png" height="40" />
			</a>
		</td>
		<td>
			<a href="http://http://worknmeet.com/" target="_blank" >
				<img src="Team/WnM-logo_fond_blanc.jpg" height="60" />
			</a>
		</td>
	</tr>
<!--	
	
	<tr align="center" valign="bottom">
		<td>
			<a href="http://kp-ing.com/" target="_blank" >
				<img src="Team/Logo_K_und_P_narrow.jpeg" height="50" />
			</a>
		</td>
		<td>
			<a href="http://www.maptaq.com/" target="_blank" >
				<img src="Team/maptaq.png" height="40" />
			</a>
		</td>
		<td>
			
		</td>
	</tr>
-->	

	<tr align="center" valign="bottom">
		<td >
			<a href="http://www.eoskates.com/" target="_blank" >
				<img src="Team/logo_luigino_horizontal_big.png" height="55" />
			</a>

		</td>
		<td>
			</br>
			<font size="5" color="FF0000">EO</font><font size="5" >SKATES </br>World Team</font>
		</td>
		<td>
			<a href="http://www.eoskates.com/" target="_blank" >
				<img src="Team/logo_atom_big.jpg" height="50" />
			</a>
		</td>
	</tr>	
	
</table>	
<br>
</div>
	
<div id="body_content" style=" width: 1003px; left: 12px; position: absolute; top: 470px;  ">



<table width="100%" cellpadding="0" cellspacing="2">	


<!--	<tr align="center" height=50px valign=center><td><font size="5">World Team 2013</font></td></tr>
-->	
	<tr align="center" ><td><img src="Team/Team_2013_2.jpg" width="800" /></td></tr>
	<tr align="center" height=30px><td></td></tr>
	<tr align="center" ><td><img src="Team/Team_2013.jpg" width="800" /></td></tr>
	
	<!-- Trombinoscope 

	
	<tr border="1" align="center">
		<td  align="center" colspan=4 ><font size="5">Athletes</font></td>
	</tr>
	<tr align="center">
		<td width="50%" align="center" colspan=2 ><font size="4">&nbsp;</font></td>
		<td align="center" colspan=2 ><font size="4">&nbsp;</font></td>
	</tr>
	
	<tr align="center">
		<td width="25%" align="center">
			<img src="Team/Yann.jpg" width="180" />
            <br>
			Yann Guyader	
		</td>
		<td width="25%" align="center">
			<img src="Team/Julien.jpg" width="180" />
            <br>
            Julien Levrard
        </td>
		<td width="25%" align="center">
			<img src="Team/Jana.jpg" width="180" />
            <br>
            Jana Gegner 
		</td>
		<td align="center">Justine</td>
	</tr>
	<tr align="center">
		<td align="center">
			<img src="Team/Elio.jpg" width="180" />
            <br>
            Elio Cuncu
        </td>
		<td align="center">
			<img src="Team/Giacomo.jpg" width="180" />
            <br>
            Giacomo Cuncu
        </td>
		<td width="25%" align="center">
			<img src="Team/Roberta.jpg" width="180" />
            <br>
            Roberta Casu
            </td>
		<td align="center">Juilette</td>
	</tr>
	<tr align="center">
		<td align="center">Nolan</td>
		<td align="center">
			<img src="Team/Victor.jpg" width="180" />
            <br>
            Victor Wilking
        </td>
		<td align="center">
			<img src="Team/Jessica.jpg" width="180" />
            <br>
            Jessica Gaudesaboos
        </td>
		<td align="center">Renata</td>
	</tr>
	<tr align="center">
		<td align="center">NIcolas</td>
		<td align="center">Tim</td>

	</tr>
-->
		
</table>

</div>                     
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:1800px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
