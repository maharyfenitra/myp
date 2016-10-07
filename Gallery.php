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
            <img src="images/EOSkate_Logo.png" usemap="#map_home_logo"
                 style=" position: absolute; height: 28px; width: 136px; margin-left: 18px; margin-top: 20px; z-index: 1;" />
            <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 136, 28" /></map>

            

<!-- ######### MAIN PANEL #################################### --> 
            
      	<!-- PICTURES List -->

           <div id="title_banner" style="left: 12px; height: 25px; z-index: 1; position: absolute; top: 75px; width: 150px; ">
           	<a style=" padding-left:20px; color:white;">Pictures</a>
           </div>
           <div id="body_content" style=" left:12px; width: 150px;  height: 274px; top: 100px; z-index: 1;position: absolute;">
		
	   </div>
			
            <!-- PICTURES -->
          
            <div id="body_content" style=" width: 840px;  height: 691px; left: 170px; position: absolute; top: 75px; z-index: 1; ">
		<?php
	               require_once 'gallery_index.php';
		?>
            </div>
            

            
	   <!-- VIDEOS List -->

	           <div id="title_banner" style="left: 12px; height: 25px; z-index: 1; position: absolute; top: 800px; width: 150px; ">
		           <a style=" padding-left:20px; color:white;">Videos</a>
	            </div>
	            <div id="body_content" style="; left:12px; width: 150px;  height: 274px; top: 825px; z-index: 1;position: absolute;">

	            </div>
			
            <!-- VIDEOS -->
          
            <div id="body_content" style=" width: 840px;  height: 501px; left: 170px; position: absolute; top: 800px; z-index: 1; ">
				  
            </div>
            
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:1000px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
