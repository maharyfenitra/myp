
<!-- MAIN MENU -->


<!-- MENU BAR-->
<div style="position: absolute; top: 15px; left: 260px; z-index: 100000; text-align: center;">

	<?php 
		if(isset($_SESSION['session_name'])){
           		$customer=new Customer($_SESSION['session_name'],null,null,null);
		 }
	?>
	
<!-- debut Login -->

<?php 

if(isset($_SESSION['session_name'])&&$_SESSION['session_name']!=0){

?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<style>

.nav {
list-style: none none;
margin: 0;
padding: 0;
line-height: 1;
}
.nav a {
display: block;
padding:.5em;
color: gray;
/*background: light-gray ;transparent;*/
text-decoration: none;
}
.nav a:focus,
.nav a:hover {
color: red;
/*background: transparent;*/ 
text-decoration: underline;
}
.nav-item {
float: left; 
position: relative; 
top: -0.3em;
}
.sub-nav {
position: absolute; 
white-space: nowrap;
left: 0; 
top: 2em; 
white-space: nowrap; 
background: white; 
margin-top: -2px; 
}

.sub-nav-item a {
position: absolute;
left: -10000px;
top: auto;
width: 1px;
height: 1px;
overflow: hidden;
float: left; 
}
.sub-nav-item a:focus,
.nav-item a:focus +.sub-nav a,
.nav-item:hover .sub-nav-item a {
position: static;
left: auto;
width: auto;
height: auto;
overflow: visible;
}
@media screen and (max-width: 480px) {
.nav-item {
float: none;
}
.sub-nav {
position: static;
white-space: normal;
}
.sub-nav-item a {
display: block; 
width: auto; 
height: auto; 
position: static; 
padding-left: 1em; 
overflow: visible;
float: none;
}
}
/*________________________________________________*/
/*body {
font-family: 'Lucida Grande', 'Helvetica Neue', Helvetica, Arial, sans-serif;
padding: 20px 50px 150px;
font-size: 13px;
text-align: center;
background: #E3CAA1;
}*/

.out {
text-align: left;
display: inline;
margin: 0;
padding: 15px 4px 17px 0;
list-style: none;
-webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
-moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}
.out .in {
font: bold 12px/18px sans-serif;
display: inline-block;
margin-right: -4px;
position: relative;
padding: 15px 20px;
background: #fff;
cursor: pointer;
-webkit-transition: all 0.2s;
-moz-transition: all 0.2s;
-ms-transition: all 0.2s;
-o-transition: all 0.2s;
transition: all 0.2s;
}
.out .in:hover {
background: #555;
color: #fff;
}
.out .in .out {
padding: 0;
position: absolute;
top: 48px;
left: 0;
width: 150px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
display: none;
opacity: 0;
visibility: hidden;
-webkit-transiton: opacity 0.2s;
-moz-transition: opacity 0.2s;
-ms-transition: opacity 0.2s;
-o-transition: opacity 0.2s;
-transition: opacity 0.2s;
}
.out .in .out .in { 
background: #555; 
display: block; 
color: #fff;
text-shadow: 0 -1px 0 #000;
}
.out .in .out .in:hover { background: #666; }
.out .in:hover .out {
display: block;
opacity: 1;
visibility: visible;
}
.ar {
    border:0px solid black;
    -moz-border-radius:7px;
    -webkit-border-radius:10px;
    border-radius:10px;
    
	}
.lab{
color : black;
}
</style>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="main_menu" style="left: 574px; top: 0px; position: absolute; opacity: 1.00; height: 20px; width: 200px; z-index: 100000; margin: auto;">

<ul class="out" style="z-index:10000;">
	<li class="in ar">
		      <a href="#" style="text-align : center;font-size: 80%;"><pan class="lab">&nbsp;<?php 
		      
		      $first=$customer->getShippingFirstName();
		      $last=$customer->getShippingLastName();
		      $lfirst=strlen ($first);
		      $llast=strlen($last);
		      $total = $lfirst+$llast;
		      $seuil=20;
		      if($total<$seuil){
		      $label = $first.' '.$last;
		      
		      }
		      else{
			 if($last<$lfirst){
				$label= $last;
			 }else{
			 $label= $first;
			 
			 }
		      }
		      
	   // echo $customer->getShippingFirstName()." ".$customer->getShippingLastName();
						   
		   echo $label;?></span></a>
		  <ul class="out ar" >
		       <li class="in ar"><a title="" href="Account.php"><?php db_get_text($lang, 'all', 'customer_account');?></a></li>
		       <li class="in ar" ><a href="customer/includes/signout.php?url=<?php echo   urlencode ($_SERVER['REQUEST_URI']);?>" 
				title="Sign out"><?php db_get_text($lang, 'all', 'customer_sign_out');?></a></li>
		       
		       </ul>
      </li>
      
</ul>	

</div>   

</div>

<script
src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(document).on('click', '#out_now', function() {

window.location="Home.php";

})
</script>


<?php
}
else{
?>
<div class="main_menu"	style="left: 560px; top: 25px; position: absolute; opacity: 1.00; height: 20px; width: 200px; z-index: 1;">
<a href="Customer.php<?php $e= '';//urlencode ($_SERVER['REQUEST_URI']);
			 //   echo  $e;
?>" style="color: red;"><?php db_get_text($lang, 'all', 'main_menu_connection'); ?></a>
</div>
</div>
<!-- NEWS FEED -->
<div id="News_content" style="height: 20px; left: 405px; position: absolute; top: 3px; width: 615px; z-index: 1;" class="news_feed">
	<marquee behavior="slide" direction="left" scrolldelay="5" 
		scrollamount="2">
		<a href="<?php db_get_URL($lang, 'home', 'news_feed_content'); ?>"> <?php db_get_text($lang, 'home', 'news_feed_content'); ?> 
		</a>
	</marquee>
</div>
<?php 
}
?>


<!-- LANGUAGE MENU -->
<div style="position: absolute; left: 10px; right: 0px; top: 71px; z-index: 1;">

<!-- FLAGS -->

<div id="flag_fr"
	style="width: 20px; height: 25px; left: 45px; position: absolute; top: 5px; z-index: 1;">
	<img class="flags" usemap="#map_flag_fr" width=20 height=18
		src="images/Flag_France.png">
	<map name="map_flag_fr" id="map_flag_fr">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=fr"';
		} ?>
			title="français" alt="french" coords="0, 0, 20, 18" />
	</map>
