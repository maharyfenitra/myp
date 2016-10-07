<?php
require '../../php_includes/language.php';
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

// get product info
$sql = "SELECT pd.cat_id, pd_reference, ta_price, pd_qty, pd_image, pd_thumbnail, pd_last_update, pd_active, pd_display_order
        FROM tbl_product pd, tbl_category cat, tbl_tariff ta
	WHERE pd.pd_id = $productId 
	AND pd.cat_id = cat.cat_id
	AND pd.pd_id = ta.ta_pd_id
	AND ta.ta_category = 0";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

// get product item list 
$sql = "SELECT pi.pi_id, pi.pi_flavor, pi_flavor_display_order, pi_stock_qty, pi_weight, pi_shipping_weight
        FROM tbl_product_item pi
                WHERE pi.pi_pd_id = $productId
		ORDER by pi_flavor_display_order";
$result = dbQuery($sql) or die('Cannot get Product Items. ' . mysql_error());; 
$product_items  = array();

while($row = dbFetchArray($result)) {
	list($id, $flavor, $flavor_display_order, $stock_qty, $weight, $shipping_weight) = $row;
	$product_items[$id] = array(
		'id' => $id, 
		'flavor' => $flavor, 
		'flavor_display_order' => $flavor_display_order, 
		'stock_qty' => $stock_qty, 
		'weight' => $weight, 
		'shipping_weight' => $shipping_weight);
}

$n=0;
$product_item_list = '<tr><th colspan=6>PRODUCT ITEMS</th></tr>';
$product_item_list .= '<tr><th>id</th><th>flavor</th><th>display<br> order</th><th>stock<br>qty</th><th>weight</th><th>shipping<br>weight</th></tr>';
foreach ($product_items as  $key => $value) {
	 $n = $n + 1;
	 $id = $value['id'];
	 $flavor = $value['flavor'];
	 $flavor_display_order = $value['flavor_display_order'];
	 $stock_qty = $value['stock_qty'];
	 $weight = $value['weight'];
	 $shipping_weight = $value['shipping_weight'];

//	 if ($weight > 0) {

		 $product_item_list .= "<tr><td>$id<input type='hidden' name='pi_id[]' value='$id'></td><td><input type='text' name='pi_flavor[]' value='$flavor' size='8'></td><td><input type='text' name='pi_flavor_display_order[]' value='$flavor_display_order' size='5'></td><td><input type='text' name='pi_stock_qty[]' value='$stock_qty' size='5'></td><td><input type='text' name='pi_weight[]' value='$weight' size='5'></td><td><input type='text' name='pi_shipping_weight[]' value='$shipping_weight' size='5'></td><td><a href='javascript:deleteProductItem(".$id.",".$productId.")'>x</a></td></tr>"; 

//	}
}

for ($i = $n; $i <= $n + max((10 - $n),5); $i++) {
	 $product_item_list .= "<tr><td><input type='hidden' name='pd_id[]' value='$productId'></td><td><input type='text' name='pi_flavor_new[]' value='' size='8'></td><td><input type='text' name='pi_flavor_display_order_new[]' value='' size='5'></td><td><input type='text' name='pi_stock_qty_new[]' value='' size='5'></td><td><input type='text' name='pi_weight_new[]' value='' size='5'></td><td><input type='text' name='pi_shipping_weight_new[]' value='' size='5'></td></tr>"; 
}

// get language item list - NAME 
$sql = "SELECT lang, page, item, text, url
        FROM language_items li
                WHERE li.item = 'product_".$pd_reference."_name'
                ORDER by lang desc";
$result = dbQuery($sql) or die('Cannot get language items name. ' . mysql_error());;
$language_items  = array();

while($row = dbFetchArray($result)) {
        list($lang, $page, $item, $text, $url) = $row;
        $language_items[$lang] = array(
                'lang' => $lang,
                'page' => $page,
                'item' => $item,
                'text' => $text,
                'url' => $url);
}

$n=0;
$language_item_list_name = '<tr><th colspan=3>NAME</th></tr>';
$language_item_list_name .= '<tr><th>lang</th><th>text</th><th>url</th></tr>';
foreach ($language_items as  $key => $value) {
         $n = $n + 1;
         $lang = $value['lang'];
         $page = $value['page'];
         $item = $value['item'];
         $text = $value['text'];
         $url = $value['url'];

//        if (strcmp($text,'') >= 0 )  {
                 $language_item_list_name .= "<tr><td><input type='hidden' name='name_lang[]' value='$lang' size='2'>$lang<input type='hidden' name='name_page[]' value='$page'><input type='hidden' name='name_item[]' value='$item' size='5'></td><td><textarea rows='5' name='name_text[]' cols='60'>$text</textarea></td><td><input type='text' name='name_url[]' value='$url' size='5'></td><td><a href='javascript:deleteLanguageItem(\"".$lang."\",\"".$item."\",".$productId.")'>x</a></td></tr>";

//        }
}

