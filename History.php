<?php
    require_once 'php_includes/config.php';
#    include './php_includes/db.php';
    include './php_includes/language.php';
    include './php_includes/category-functions.php';
    include './customer/library/customer.php';
    include './customer/library/admin_customer.php';
    include './customer/library/checker.php';
    include './customer/library/history.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <?php include './php_includes/head.php'; ?>
        <meta name="viewport" content="user-scalable=yes, width=636" />
       <!---- <link href="jquery-ui/jquery-ui.css" rel="stylesheet">--->
	
    </head>
    
	
    
    <body style="background: #1F2147; " onload="onPageLoad();" onunload="onPageUnload();">

        <div id="body_content" style="background: #1F2147">
<!---<script src="jquery-ui/jquery-ui.js"></script>--->


		<?php include './php_includes/main_menu.php'; ?>

		<!-- HOME MENU BANNER -->
		
		 <div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
             
            <!-- STORE LOGO -->
            <img src="images/top-skates_grey.png" usemap="#map_home_logo"
                 style=" position: absolute;  width: 240px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
            <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

  			</div>             


<!-- ######### MAIN PANEL #################################### --> 
            
       
            <!-- BLOK DIV 1 -->
          
     	<div id="body_content" style="border-radius:10px; width: 1000px;  height: 700px; left: 12px; position: absolute; top: 110px; z-index: 1; vertical-align:middle;">
			<img src="images/top-skates_grey.png" style=" position: absolute; width: 400px; margin-left: 300px; margin-top: 30px; z-index: 1;" />


     	<?php $customer=new Customer($_SESSION ['session_name'],null,null,null);
     	      $admin = new AdminCustomer();
     	      $cu_id = $customer->getMail();
     	      $history = new History();
     	      $order = $history->getCustomerHitory($cu_id);
     	    //  print_r($order);
     	      
     	      
     	?>
		

		<div style="left: 120px; position:relative; top:180px; width: 750px;height :400px; overflow: auto">
		
                <table border=0 width=100%>
               		<tr><th align="center"> 
               			<?php db_get_text($lang, 'all', 'date_d_achat');?>
               		</th>

			<th align="center">
				<?php db_get_text($lang, 'all', 'reference_achat_item');?>
			</th>
			
			<!--<th align="center">
				<?php db_get_text($lang, 'all', 'transaction_item'); ?>
			</th>--->

			<th align="center">
				<?php db_get_text($lang, 'all', 'statut_item'); ?>
			</th>
	
			<th align="center">
				<?php db_get_text($lang, 'all', 'adresse_item'); ?>
			</th>

			<th align="center">	
				<?php db_get_text($lang, 'all', 'pays_item'); ?>
			 
                        </th>
			<th align="center">
				<?php db_get_text($lang, 'all', 'total_item'); ?>
			</th>
                          
			</tr>


                          <?php  	 
                          foreach($order as $ord){
                                if($ord['od_payment_status']!='New'){
                             ?>
                             <tr>
                             <td width="140" align="left">
                                <?php echo $ord['od_date'];?>
                             </td>
                             <td>
                                <?php
                                $od_id = $ord['od_id'];
                                $or = $history->getAllItemForODID($od_id);
                                $t =0;
                                foreach($or as $o){
                                    $t+=$o['oi_price']*$o['oi_qty'];
                                
                                }
                                 echo '<a href="Details_Orders.php?od_id='.$od_id.'">'.$ord['od_reference'].'</a>'; ?>
                             </td>
                            <!-- <td>
                                <?php echo $ord['od_transaction_number']; ?>
                             </td>-->
                             <td>
                                <?php echo $ord['od_payment_status'];  ?>
                             </td>
                             <td>
                                <?php echo $ord['od_shipping_address1']; ?>
                             </td>
                             <td>
                                <?php echo $ord['od_shipping_country']; ?>
                             </td>
                             <td align='right'>
                             ee
                                <?php //echo displayAmount($ord['od_amount_total']);
                                echo displayAmount($t); ?>
                             </td>
               </tr> 
                             <?php
                               }
                          }
                          ?>
    
               </table>
		
		</div>
		
		</div>
			         
            
        


		<!------------------------------------------------------------------------
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#envoyer').on('submit', function(e) {

     //Debut fonction
        
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
       
      })
   });

</script>  
<!-------------------------------------------------------------------------------------------------->   
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:850px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>


        </div>
    </body>
</html>
