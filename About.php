<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<?php
include './php_includes/db.php';
include './php_includes/language.php';
?>
  <head>
     <?php include './php_includes/head.php'; ?>
  </head>

  <body style="background: rgb(255, 255, 255) url(Resources/Texture_carbone.jpg) repeat scroll top left; margin: 0pt; " onload="onPageLoad();" onunload="onPageUnload();">
      <div style="margin-bottom: 0px; margin-left: auto; margin-right: auto; margin-top: 0px; overflow: hidden; position: relative; word-wrap: break-word;  background: rgb(0, 0, 0); text-align: left; width: 900px;height:820px; " id="body_content">

<!-- MAIN PANEL -->

          <div style="height: 2px; width: 607px;  height: 1px; left: 245px; position: absolute; top: 218px; width: 607px; z-index: 1; " class="tinyText">
            <div style="position: relative; width: 607px; ">
              <img src="Contact_files/shapeimage_1.png" alt="" style="height: 2px; left: 0px; margin-top: -1px; position: absolute; top: 0px; width: 607px; " />
            </div>
          </div>

          <div id="id6" style="height: 157px; left: 245px; position: absolute; top: 237px; width: 590px; z-index: 1; " class="special_menu">
            <div class="text-content graphic_textbox_layout_style_default_External_590_157" style="padding: 0px; ">
              <div class="graphic_textbox_layout_style_default">
                <p style="padding-top: 0pt; " class="paragraph_style_2">EOSKATES / LGO Concept Sarl<br /></p>
                <p class="paragraph_style_2">43a route de Lyon<br /></p>
                <p class="paragraph_style_2">67400 ILLKIRCH<br /></p>
                <p class="paragraph_style_2">France<br /></p>
                <p class="paragraph_style_2"><br /></p>
                <p class="paragraph_style_3"><a class="class2" title="mailto:contact@eoskates.com" href="mailto:contact@eoskates.com">contact@eoskates.com<br /></a></p>
              </div>
            </div>
          </div>

        <div style="left: 676px; top: 586px; position: absolute; top: 606px; width: 200px; z-index: 1; " class="tinyText style_SkipStroke_1">
            <img src="Resources/Logo_Barre_1_Page1.png" alt="" style="border: none; height: 55px; width: 200px; " />
          </div>



  <!-- COPYRIGHT -->
          <div id="copyright" style="left:50px; top: 725px; position: absolute; height: 30px; width: 800px; z-index: 1; " class="copyright">
                <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
          </div>


  <!-- FACEBOOK SHARE -->
          <div style="left:300px; top:750px; position: absolute; opacity: 1.00; height: 20px; width: 100px; z-index: 1; ">
             <a name="fb_share" type="button" href="http://www.facebook.com/sharer.php"><?php db_get_text($lang,'all','facebook_share'); ?></a>
             <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
          </div>

  <!-- PAYPAL -->
         <div id="Paypal" style="left: 410px; top: 750px; position: absolute; height: 18px; width: 55px; z-index: 1; " class="news_feed">
           <img src="Resources/paypal.png" height="18">
         </div>

         <div id="Paypal_credit_cards" style="left: 500px; top: 750px; position: absolute; height: 18px; width: 110px; z-index: 1; " class="news_feed">
           <img src="Resources/paypal_credit_cards.png" height="18">
         </div>


     <?php include './php_includes/main_menu.php'; ?>

    </div>
  </body>
</html>



