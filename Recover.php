<?php
include './php_includes/db.php';
include './php_includes/language.php';
include './customer/library/customer.php';
include './customer/library/checker.php';
?>
 <!DOCTYPE html>
<html  lang="fr">

<head>
<?php include './php_includes/head.php'; ?>
<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css"/>
</head>

<body style="background: #1F2147; " onload="onPageLoad();" onunload="onPageUnload();">

        <div id="body_content" style="background: #1F2147">
<script src="jquery-ui/jquery-ui.js"></script>


		<?php include './php_includes/main_menu.php'; ?>

		<!-- HOME MENU BANNER -->
		
		 <div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
             
            <!-- STORE LOGO -->
            <img src="images/top-skates_grey.png" usemap="#map_home_logo"
                 style=" position: absolute;  width: 240px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
            <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

  			</div>             


		<!-- ######### MAIN PANEL #################################### -->


		<!-- Main Container -->

		<div id="body_content" style="  border-radius: 10px;width: 1000px;  height: 800px; left: 12px; position: absolute; top: 110px; z-index: 1; ">
            	<img src="images/top-skates_grey.png" style=" position: absolute; width: 400px; margin-left: 300px; margin-top: 30px; z-index: 1;" />
			<div id="body_content" style="width: 820px; height: 780px; left: 90px; position: absolute; top: 150px; z-index: 1;">

				<table border=0 width=100% cellpadding="10">
				<tr>	
					<tr height=30px align=center valign=top>
						<td align=left></td>
						<td align=left>
							<div id="register">
								</div>
								<script
									src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
						
						</td>
					</tr>
					<tr><td><h2><?php db_get_text($lang, 'all', 'Send_me_my_passworld')?></h2></td></tr>
					<form method="POST" action="Customer.php?id_err=10">
					<tr>
			   
			                
			                <td><?php db_get_text($lang, 'all', 'customer_pseudo_or_email'); ?> :</td>
			                <td><input type="text" name="compte" value="<?php if(isset($_GET['default_mail'])) {$mail=$_GET['default_mail'];}else $mail=''; echo $mail; ?>"/></td>
			   
			                </tr>
					<tr>
					<td></td>
					<td><input type="submit" value="<?php db_get_text($lang, 'all', 'recover_item'); ?>" /></td>
					
					
					
					</tr>
					</form>
					<!---<tr>
						<td valign=top>
							<form method="POST" <?php 
							  $url=  urlencode ("Home.php");
							 if(!isset($_GET['forget_password'])){?>
								action="/customer/includes/signin.php?url=<?php echo $url;?>" <?php } else{?>
								action="Customer.php?id_err=10" ;
								<?php } ?>>
								<table>
									<tr>
										<td><h2>
												<?php if(!isset($_GET['forget_password'])){
													echo db_get_text($lang, 'all', 'customer_sign_in');;
												} else{
													echo db_get_text($lang, 'all', 'Send_me_my_passworld');
                                                         }?>
											</h2></td>
										<td></td>
									
									
									<tr>
									
									
									<tr>
										<td><?php db_get_text($lang, 'all', 'customer_pseudo_or_email'); ?> :</td>
										<td><input type="text" name="compte" /></td>
									</tr>
									<?php if(!isset($_GET['forget_password'])){?>
									<tr>
										<td><?php db_get_text($lang, 'all', 'customer_password'); ?>:</td>
										<td><input type="password" name="password" /></td>
									</tr>
									<?php if(isset($_GET['id_err'])){
									
									if($_GET['id_err']==1){
									?>
									<tr>
										<td></td>
										<td style="color: red;">*<?php db_get_text($lang, 'all', 'customer_error_login'); ?>*</td>
									</tr>
									<?php }
									
									if($_GET['id_err']==2){
									?>
									<tr>
										<td></td>
										<td style="color: red;">*<?php db_get_text($lang, 'all', 'compte_pas_encore_active_item'); ?>*</td>
									</tr>
									<?php }
									
									
									}
									
									
									?>
									<tr>
										<td></td>
										<td><input type="submit" value="<?php db_get_text($lang, 'all', 'go_button'); ?>" /></td>
									</tr>
									<tr>
										<td></td>
										<td><a href='Customer.php?forget_password=1'
											style='text-decoration: underline;'><?php db_get_text($lang, 'all', 'recover_item'); ?></a>
										</td>
									</tr>
									<?php }else{?>

									<tr>
										<td></td>
										<td><input type="submit" value="<?php db_get_text($lang, 'all', 'recover_item'); ?>" /></td>
									</tr>
									<?php  }?>
									
								</table>
							</form>
						</td>
					</tr>
				</tr>
				<tr>
						<td><?php //require_once 'customer/includes/newcompte.php';?>
						</td>

				</tr>--->
				</table>

			</div>

		</div>




		<!-- ######## FOOTER ################-->

		<!-- COPYRIGHT -->
	          <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:950px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


			</p>
		</div>


	</div>
</body>
</html>
