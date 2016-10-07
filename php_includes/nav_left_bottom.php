<div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 12px; top: 730px; height: 50px; ">
	           
			<ul style="font-size:20px;" >
			    <li><a title="" href="Store.php"><?php db_get_text($lang, 'all', 'main_menu_store'); ?></a><br/><br/><br/></li>
			   
			    <?php if(isset($_SESSION['session_name'])){?>
			    <li><a title="" href="Account.php"><?php db_get_text($lang, 'all', 'customer_account');?></a><br/><br/><br/></li>
			    <?php }?>
			    
			    <li><a title="" href="Contact.php"><?php db_get_text($lang, 'all', 'main_menu_contact');?></a><br/><br/><br/></li>
			<ul>

	           </div>
