<?php
require_once 'php_includes/product-functions.php';
if (!defined('PRODUCT_IMAGE_DIR')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

$sql = "SELECT cat_reference, pd_reference, ta_price, pd_qty, pd_image
        FROM tbl_product pd, tbl_category cat, tbl_tariff ta
		WHERE pd.pd_id = $productId 
		AND pd.cat_id = cat.cat_id
		AND pd.pd_id = ta.ta_pd_id
		AND ta.ta_category = 0";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);

if ($pd_image) {
	$pd_image = "/".PRODUCT_IMAGE_DIR."/" . $pd_image;
} else {
	$pd_image = "/".PRODUCT_SMALL_IMAGE_DIR . '/no-image-small.png';
}


?>

    <link rel="stylesheet" href="../../php_includes/bjqs.css">
    <link rel="stylesheet" href="../../php_includes/demo.css">
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="../../php_includes/js/bjqs-1.3.min.js"></script>

<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category Ref</td>
   <td class="content"><?php echo $cat_reference; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Product Reference</td>
   <td class="content"> <?php echo $pd_reference; ?></td>
  </tr>
  <tr> 
   <td width="150" height="36" class="label">Price</td>
   <td class="content"><?php echo number_format($ta_price, 2); ?> </td>
  </tr>
  <tr> 
   <td width="150" height="36" class="label">Price Retail</td>
   <td class="content"><?php echo "nc"; ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Qty In Stock</td>
   <td class="content"><?php echo number_format($pd_qty); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content">
<!--- --------------------------------------------------------------------->
<?php 
$pdImage=getProductItemImageDetail($_GET['productId']);
                                                          if(getProductNumberImage($_GET['productId'])>0){?>
                                     <div id="banner-fade">

                                   <!-- start Basic Jquery Slider -->
                                              <ul class="bjqs">
                       
                                              <?php 
echo "<li><img src='".$pd_image."' class=\"im\"/></li>";
while ($rang=mysql_fetch_array($pdImage)){
     $f="/image_uploaded/".$rang['pd_image'];?>
<li> <img src =<?php echo '"'.$f. '"' .SetImageDimensions ($f,440,200)?> class="im"></li>
<?php
               
                                }
                                                 ?>
                                                
                                               
                                                
                                          <?php }else{
                                       echo "<img src='".$pd_image."' class=\"im\"/>";
}?>


                                              </ul>
        <!-- end Basic jQuery Slider -->

      </div>
                                                        

                                                           
<!-------------------------------------------------------------------------->
<script class="secret-source">
        jQuery('.im').width(380);
        jQuery('.im').height(170);
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 170,
            width       : 380,
            responsive  : false
          });

        });
      </script>
</td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="window.location.href='index.php?view=modify&productId=<?php echo $productId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" class="box">
 </p>
</form>
