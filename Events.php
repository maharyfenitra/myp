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
            
            <!-- Team Container -->
          
            <div id="body_content" style=" background-image:url(images/background3.png); width: 1000px;  height: 1000px; left: 12px; position: absolute; top: 75px; z-index: 1;overflow:auto; ">
            	
            	<p style=" z-index: 1; margin-top: 30px; font-size: 40px; font-family: arial; margin-left: 340px;color: rgb(96, 95, 95);"> Upcoming Events</p>
            	<table border="1"  cellspacing="5" cellpadding="10" id="tableEvent">
            		<colgroup>
            			<col  style="background: rgb(247,247,247);" width="1%"  heigth="5%"/>
            			<col width="5%"/>
            			<col width="20%"/>
            		</colgroup>

            		<tr class="toprow">
            			<th>Month</th>
            			<th> Date</th>
            			<th>Event</th>
            		
            		</tr>
            		
            		<tr>
            			<td>Januar</td>
            			<td>
            			<p>4-6</p>
            			<p>24-26</p>
            			
            			</td>
            			<td> 
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank" >..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank" >..see more</a></p>
            			</td>
            		
            		</tr>
            		
            		<tr>
            			<td>Februar</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>März</td>
      					<td>
            			<p>4-6</p>
            			<p>24-26</p>
            			
            			</td>
            			<td> 
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank" >..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank" >..see more</a></p>
            			</td>
            		
            		</tr>
            		
            		<tr>
            			<td>April</td>
            			<td>
            			<p>4-6</p>
            			<p>24-26</p>
            			
            			</td>
            			<td> 
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>
            			</td>
            		
            		
            		</tr>
            		
            		<tr>
            			<td>Mai</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>Juni</td>
            			<td>
            			<p>4-6</p>
            			<p>10-16</p>
            			<p>18-20</p>
            			<p>24-26</p>
            			</td>
            			
            			<td> 
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>
            		
            			</td>
            			
            			
            		
            		
            		</tr>
            		
            		<tr>
            			<td>Juli</td>
            			<td>
            			<p>4-6</p>
            			<p>10-16</p>
            			<p>18-20</p>
            			<p>24-26</p>
            			</td>
            			
            			<td> 
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>
            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>

            			<p>GIC BERLIN <a href="http://www.german-inline-cup.de" target="_blank">..see more</a></p>
            		
            			</td>
            		
            		</tr>
            		
            		<tr>
            			<td>August</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>spetember</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>Oktober</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>November</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            		<tr>
            			<td>Dezember</td>
            			<td> Days</td>
            			<td>Events</td>
            		
            		</tr>
            		
            	</table>

            </div>

            
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:1000px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