for ($i = $n; $i <= $n + max((3 - $n),2); $i++) {
         $language_item_list_name .= "<tr><td><select name='new_name_lang[]'>".getLangSelectOptionString()."</select><input type='hidden' name='new_name_page[]' value='store'><input type='hidden' name='new_name_item[]' value='product_".$pd_reference."_name'></td><td><textarea rows='5' name='new_name_text[]' cols='60'></textarea></td><td><input type='text' name='new_name_url[]' value='' size='5'></td></tr>";
}



// get language item list - DESCRIPTION 1
$sql = "SELECT lang, page, item, text, url
        FROM language_items li
                WHERE li.item = 'product_".$pd_reference."_desc'
                ORDER by lang desc";
$result = dbQuery($sql) or die('Cannot get language items desc. ' . mysql_error());;
$language_items  = array();

while($row = dbFetchArray($result)) {
        list($lang, $page, $item, $text, $url) = $row;
        $language_items[$lang] = array(
                'lang' => $lang,
                'page' => $page,
                'item' => $item,
                'text' => $text,
                'url' => $url);
}

$n=0;
$language_item_list_desc = '<tr><th colspan=3>DESCRIPTION</th></tr>';
$language_item_list_desc .= '<tr><th>lang</th><th>text</th><th>url</th></tr>';
foreach ($language_items as  $key => $value) {
         $n = $n + 1;
         $lang = $value['lang'];
         $page = $value['page'];
         $item = $value['item'];
         $text = $value['text'];
         $url = $value['url'];

//        if (strcmp($text,'') >= 0 )  {

                 $language_item_list_desc .= "<tr><td><input type='hidden' name='desc_lang[]' value='$lang' size='2'>$lang<input type='hidden' name='desc_page[]' value='$page'><input type='hidden' name='desc_item[]' value='$item' size='5'></td><td><textarea rows='5' name='desc_text[]' cols='60'>$text</textarea></td><td><input type='text' name='desc_url[]' value='$url' size='5'></td><td><a href='javascript:deleteLanguageItem(\"".$lang."\",\"".$item."\",".$productId.")'>x</a></td></tr>";

//        }
}

for ($i = $n; $i <= $n + max((3 - $n),2); $i++) {
         $language_item_list_desc .= "<tr><td><select name='new_desc_lang[]'>".getLangSelectOptionString()."</select><input type='hidden' name='new_desc_page[]' value='store'><input type='hidden' name='new_desc_item[]' value='product_".$pd_reference."_desc'></td><td><textarea rows='5' name='new_desc_text[]' cols='60'></textarea></td><td><input type='text' name='new_desc_url[]' value='' size='5'></td></tr>";
}



// get language item list - DESCRIPTION 2
$sql = "SELECT lang, page, item, text, url
        FROM language_items li
                WHERE li.item = 'product_".$pd_reference."_desc2'
                ORDER by lang desc";
$result = dbQuery($sql) or die('Cannot get language items desc. ' . mysql_error());;
$language_items  = array();

while($row = dbFetchArray($result)) {
        list($lang, $page, $item, $text, $url) = $row;
        $language_items[$lang] = array(
                'lang' => $lang,
                'page' => $page,
                'item' => $item,
                'text' => $text,
                'url' => $url);
}

$n=0;
$language_item_list_desc2 = '<tr><th colspan=3>DESCRIPTION 2</th></tr>';
$language_item_list_desc2 .= '<tr><th>lang</th><th>text</th><th>url</th></tr>';
foreach ($language_items as  $key => $value) {
         $n = $n + 1;
         $lang = $value['lang'];
         $page = $value['page'];
         $item = $value['item'];
         $text = $value['text'];
         $url = $value['url'];

//        if (strcmp($text,'') >= 0 )  {

                 $language_item_list_desc2 .= "<tr><td><input type='hidden' name='desc2_lang[]' value='$lang' size='2'>$lang<input type='hidden' name='desc2_page[]' value='$page'><input type='hidden' name='desc2_item[]' value='$item' size='5'></td><td><textarea rows='5' name='desc2_text[]' cols='60'>$text</textarea></td><td><input type='text' name='desc2_url[]' value='$url' size='5'></td><td><a href='javascript:deleteLanguageItem(\"".$lang."\",\"".$item."\",".$productId.")'>x</a></td></tr>";

//        }
}

