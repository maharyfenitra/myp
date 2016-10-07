<?php
if (!defined('WEB_ROOT')) {
	exit;
}

require_once "productItemList.php";

$product = getProductDetail($pdId, $lang);
$pdImage=getProductItemImageDetail($pdId);
$nb_image=getProductNumberImage($pdId);
$j=1;
//while ($rang=mysql_fetch_array($pdImage)){
// mysql_fetch_array() crée un tableau avec les lignes du résultat
//$date=$rang['pd_image'];
//echo $rang['pd_image']."<br>";
//$j=$j+1;
//}

// we have $pd_name, $ta_price, $pd_description, $pd_image, $cart_url
extract($product);
$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
?> 

<link rel="stylesheet" href="php_includes/bjqs.css">
    <link rel="stylesheet" href="php_includes/demo.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="php_includes/js/bjqs-1.3.min.js"></script>


<!-- Table product detail d --> 
<!-- <form action="<? echo $shoppingReturnUrl ?>" METHOD="POST"> -->
<form action="Store.php" METHOD="POST">
<table height="700" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
			<table border="0">
				<tr >
					<td  align="center"><font color="grey"  size="5"><?php echo $pd_name;?> </font>
					</td>
					
				</tr>
				
				<tr valign="top"  style=" padding:8px;  "> 
					<td width="650" valign="top" align="center" style=" padding:5px;">
<!--						<a href=<?php echo '"'.$pd_image_large. '"' ?> target="_blank" > -->
						<!--<a href=<?php echo '"'.$pd_image_large. '"' ?> rel="lightbox" title=<?php echo '"'.$pd_name. '"' ?>>-->

                                                      <?php 
                                                          if($nb_image>0){?>
                                     <div id="banner-fade">

                                   <!-- start Basic Jquery Slider -->
                                              <ul class="bjqs">
<li><img src="<?php echo $pd_image?>"   style="max-width: auto; height: 100%;"   border="0" alt="<?php echo htmlspecialchars ($pd_name); ?>"></li>
                                              <?php 
while ($rang=mysql_fetch_array($pdImage)){
            //   echo "<li> <img src =\"image_uploaded/".$rang['pd_image']."\" class=\"im\"></li>";
                  $f="/image_uploaded/".$rang['pd_image'];?>
                 <li> <img src ="<?php echo $f;?>" style="max-width: auto; height: 100%;" class="im"></li>
                               <?php }
                                                 ?>
                                                
                                                
                                                



                                              </ul>
        <!-- end Basic jQuery Slider -->

      </div>
                                                         <?php }
                                                       else{
                                                           ?>
<!--<img src=<?php echo '"'.$pd_image. '"' .SetImageDimensions ($pd_image,640,300)?> border="0" alt="<?php echo $pd_name; ?>">-->


<img src="<?php echo $pd_image. '"' .SetImageDimensions($pd_image,640,200);?> border="0" alt="<?php echo htmlspecialchars ($pd_name); ?>"/>
<?php
                                                           }
                                                           ?>

						<!-- </a>-->

