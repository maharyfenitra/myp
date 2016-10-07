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

			
            <!-- Download Container -->
          
            <div id="body_content" style="background-image:url(images/background3.png); width: 1000px;  height: 1000px; left: 12px; position: absolute; top: 75px; z-index: 1; ">
            	<img src="images/EOSkate_Logo.png" style=" position: absolute; width: 400px; margin-left: 300px; margin-top: 50px; z-index: 1;" />
            	<p style=" z-index: 1; margin-top: 155px; font-size: 30px; font-family: arial; margin-left: 430px;color: rgb(96, 95, 95);">Downloads</p>
            
           	 <div id="body_content" style=" width: 820px;  height: 400px; left: 90px; position: absolute; top: 200px; z-index: 1; ">
					<p>here download material </p>

           	 </div>
            	
            	<div id="body_content" style=" width: 100px;  height: 100px; left: 200px; position: absolute; top: 650px;  ">
            	</div>
            	
				<a style="  position: absolute; z-index: 1; margin-top: 520px; font-family: arial; margin-left: 200px;color: rgb(96, 95, 95); " class="pointer" onclick="overlay('display')" >Member1</a>
			
            
            	<div id="body_content" style=" width: 100px;  height: 100px; left: 450px; position: absolute; top: 650px; z-index: 1; ">
            	</div>
            	<a style=" position: absolute; z-index: 1; margin-top: 520px; font-family: arial; margin-left: 450px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">Member2</a>
            	

            
            	<div id="body_content" style=" width: 100px;  height: 100px; left: 700px; position: absolute; top: 650px; z-index: 1; ">
            	</div>
            	

            	<a style=" position: absolute; z-index: 1; margin-top: 520px; font-family: arial; margin-left: 700px;color: rgb(96, 95, 95);">Member3</a>
            
            
            	<div id="body_content" style=" width: 100px;  height: 100px; left: 200px; position: absolute; top: 850px; z-index: 1; ">
            	</div>
            	<a style=" position: absolute; z-index: 1; margin-top: 720px; font-family: arial; margin-left: 200px;color: rgb(96, 95, 95);">Member4</a>
            
            
            	<div id="body_content" style=" width: 100px;  height: 100px; left: 450px; position: absolute; top: 850px; z-index: 1; ">
            	</div>
            	<a style="  position: absolute; z-index: 1; margin-top: 720px; font-family: arial; margin-left: 450px;color: rgb(96, 95, 95);">Member5</a>
            
            
            	<div id="body_content" style=" width: 100px;  height: 100px; left:700px; position: absolute; top: 850px; z-index: 1; ">
            	</div>
            	<a style=" position: absolute; z-index: 1; margin-top: 720px; font-family: arial; margin-left: 700px;color: rgb(96, 95, 95);">Member6</a>
            	
            </div>
            

            
            

            
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:1000px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
