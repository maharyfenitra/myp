<!-- MAIN MENU -->

  <!-- MENU BAR-->
         <div style="height: 28px; width: 800px;  height: 28px; left: 50px; position: absolute; top: 15px; width: 800px; z-index: 1; " class="main_menu">
           <img src="Resources/Barre_1_Page1_800x28.png" style="border: none; height: 28px; width: 800px; " />
         </div>

  <!-- HOME MENU -->
         <div id="home" style="height: 20px; width: 73px;  height: 20px; left: 90px; position: absolute; top: 19px; width: 73px; z-index: 1; " class="main_menu">
           <img usemap="#map_home_logo" src="Resources/Logo_Barre_1_Page1.png" style="border: none; height: 20px; width: 74px;" />
           <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 73, 20" /></map>
         </div>

  <!-- STORE MENU -->
         <div id="store" style="left: 184px; top: 19px; position: absolute; width: 133px; height: 20px; z-index: 1; " class="main_menu">
           <a title="Store" href="Store_frame.php?lang=<?php print("$lang"); ?>"><?php db_get_text($lang, 'all', 'main_menu_store'); ?></a>
         </div>

  <!-- PRODUCTS MENU -->
         <div id="products" style="left: 297px; top: 19px; position: absolute; width: 133px; height: 20px; z-index: 1; " class="main_menu">
           <a title="Products" href="Products_h2.php?lang=<?php print("$lang"); ?>"><?php db_get_text($lang, 'all', 'main_menu_products'); ?></a>
         </div>

  <!-- GALLERY MENU -->
         <div id="racing" style="left: 430px; top: 19px; position: absolute; width: 133px; height: 20px; z-index: 1; " class="main_menu">
           <a title="Gallery" href="Gallery_skates.php?lang=<?php print("$lang"); ?>"><?php db_get_text($lang, 'all', 'main_menu_gallery'); ?></a>
         </div>

  <!-- ABOUT MENU -->
         <div id="contact" style="left: 563px; top: 19px; position: absolute; width: 133px; height: 20px; z-index: 1; " class="main_menu">
           <a title="About us" href="About.php?lang=<?php print("$lang"); ?>"><?php db_get_text($lang, 'all', 'main_menu_about'); ?></a>
         </div>

  <!-- LANGUAGE MENU -->
         <div id="flag_en" style="height: 10px; left: 720px; position: absolute; top: 18px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_en" width=16 height=10 src="./Resources/flag_en.gif">
           <map name="map_flag_en" id="map_flag_en"><area href="<?php curPageName(); ?>?lang=en" title="english" alt="english" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_es" style="height: 10px; left: 750px; position: absolute; top: 18px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_es" width=16 height=10 src="./Resources/flag_es.gif">
           <map name="map_flag_es" id="map_flag_es"><area href="<?php curPageName(); ?>?lang=es" title="espanol" alt="espanol" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_fr" style="height: 10px; left: 780px; position: absolute; top: 18px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_fr" width=16 height=10 src="./Resources/flag_fr.gif">
           <map name="map_flag_fr" id="map_flag_fr"><area href="<?php curPageName(); ?>?lang=fr" title="français" alt="français" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_de" style="height: 10px; left: 810px; position: absolute; top: 18px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_de" width=16 height=10 src="./Resources/flag_de.gif">
           <map name="map_flag_de" id="map_flag_de"><area href="<?php curPageName(); ?>?lang=de" title="deutsch" alt="deutsch" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_nl" style="height: 10px; left: 735px; position: absolute; top: 31px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_nl" width=16 height=10 src="./Resources/flag_nl.gif">
           <map name="map_flag_nl" id="map_flag_nl"><area href="<?php curPageName(); ?>?lang=nl" title="nederlands" alt="nederlands" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_it" style="height: 10px; left: 765px; position: absolute; top: 31px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_it" width=16 height=10 src="./Resources/flag_it.gif">
           <map name="map_flag_it" id="map_flag_it"><area href="<?php curPageName(); ?>?lang=it" title="italiano" alt="italiano" coords="0, 0, 16, 10" /></map>
         </div>

         <div id="flag_pl" style="height: 10px; left: 795px; position: absolute; top: 31px; width: 16px; z-index: 1; ">
           <img usemap="#map_flag_pl" width=16 height=10 src="./Resources/flag_pl.gif">
           <map name="map_flag_pl" id="map_flag_pl"><area href="<?php curPageName(); ?>?lang=pl" title="polish" alt="polish" coords="0, 0, 16, 10" /></map>
         </div>



<!-- CLUB TARIFS PANEL -->
<!--         <div id="club_tarifs" style="height: 28px; left: 240px; position: absolute; top: 50px; width: 400px; z-index: 1; " class="main_menu">
           <a title="Club Tarifs" href="EOSkates_Tarif_Club_2010_<?php print$lang; ?>.pdf"><?php db_get_text($lang,'all','main_menu_club_tarifs'); ?></a>
         </div>
-->

<!-- OFFRE SPECIAL NOEL  -->
         <div id="xmas_offer" style="height: 28px; left: 220px; position: absolute; top: 50px; width: 500px; z-index: 1; " class="main_menu">
           <a title="Xmas Offer" href="Store_frame.php?lang=<?php print$lang; ?>"><?php db_get_text($lang,'all','main_menu_xmas_offer'); ?></a>
         </div>


<!-- CART PANEL -->
         <div id="cart" style="height: 28px; left: 710px; position: absolute; top: 52px; width: 133px; z-index: 1; " class="main_menu">
           <?php db_get_text($lang,'all','main_menu_view_cart'); ?>
         </div>

         <div id="cart" style="height: 28px; left: 770px; position: absolute; top: 48px; width: 133px; z-index: 1; " class="main_menu">
           <img src="Resources/caddy.jpg">
         </div>

         <div id="widget_cart" style="left: 726px; top: 52px; opacity: 1.00; position: absolute; height: 28px; width: 133px; z-index: 1; ">
           <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
             <input type="hidden" name="cmd" value="_cart">
             <input type="hidden" name="business" value="paypal@eoskates.com">
             <input type="image" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="130" height="28" border="0" name="submit" alt="PayPal">
             <input type="hidden" name="display" value="1">
           </form>
         </div>

