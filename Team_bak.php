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
          
            <div id="body_content" style="background-image:url(images/background3.png); width: 1000px;  height: 1500px; left: 12px; position: absolute; top: 75px; z-index: 1; ">
<!--            	<img src="images/EOSkate_Logo.png" style=" position: absolute; width: 400px; margin-left: 300px; margin-top: 50px; z-index: 1;" /> -->
            	<p style=" z-index: 1; margin-top: 30px; font-size: 40px; font-family: arial; margin-left: 340px;color: rgb(96, 95, 95);">World Team 2013</p>
            
           	 <div id="body_content" style=" width: 820px;  height: 363px; left: 90px; position: absolute; top: 100px; z-index: 1; ">
				<img src="Team/Team.jpg" width="820">	

           	 </div>

<!-- FIRST ROW -->            	

            	<div id="body_content" style=" width: 154px;  height: 200px; left: 120px; position: absolute; top: 480px;  ">
            	
				<a style="  position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); " class="pointer" onclick="overlay('display')" >
					<img src="Team/Fabio.jpg" width="154" />	
					<br>
				 	Fabio Francolini	
				</a>
            	</div>
			
            
            	<div id="body_content" style=" width: 154px;  height: 200px; left: 320px; position: absolute; top: 480px; z-index: 1; ">
            			<a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Yann.jpg" width="154" />
                                        <br>
				 	Yann Guyader	
				</a>

            	</div>

            	
                <div id="body_content" style=" width: 154px;  height: 200px; left: 520px; position: absolute; top: 480px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Chechy.jpg" width="154" />
                                        <br>
                                        Cecilia Baena 
                                </a>

                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 720px; position: absolute; top: 480px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Jana.jpg" width="154" />
                                        <br>
                                        Jana Gegner 
                                </a>

                </div>


<!-- SECOND ROW -->            	

                <div id="body_content" style=" width: 154px;  height: 200px; left: 120px; position: absolute; top: 730px;  ">

                                <a style="  position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); " class="pointer" onclick="overlay('display')" >
                                        <img src="Team/Elio.jpg" width="154" />
                                        <br>
                                        Elio Cuncu 
                                </a>
                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 320px; position: absolute; top: 730px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Julien.jpg" width="154" />
                                        <br>
                                        Julien Levrard 
                                </a>

                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 520px; position: absolute; top: 730px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Roberta.jpg" width="154" />
                                        <br>
                                        Roberta Casu 
                                </a>

                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 720px; position: absolute; top: 730px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Jessica.jpg" width="154" />
                                        <br>
                                        Jessica Gaudesaboos 
                                </a>

                </div>

           
<!-- THIRD ROW -->

                <div id="body_content" style=" width: 154px;  height: 200px; left: 120px; position: absolute; top: 980px;  ">

                                <a style="  position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); " class="pointer" onclick="overlay('display')" >
                                        <img src="Team/Victor.jpg" width="154" />
                                        <br>
                                        Victor Wilking 
                                </a>
                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 320px; position: absolute; top: 980px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Giacomo.jpg" width="154" />
                                        <br>
                                        Giacomo Cuncu
                                </a>
            
                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 520px; position: absolute; top: 980px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Paola.jpg" width="154" />
                                        <br>
                                        Paola Seranno 
                                </a>

                </div>


                <div id="body_content" style=" width: 154px;  height: 200px; left: 720px; position: absolute; top: 980px; z-index: 1; ">
                                <a style=" position: absolute; z-index: 1; margin-top: 0px; font-family: arial; margin-left: 0px;color: rgb(96, 95, 95); class="pointer" onclick="overlay('display')">
                                        <img src="Team/Melissa.jpg" width="154" />
                                        <br>
                                        Melissa Chouleysko 
                                </a>

                </div>

 
            	
            </div>
            

            
            

            
           
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:1500px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