for ($i = $n; $i <= $n + max((3 - $n),2); $i++) {
         $language_item_list_desc2 .= "<tr><td><select name='new_desc2_lang[]'>".getLangSelectOptionString()."</select><input type='hidden' name='new_desc2_page[]' value='store'><input type='hidden' name='new_desc2_item[]' value='product_".$pd_reference."_desc2'></td><td><textarea rows='5' name='new_desc2_text[]' cols='60'></textarea></td><td><input type='text' name='new_desc2_url[]' value='' size='5'></td></tr>";
}



// get category list
$sql = "SELECT cat_id, cat_parent_id, cat_reference
        FROM tbl_category
		ORDER BY cat_id";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

$categories = array();
while($row = dbFetchArray($result)) {
	list($id, $parentId, $name) = $row;
	
	if ($parentId == 0) {
		$categories[$id] = array('name' => $name, 'children' => array());
	} else {
		$categories[$parentId]['children'][] = array('id' => $id, 'name' => $name);	
	}
}	

//echo '<pre>'; print_r($categories); echo '</pre>'; exit;

// build combo box options
$list = '';
foreach ($categories as $key => $value) {
	$name     = $value['name'];
	$children = $value['children'];
	
	$list .= "<optgroup label=\"$name\">"; 
	
	foreach ($children as $child) {
		$list .= "<option value=\"{$child['id']}\"";
		
		if ($child['id'] == $cat_id) {
			$list .= " selected";
		}
		$list .= ">{$child['name']}</option>";
	}
	
	$list .= "</optgroup>";
}
?> 
<form action="processProduct.php?action=modifyProduct&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <p align="center" class="formTitle">Modify Product</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- Choose Category --</option>
<?php
	echo $list;
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">Product Reference</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $pd_reference; ?>" size="50" maxlength="100"></td>
   <td class="content"> <input name="txtOldName" type="hidden" class="box" id="txtOldName" value="<?php echo $pd_reference; ?>" ></td>
  </tr>
  <tr> 
   <td width="150" class="label">Price</td>
   <td class="content"><input name="txtPrice" type="text" class="box" id="txtPrice" value="<?php echo $ta_price; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Price Retail</td>
   <td class="content"><input name="txtPriceRetail" type="text" class="box" id="txtPriceRetail" value="<?php echo "nc"; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr>
   <td width="150" class="label">Display Order</td>
   <td class="content"><input name="txtDisplayOrder" type="text" class="box" id="txtDisplayOrder" value="<?php echo $pd_display_order; ?>" size="5" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Thumbnail</td>
   <td class="content"> <input name="imageName" type="hidden" id="imageName" class="box" size="60" value="<?php echo $pd_thumbnail;?>">
<!--   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box"> -->
<?php
	if ($pd_thumbnail != '') {
?>
    <br>
    <img src="<?php echo "/".PRODUCT_IMAGE_DIR . $pd_thumbnail; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $productId; ?>);">Delete 
    Image </a> 
    <?php
	}
         else{echo "There is no thumbnail";}
?>    
    </td>
  </tr> 
<tr><td width="150" class="label">Add new image</td><td width="150" class="content"><a href="addImage.php?pd_id=<?php echo $_GET['productId'];?>">new image</a></td></tr>
  <tr>
   <td width="150" class="label">Active</td>
<?php
  if ( isSet($_SESSION['plaincart_user_level']) && ($_SESSION['plaincart_user_level'] == 0 )) {
        if ($pd_active == 1) {
		echo '<input name="active" type="hidden" class="box" id="active" value="0" > ';
		echo '<td class="content"><input name="active" type="checkbox" class="box" id="active" value="1" checked> </td>';
	} else {
		echo '<input name="active" type="hidden" class="box" id="active" value="0" > ';
		echo '<td class="content"><input name="active" type="checkbox" class="box" id="active" value="1" > </td>';
	}
  } else {
	echo "<td class='content'>$pd_active </td>";
  }
?>
  </tr>
  <tr> 
   <td width="150" class="label">Last Update</td>
   <td class="content"><?php echo $pd_last_update; ?> </td>
  </tr>
 </table>
 <table>
	<?php echo $product_item_list; ?>
 </table>
 <table>
        <?php echo $language_item_list_name; ?>
 </table>
 <table>
	<?php echo $language_item_list_desc; ?>
 </table>
 <table>
	<?php echo $language_item_list_desc2; ?>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
