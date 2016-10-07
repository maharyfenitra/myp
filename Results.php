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

            

<!-- ######### MAIN PANEL #################################### --> 
            
            <!-- Results Container -->
          
            <div id="body_content" style=" background-image:url(images/background3.png); width: 1000px;  height: 4000px; left: 12px; position: absolute; top: 75px; z-index: 1;overflow:visible; ">
            	
            	<p style=" z-index: 1; margin-top: 30px; font-size: 40px; font-family: arial; margin-left: 240px;color: rgb(96, 95, 95);"> All 2012 Races and Results</p>
            	<table border="1"  cellspacing="5" cellpadding="10" id="tableEvent">
            		<colgroup>
            			<col style="background: rgb(247,247,247);" width="2%"  heigth="5%"/>
            			<col width="4%"/>
            			<col width="10%"/>
            		</colgroup>

            		<tr class="toprow">
            			<th>Date</th>
            			<th>Race</th>
            			<th>Results</th>
            		
            		</tr>
            		
            		<tr>
            			<td>Apr 1st</td>
            			<td>
	            			<p>Berlin Half-Marathon<BR>(German Inline Cup)
            			</td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
       	     					Girls <strong>Victory </strong>
						<br>- 1st      :<strong> Cecilia Baena</strong>
						<br>- 3rd     : Jana Gegner 
						<br>- 4th     : Paola Serrano
						<br>
						<p>Boys: 
						<br>- 2nd  : Yann Guyader
						<br>- 5th     : Fabio Francolini
					</td><td style="border: 0px;" width="280px" align="center">
						<img src="Team/Chechy.jpg" width="154">
					</td></tr></table>
            			</td>
            		</tr>
            		
            		<tr>
                                <td>Apr 9th</td>
                                <td>
                                        <p>Trop&eacute;e international<BR>des 3 Pistes (France)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>Victory </strong>
                                                <br>- 1st      :<strong> Cecilia Baena</strong>
                                                <br>- 3rd     : Paola Serrano 
                                                <br>
                                                <p>Boys  <strong>Victory </strong>
                                                <br>- 1st     :<strong> Yann Guyader</strong>
                                                <br>- 2nd     : Fabio Francolini
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Yann.jpg" width="154">
                                        </td></tr></table>
                                </td>
            		</tr>
            		
            		<tr>
                                <td>May 1st</td>
                                <td>
                                        <p>Frankfurt Marathon<BR>(German Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls 
                                                <br>- 3rd     : Jana Gegner 
                                                <br>
                                                <p>Boys  
                                                <br>- 4th     : Yann Guyader
                                                <br>- 5th     : Fabio Francolini
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Jana.jpg" width="154">
                                        </td></tr></table>
                                </td>
            		</tr>
            		
            		<tr>
         	                <td>May 13th</td>
                                <td>
                                        <p>Rennes Marathon (F)<BR>(World Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>Victory </strong>
                                                <br>- 1st     : <strong>Jana Gegner</strong>
                                                <br>- 2nd     : Roberta Casu 
                                                <br>
                                                <p>Boys <strong>Victory </strong>
                                                <br>- 1st     : <strong>Yann Guyader</strong>
                                                <br>- 6th     : Giacomo Cuncu 
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Jana.jpg" width="154">
                                        </td></tr></table>
                                </td>
            		</tr>
            		
            		<tr>
                                <td>May 20th</td>
                                <td>
                                        <p>Incheon Marathon (KOR)<BR>(World Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                <p>Boys <strong>Victory </strong>
                                                <br>- 1st     : <strong>Yann Guyader</strong>
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Yann.jpg" width="154">
                                        </td></tr></table>
                                </td>
            		</tr>
            		
            		
            		<tr>
                                <td>Jun 2nd</td>
                                <td>
                                        <p>Koblenz Marathon <BR>(German Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>Victory </strong>
                                                <br>- 1st     : <strong>Jana Gegner</strong>
                                                <br>- 3rd     : Roberta Casu
                                                <br>
                                                <p>Boys <strong>Victory </strong>
                                                <br>- 1st     : <strong>Yann Guyader</strong>
                                                <br>- 4th     : Fabio Francolini
						<br>- 5th     : Julien Levrard 
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Yann.jpg" width="154">
                                        </td></tr></table>
                                </td>

                        <tr>
                                <td>Jun 8th</td>
                                <td>
                                        <p>Biel Half-Marathon <BR>(Swiss Skate Tour)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>Victory </strong>
                                                <br>- 1st     : <strong>Roberta Casu</strong>
                                                <br>- 2nd     : Jana Gegner
                                                <br>
                                                <p>Boys <strong>Victory </strong>
                                                <br>- 1st     : <strong>Fabio Francolini</strong> 
                                                <br>- 3rd     : Yann Guyader
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Fabio.jpg" width="154">
                                        </td></tr></table>
                                </td>
            		</tr>
            	
                        <tr>
                                <td>Jun 10th</td>
                                <td>
                                        <p>Dijon Marathon <BR>(World Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>Victory </strong>
                                                <br>- 1st     : <strong>Jana Gegner</strong>
                                                <br>- 2nd     : Roberta Casu 
						<br>- 8th     : Jess Gaudesaboos
                                                <br>
                                                <p>Boys
                                                <br>- 2nd     : Yann Guyader
                                                <br>- 5th     : Fabio Francolini 
						<br>- 8th     : Julien Levrard 
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Jana.jpg" width="154">
                                        </td></tr></table>
                                </td>
                        </tr>

                        <tr>
                                <td>Jun 16th</td>
                                <td>
                                        <p>Ostrava Marathon (CZE)<BR>(World Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls  <strong>Victory </strong>
                                                <br>- 1st     : <strong>Jana Gegner</strong> 
                                                <br>- 6th     : Renata Karabova 
                                                <br>
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Jana.jpg" width="154">
                                        </td></tr></table>
                                </td>
                        </tr>

                        <tr>
                                <td>Jun 17th</td>
                                <td>
                                        <p>Strasbourg Marathon <BR>(French Inline Cup)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls
                                                <br>- 2nd     : Jessica Gaudesaboos
                                                <br>
                                                <p>Boys
                                                <br>- 3rd     : Brian L&eacute;pine
                                                <br>- 7th     : Yann Guyader
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Jessica.jpg" width="154">
                                        </td></tr></table>
                                </td>
                        </tr>

                        <tr>
                                <td>July 23rd-28th</td>
                                <td>
                                        <p>European Track Championships <BR>(in Szeged, Hungary)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls <strong>1 Silver, 2 Bronze </strong> 
                                                <p>- 1x Silver : Jana Gegner
						<br>  (3k relay) 
                                                <p>- 1x Bronze: Jana Gegner 
						<br>  (300m sprint) 
                                                <p>- 1x Bronze : Roberta Casu 
						<br>  (10k points) 
                                                <p><br>
                                                <p>Boys  <strong> 4 Gold medals, 1 Silver</strong>
                                                <p>- 3x Gold : <strong>Fabio Francolini</strong> 
                                                <br>  (15k elim, 10k points, 3k relay)  
                                                <p>- 1x Gold : <strong>Nicolas Pelloquin</strong> 
                                                <br>  (300m sprint)  
                                                <p>- 1x Silver : Fabio Francolini 
						<br> (1000m in line)
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Fabio.jpg" width="154">
                                                <BR><img src="Team/Nicolas.jpg" width="154">
                                        </td></tr></table>
                                </td>
                        </tr>

                        <tr>
                                <td>Aug 4th</td>
                                <td>
                                        <p>City Night Berlin <BR>(10km Prestige Race in Berlin)
                                </td><td>
                                        <table><tr><td style="border: 0px; width: 280px">
                                                Girls  <strong>Victory </strong>
                                                <br>- 1st     : Jana Gegner
                                                <br>
                                                <p>Boys  <strong>Victory </strong>
                                                <br>- 1st     : Victor Wilking 
                                        </td><td style="border: 0px;" width="280px" align="center">
                                                <img src="Team/Victor.jpg" width="154">
                                        </td></tr></table>
                                </td>
                        </tr>

	
            	</table>

            </div>

            
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:6000px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