<script class="secret-source">
        //jQuery('.im').width(440);
        //jQuery('.im').height(200);
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 200,
            width       : 640,
            responsive  : false
          });

        });
      </script>
					</td>
					
				</tr>
				<tr>
					<td  style=" padding-left:5px; padding-right:5px; padding-top:20px;  "colspan="2" ><?php echo $pd_description; ?>
					</td>
				</tr>
				<tr>
					<td style=" padding-left:5px; padding-right:5px; padding-top:10px;" colspan="2" ><?php echo $pd_description2; ?>
					</td>
				</tr>
			</table>	
		</td>	
		<td width="174" align="left" valign="top">
			<div style="background: -moz-linear-gradient(center top , rgb(255, 255, 255), rgb(232, 233, 234)) repeat scroll 0% 0% transparent; position: absolute; z-index: -1; height: 700px; width: 174px; background: -webkit-linear-gradient(rgb(255, 255, 255), rgb(232, 233, 234)); filter: progid:DXImageTransform.Microsoft.gradient (startColorstr='#fcfcfc',endColorstr='#e8e9ea'); "> 
			</div>
			<table width="100%" border="0">
				<tr>
				<td align="center"> 
				</br>
				</br>
				</br>
				</br>
				</br>

				<table>
				
				<?php 
				$product = new ProductInfo();
				$product->setPdid($pdId);
				$ta_price = $product->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
				if ($ta_price > 0) {
					if(!isset($_SESSION['session_name'])){
						$product->setPdid($pdId);
						$ta_price = $product->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
				 
				?>
				 		<tr>
							<td style="text-align: right">
								<h4><?php echo db_get_text($lang, 'all', 'public_price_product');?></h4>
							</td>
						</tr>
						<tr>
							<td style="text-align: right">
								<?php echo displayAmount($ta_price);?>
							</td>
						</tr>
				<?php
					}
					if(isset($_SESSION['session_name'])){
				 	
					 	$customer=new Customer($_SESSION['session_name'],null,null,null);
					 	$customer_price=$product->getPrice($customer->getType());
					 	if($customer_price>0) {
					        	if($customer->getType()!=ID_DEFAULT_CUSTOMER_TYPE){
			 	?>
								<tr>
									<td style="text-align: right">
				 						<h4><?php  echo db_get_text($lang, 'all', 'public_price_product');?></h4>
									</td>
								</tr>
				 
								<tr>
									<td style="text-align: right;
										<?php if(isset($_SESSION['session_name'])) echo 'text-decoration: line-through;';?>">
										<h3>
										<?php echo displayAmount($ta_price);}?>
										</h3>
									</td>
								</tr>
                                				<tr>
									<td style="text-align: right">
										<h4>
										<?php echo db_get_text($lang, 'all', 'customer_price');?>
										</h4>
									</td>
								</tr>
								<tr>
									<td style="text-align: right">
										<h3>
										<?php 
											echo displayAmount($customer_price);
											$ta_price=$customer_price;
										?>
										</h3>
									</td>
								</tr>
					<?php
							 } else {
					?>
								<tr> 
									<td style="text-align: right">
										<h3>
										<?php 
											echo displayAmount($ta_price);
							}
						}
					?>
										</h3>
									</td>
								</tr>
					<?php 

						} else {
					?>
				 
				                <!-- <tr> <td style="text-align: right"><?php echo displayAmount($ta_price);?></td></tr>
					<?php 
						}
					?>
				
				</table>
				</br>
				<table align='center'>
				<tr>
				<td width="174">
				<?php
				if ($ta_price > 0) {
				  if ((isSet($pd_vo_group)) && ($pd_vo_group >= 0)) {
					echo "<input name='txtQty' type='hidden' value='1'>";
					echo db_return_text($lang, 'store', 'voucher');
					echo ": </td><td> <input size='8' name='txtVoucher' type='text'>";
				  } else {
					echo db_return_text($lang,'store','cart_quantity'); 
					echo ": </td> <td> <select name='txtQty'>";
					for ($i = 1; $i <= 50; $i++) {
						if (isSet($pd_default_order_qty)) {
							if ($i == $pd_default_order_qty) {
								echo "<option value='$i' selected>$i</option>";
							} else {
								echo "<option value='$i'>$i</option>";		
							}
						} else {
							if ($i == 1) {
                                                                echo "<option value='$i' selected>$i</option>";
                                                        } else {
                                                                echo "<option value='$i'>$i</option>";  
                                                        }
						}
					 }
				   	echo "</select>";
				  }
				}
				?>
				</td>
				</tr>
				<tr colspan="2">
			<td colspan="2" valign="top" align="center" style=" padding-top:10px;" >
				<?php getSingleProductItemList($catId,$pdId,$lang); ?>	
			</td>
			</tr>	
				</table>
	
				<?php
				$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
		
				// if we still have this product in stock
				// show the 'Add to cart' button
				if (($ta_price > 0) && ($pd_qty <= 0)) {
					// don't show any stock value at all as long as the back-office system is not ready for it
					//echo 'Out Of Stock';
				}	
				?>
<? if ($ta_price >0) { ?>
<input type='hidden' name='p' value=<?php echo $pdId; ?>>	
<input type='hidden' name='c' value='<?php echo $catId; ?>'>	
<input type='hidden' name='action' value='add'>	
<input type='submit' name='<?php db_get_text($lang, 'store', 'cart_add'); ?>' value='<?php db_get_text($lang, 'store', 'cart_add'); ?>   ' style=" background:url(images/button_add.png);background-size:130px 35px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 130px; height: 35px; margin-top: 10px;" alt=<?php db_get_text($lang, 'store', 'cart_add'); ?> title="<?php db_get_text($lang, 'store', 'cart_add_desc'); ?>"</input>
<? } ?>
<!--			<img src="images/payment_logo.png" style=" align:center; width: 150px; margin-top: 12px; ">
			<h4 style="margin-top: 12px"><?php db_get_text($lang,'store','secure_payment'); ?></h4> -->
				<br>	
				<br>	
				<br>	
				</form> 
<!--               		        <form action='expresscheckout.php' METHOD='POST'>
                                	<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' alt='Check out with PayPal'/>
                        	</form>
-->			<?php
//			} else {
//				echo 'Out Of Stock';
//			}		
			?>
			</td>
			</tr>
			</table>
		</td>
	</tr>		
</table>
