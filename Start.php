<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    
    <?php
    include './php_includes/db.php';
    include './php_includes/language.php';
    ?>
    <head>
        <?php include './php_includes/head.php'; ?>
    </head>

    <body style="background: #E9E9E9; ">
        <div background=" rgb(1, 1, 1)" style= "width: 900px; height:720px; " id="body_content">



             <!-- MAIN PANEL -->

             <!-- MAIN IMAGE -->
             <!--         <div style="height: 356px; width: 800px;  height: 356px; left: 50px; position: absolute; top: 79px; width: 800px; z-index: 1; ">
                         <img usemap="#map3" src="Resources/EOSkates_H2_carbon_frame_800x356.jpg" style="border: none; height: 356px; width: 800px; " /> -->
             <div style="height: 600px; width: 800px; left: 50px; position: absolute; top: 20px;  z-index: 1;border: 0px solid #CCC; ">
    <!--            <img usemap="#map3" src="Resources/podium_boys_le_mans_2011_2.jpg" style="border: none; height: 390px; width: 800px; " /> -->
    <!--            <img usemap="#map3" src="Resources/podium_girls_le_mans_2011_2.jpg" style="border: none; height: 390px; width: 800px; " />--> 
                <img usemap="#map3" src="Resources/detail_h2.png" style="border: none; height: 550px; width: 750px;margin-left: -110px; margin-top: -40px; " /> 
                <img usemap="#map3" src="images/EOSkate_Logo.png" style="border: none; height: 120px; width: 590 px; margin: 0px 20px 100px 120px;" /> 
                <map name="map3" id="map3"><area href="Home2.php?lang=<?php print $lang; ?>" title="<?php db_get_text($lang, 'home', 'button_wheels_title'); ?>" coords="0, 0, 800, 356" /></map>
            </div>
             <div id="start_menu">
                 


             </div>

        </div>

    </body>
</html>