</div>


<div id="flag_de"
	style="height: 10px; left: 75px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_de" height=18
		src="images/Flag_Germany">
	<map name="map_flag_de" id="map_flag_de">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=de"';
                } ?>
			title="deutsch" alt="german" coords="0, 0, 20, 18" />
	</map>
</div>

<div id="flag_it"
	style="height: 12px; left: 105px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_it" height=18
		src="images/Flag_Italy">
	<map name="map_flag_it" id="map_flag_it">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=it"';
                } ?>
			title="italiano" alt="italian" coords="0, 0, 20, 18" />
	</map>

</div>

<div id="flag_es"
	style="height: 10px; left: 135px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_es" height=18
		src="images/Flag_Spain">
	<map name="map_flag_es" id="map_flag_es">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=es"';
                } ?>
			title="espanol" alt="spanish" coords="0, 0, 20, 18" />
	</map>

</div>

<div id="flag_nl"
	style="height: 10px; left: 165px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_nl" height=18
		src="images/Flag_Nederland">
	<map name="map_flag_nl" id="map_flag_nl">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=nl"';
                } ?>
			title="nederlands" alt="dutch" coords="0, 0, 20, 18" />
	</map>

</div>
<!--
<div id="flag_pl"
	style="height: 10px; left: 195px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_pl" height=18
		src="images/Flag_Poland">
	<map name="map_flag_pl" id="map_flag_pl">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=pl"';
                } ?>
			title="polski" alt="polish" coords="0, 0, 20, 18" />
	</map>

</div>
-->
<div id="flag_en"
	style="height: 10px; left: 195px; position: absolute; top: 5px; width: 16px; z-index: 1;">
	<img class="flags" usemap="#map_flag_en" height=18 src="images/Flag_Uk">
	<map name="map_flag_en" id="map_flag_en">
		<area
		<?php if (!isSet($step)|| !isSet($_POST['step'])) {
			echo 'href="'; echo curPageName(); echo curPageParamExcept('lang'); echo 'lang=_en"';
	} ?>
			title="english" alt="english" coords="0, 0, 20, 18" />
	</map>

</div>
</div>



