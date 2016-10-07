<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/php_includes/product-functions.php';


include '../../customer/library/admin_customer.php';
  $productinfo= new ProductInfo();
  //$productinfo->setPdid($_GET['pd_id']);
   $admin = new AdminCustomer();
  $alltype=$admin->getAllType();
  $ref = $productinfo->getPDReference();












if (!defined('PRODUCT_IMAGE_DIR')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
if (!defined('ROWS_PER_PAGE')) {
	$rowsPerPage = 20;
	$rowsPerPage = 10000;
} else {
	$rowsPerPage = ROWS_PER_PAGE;
	$rowsPerPage = 10000;
}

$proinfo = new ProductInfo();
/*$sql = "SELECT pd_id, c.cat_id, cat_reference, pd_reference, pd_thumbnail, pd_active, ta_price, pd_display_order
        FROM tbl_product p, tbl_category c, tbl_tariff ta
		WHERE p.cat_id = c.cat_id $sql2
		AND p.pd_id = ta.ta_pd_id
		AND ta.ta_category = 0
		ORDER BY pd_display_order";*/
		
		$sql = "SELECT pd_id, c.cat_id, cat_reference, pd_reference, pd_thumbnail, pd_active, ta_price, pd_display_order
        FROM tbl_product p, tbl_category c, tbl_tariff ta
		WHERE p.cat_id = c.cat_id $sql2
		AND p.pd_id = ta.ta_pd_id
		AND ta.ta_category = 0
		ORDER BY c.cat_id";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));

//print_r($result);
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 
<script>
function addType(){ 
  var reponse = prompt("Please enter the new type", "");
	window.location="cycle.php?addtype="+reponse+"";
	}
</script>

<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="left"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Product" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
   <td align="right">View products in : 
    <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
     <option selected>All Category</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td width="75">PD ID</td>
   <td width="75">Category</td>
   <td>Product Reference</td>
   <td width="75">Thumbnail</td>
   <td width="70">Clone</td>
   <td width="70">Modify</td>
   <td width="70">Display Order</td>
   <td width="70">Delete</td>
   
   
   <td width="70">Active</td>
   <td width="70">Add Image</td>
   <td width="70">Number</td>
   
   <?php 
$i=0;
foreach($alltype as $type){
  $i++;
  $new_value="V_".$i;
  $type__="t_".$i;
	?>
<td  class="label" width="50px"><?php echo $type['label'];?><!--<a href="cycle.php?delete__=<?php echo $admin->getIdTypeFor($type['label']);?>">x</a>--></td>
<!---<input type="text" name='V_<?php echo $i;?>' value='<?php echo $productinfo->getPrice($admin->getIdTypeFor($type['label']));?>' align="right"style="text-align:right;" class="box" /></td>
<td class="label"><a href="cycle.php?delete__=<?php echo $admin->getIdTypeFor($type['label']);?>&&pd_id=<?php echo $_GET['pd_id'];?>">delete</a></td>-->


<?php }?>

    
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
	//////////////////////////::print_r($row);
		extract($row);
		
		if ($pd_thumbnail) {
                        //<h1>echo "EEEEEEE"$pd_image;</h1>  $_SERVER['DOCUMENT_ROOT']
                               
			$pd_thumbnail = "".PRODUCT_SMALL_IMAGE_DIR . $pd_thumbnail;
		} else {
			$pd_thumbnail = "".PRODUCT_SMALL_IMAGE_DIR . 'no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
		$proinfo->setPdid($pd_id);
		$ta_price = $proinfo->getPrice(3);
		if($ta_price == ''){
		   $ta_price ='INDEFINY';
		}
?>


  <tr class="<?php echo $class; ?>"> 
   <td width="75"><?php echo $pd_id; ?></td>
   <td width="75" align="center"><a href="?c=<?php echo $cat_id; ?>"><?php echo $cat_reference; ?></a></td>
   <td><a href="index.php?view=detail&productId=<?php echo $pd_id; ?>"><?php echo $pd_reference; ?></a></td>
   <td width="75" align="center"><img src="<?php echo $pd_thumbnail; ?>"></td>
   <td width="70" align="center"><a href="javascript:cloneProduct(<?php echo $pd_id; ?>);">Clone</a></td>
   <td width="70" align="center"><a href="javascript:modifyProduct(<?php echo $pd_id; ?>);">Modify</a></td>
   <td width="70" align="center"><?php echo $pd_display_order; ?></td>
   <td width="70" align="center"><a href="javascript:deleteProduct(<?php echo $pd_id; ?>,<?php echo $catId; ?>);">Delete</a></td>
   <!---<td width="70" align="center"><a href="javascript:PopupWindow(this,'index.php?view=price&pd_id=<?php echo $pd_id; ?>');"><?php echo $ta_price; ?></a></td>-->
   
   <td width="70" align="center"><?php echo $pd_active; ?></td>
   <td width="70"><a href="javascript:PopupWindow(this,'index.php?view=addImage&&pd_id=<?php echo $pd_id; ?>');">Add Image</a></td>
   <td width="70" align="center"><?php echo getProductNumberImage($pd_id); ?></td>
   
   
   
   <script>
     var MonTableau = new Array();
     var count =0;
     var pid="<?php echo $pd_id;?>";
   </script>
   
   
   <?php 
$i=0;
$productinfo->setPdid($pd_id);
foreach($alltype as $type){
  $i++;
  $new_value="V_".$i;
  $type__="t_".$i;
	?>
<td class="pdprice" alt="<?php echo $pd_id.'-'.$admin->getIdTypeFor($type['label']);?>" align="right">
    <?php echo $productinfo->getPrice($admin->getIdTypeFor($type['label']));?>
</td>



<?php }
$catid='';
if(isset($_GET['catId'])){
    $catid=$_GET['catId'];
    }

?>
   
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Products Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Product" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
<script type="text/javascript">
  
  $(".pdprice").click(function (){
    var pdi = $(this).attr("alt").split("-");
      $(this).html("<input type='text' id='pricein' style='text-align:right;' class='box' value='"+$(this).html()+"' />");
          $("#pricein").focus();
              var current = $(this);
              $("#pricein").blur(function (){
              var val=$(this).val();
              current.html(val);
              $.post("cycle.php",{"update_price_by_ajax":1,"pd_id" : pdi[0],"tid": pdi[1],"val" : val},function(data){
                  console.log(data);
              });

      });
   
  })
</script>

