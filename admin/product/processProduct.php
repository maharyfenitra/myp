<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';
include '../../customer/library/product_info.php';
include '../../customer/library/admin_customer.php';
  
  
  
  
  
checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addProduct' :
		addProduct();
		break;
		
	case 'cloneProduct' :
		cloneProduct();
		break;
		
	case 'modifyProduct' :
		modifyProduct();
		break;
		
	case 'deleteProduct' :
		deleteProduct();
		break;
	
	case 'deleteProductItem' :
		deleteProductItem();
		break;
	
	case 'deleteLanguageItem' :
		deleteLanguageItem();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
    

	default :
	    // if action is not defined or unknown
		// move to main product page
		header('Location: index.php');
}

function addSlashTopSkates($parameter){
  if(is_array ($parameter)){
       $newArray = array_map("mysql_real_escape_string", $parameter);
       return $newArray;
    }
    return mysql_real_escape_string ($parameter);
}


function text2HTML($text)
{
        $text = htmlentities($text, ENT_NOQUOTES, "iso-8859-1");
        $text = htmlspecialchars_decode($text);
        return $text;
}

function addProduct()
{
    $catId       = addSlashTopSkates($_POST['cboCategory']);
    $mainImage    = addSlashTopSkates($_POST['imageName']);
    $name        = addSlashTopSkates($_POST['txtName']);
//	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', (double)$_POST['txtPrice']);
	$price_retail       = str_replace(',', '', (double)$_POST['txtPriceRetail']);
//	$qty         = (int)$_POST['txtQty'];
	
//	$images = uploadProductImage('fleImage', SRV_ROOT . 'images/product/');

//	$mainImage = $images['image'];
//	$thumbnail = $images['thumbnail'];
	
	$sql   = "INSERT INTO tbl_product (cat_id, pd_reference, pd_image, pd_thumbnail, pd_image_large, pd_date)
	          VALUES ('$catId', '$name', '$mainImage', '$mainImage', '$mainImage', NOW())";

	$result = dbQuery($sql);
	$product_id = mysql_insert_id();  // product id that was generated by the current insert statement in tbl_product

	$sql   = "INSERT INTO tbl_tariff (ta_id, ta_pd_id, ta_category, ta_price, ta_date, ta_last_update, ta_active)
	 VALUES (NULL, '$product_id', 0, '$price', NOW(), NOW(), 1)";

	$result = dbQuery($sql);
	
	header("Location: index.php?catId=$catId");	
}

/*
	Upload an image and return the uploaded image name 
*/
function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
			
			// create thumbnail failed, delete the image
			if (!$result) {
//				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the product cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Modify a product
*/
function modifyProduct()
{

// READ IN HTTP parameters
    $productId   = (int)$_GET['productId'];
    $catId       = addSlashTopSkates($_POST['cboCategory']);
    $name        = addSlashTopSkates($_POST['txtName']);
    $oldName     = addSlashTopSkates($_POST['txtOldName']);
    $displayOrder = addSlashTopSkates($_POST['txtDisplayOrder']);
    $mainImage   = addSlashTopSkates($_POST['imageName']);
    $active      = $_POST['active'];

    if (isSet($_POST['pi_id'])) {
	$productItemId = $_POST['pi_id'];
	$productItemFlavor = $_POST['pi_flavor'];
	$productItemFlavorDisplayOrder = $_POST['pi_flavor_display_order'];
	$productItemStockQty = $_POST['pi_stock_qty'];
	$productItemWeight =  $_POST['pi_weight'];
	$productItemShippingWeight =  $_POST['pi_shipping_weight'];
    }
    $new_productId = $_POST['pd_id'];
    $new_productItemFlavor = $_POST['pi_flavor_new'];
    $new_productItemFlavorDisplayOrder = $_POST['pi_flavor_display_order_new'];
    $new_productItemStockQty = $_POST['pi_stock_qty_new'];
    $new_productItemWeight =  $_POST['pi_weight_new'];
    $new_productItemShippingWeight =  $_POST['pi_shipping_weight_new'];

    if (isSet($_POST['name_lang'])) {
	$nameLang = addSlashTopSkates($_POST['name_lang']);
	$namePage = addSlashTopSkates($_POST['name_page']);
	$nameItem = addSlashTopSkates($_POST['name_item']);
	$nameText = addSlashTopSkates($_POST['name_text']);
	$nameUrl =  addSlashTopSkates($_POST['name_url']);
    }
    $new_nameLang = addSlashTopSkates($_POST['new_name_lang']);
    $new_namePage = addSlashTopSkates($_POST['new_name_page']);
    $new_nameItem = addSlashTopSkates($_POST['new_name_item']);
    $new_nameText = addSlashTopSkates($_POST['new_name_text']);
    $new_nameUrl =  addSlashTopSkates($_POST['new_name_url']);

    if (isSet($_POST['desc_lang'])) {
	$descLang = addSlashTopSkates($_POST['desc_lang']);
	$descPage = addSlashTopSkates($_POST['desc_page']);
	$descItem = addSlashTopSkates($_POST['desc_item']);
	$descText = addSlashTopSkates($_POST['desc_text']);
	$descUrl =  addSlashTopSkates($_POST['desc_url']);
    }
    $new_descLang = addSlashTopSkates($_POST['new_desc_lang']);
    $new_descPage = addSlashTopSkates($_POST['new_desc_page']);
    $new_descItem = addSlashTopSkates($_POST['new_desc_item']);
    $new_descText = addSlashTopSkates($_POST['new_desc_text']);
    $new_descUrl =  addSlashTopSkates($_POST['new_desc_url']);

    if (isSet($_POST['desc2_lang'])) {
	$desc2Lang = addSlashTopSkates($_POST['desc2_lang']);
	$desc2Page = addSlashTopSkates($_POST['desc2_page']);
	$desc2Item = addSlashTopSkates($_POST['desc2_item']);
	$desc2Text = addSlashTopSkates($_POST['desc2_text']);
	$desc2Url =  addSlashTopSkates($_POST['desc2_url']);
    }
    $new_desc2Lang = addSlashTopSkates($_POST['new_desc2_lang']);
    $new_desc2Page = addSlashTopSkates($_POST['new_desc2_page']);
    $new_desc2Item = addSlashTopSkates($_POST['new_desc2_item']);
    $new_desc2Text = addSlashTopSkates($_POST['new_desc2_text']);
    $new_desc2Url =  addSlashTopSkates($_POST['new_desc2_url']);


        $price       = str_replace(',', '', $_POST['txtPrice']);
        $price_retail       = str_replace(',', '', $_POST['txtPriceRetail']);
        
        // if uploading a new image
        // remove old image
        if ($mainImage != '') {
                $mainImage = "'$mainImage'";
        } else {
                // if we're not updating the image
                // make sure the old path remain the same
                // in the database
                $mainImage = 'pd_image';
        }
                        
        $sql   = "UPDATE tbl_product 
                  SET cat_id = $catId, pd_reference = '$name',  
                              pd_image = $mainImage, pd_thumbnail = $mainImage, pd_image_large = $mainImage, pd_last_update=now(), pd_active = $active, pd_display_order = $displayOrder
                          WHERE pd_id = $productId";

        $result = dbQuery($sql);

        $sql   = "UPDATE tbl_tariff
                  SET ta_price = $price
                  WHERE ta_pd_id = $productId
		  AND ta_category = 0";

        $result = dbQuery($sql);



// PRODUCT ITEM SQL Statements

$sql='';

    if (isSet($productItemWeight)) {
	 $numProductItemEntries    = count($productItemWeight); 
    
   	 for ($i = 0; $i < $numProductItemEntries; $i++) { 
		$sql = "UPDATE tbl_product_item
			SET     pi_flavor = '$productItemFlavor[$i]',
				pi_flavor_display_order = '$productItemFlavorDisplayOrder[$i]',
				pi_stock_qty = $productItemStockQty[$i],
				pi_weight = $productItemWeight[$i],
				pi_shipping_weight = $productItemShippingWeight[$i]
			WHERE pi_id = $productItemId[$i]";

		dbQuery($sql);

    	}
    }

$sql='';

    $numProductItemEntries_new    = count($new_productItemWeight); 

    for ($i = 0; $i < $numProductItemEntries_new; $i++) {
	if (!($new_productItemWeight[$i]=='')) {
	        $sql = "INSERT INTO tbl_product_item (pi_pd_id, pi_flavor, pi_flavor_display_order, pi_stock_qty, pi_weight, pi_shipping_weight)
			VALUES ($new_productId[$i],'$new_productItemFlavor[$i]',$new_productItemFlavorDisplayOrder[$i], $new_productItemStockQty[$i], $new_productItemWeight[$i], $new_productItemShippingWeight[$i])";
		dbQuery($sql);
	}

    }

// LANGUAGE ITEM SQL Statements for NAME field

$sql='';
    
    if (isSet($nameText)) {
	$numNameLangEntries    = count($nameText); 

	for ($i = 0; $i < $numNameLangEntries; $i++) {

		$html_text = text2HTML($nameText[$i]);
		$item = str_replace($oldName, $name, $nameItem[$i]);
        	$sql = "UPDATE language_items
               		SET     text = '$html_text',
               		 	url = '$nameUrl[$i]',
				item = '$item'
                	WHERE lang = '$nameLang[$i]'
			AND   page = '$namePage[$i]'
			AND   item = '$nameItem[$i]'";
        	dbQuery($sql);
	}
    }

$sql='';

    $numNameLangEntries_new    = count($new_nameText);

    for ($i = 0; $i < $numNameLangEntries_new; $i++) {
	$html_text = text2HTML($new_nameText[$i]);
	$item = str_replace($oldName, $name, $new_nameItem[$i]);
        if (!($new_nameText[$i]=='') && !($new_nameLang[$i]=='')) {
                $sql = "INSERT INTO language_items (lang, page, item, text, url)
                        VALUES ('$new_nameLang[$i]','$new_namePage[$i]','$item', '$html_text', '$new_nameUrl[$i]')";
                dbQuery($sql);
        }

    }


// LANGUAGE ITEM SQL Statements for DESC field

$sql='';
   
    if (isSet($descText)) {
	$numDescLangEntries    = count($descText);
    
    	for ($i = 0; $i < $numDescLangEntries; $i++) {

		$html_text = text2HTML($descText[$i]);
	 	$item = str_replace($oldName, $name, $descItem[$i]);	
        	$sql = "UPDATE language_items
                	SET     text = '$html_text',
                        	url = '$descUrl[$i]',
				item = '$item'	
                	WHERE lang = '$descLang[$i]'
                	AND   page = '$descPage[$i]'
                	AND   item = '$descItem[$i]'";
        	dbQuery($sql);
	}
    }

$sql='';

    $numDescLangEntries_new    = count($new_descText);

    for ($i = 0; $i < $numDescLangEntries_new; $i++) {
	$html_text = text2HTML($new_descText[$i]);
	$item = str_replace($oldName, $name, $new_descItem[$i]);
        if (!($new_descText[$i]=='') && !($new_descLang[$i]=='')) {
                $sql = "INSERT INTO language_items (lang, page, item, text, url)
                        VALUES ('$new_descLang[$i]','$new_descPage[$i]','$item', '$html_text', '$new_descUrl[$i]')";
                dbQuery($sql);
        }

    }

// LANGUAGE ITEM SQL Statements for DESC2 field

$sql='';

    if (isSet($desc2Text)) {
	$numDesc2LangEntries    = count($desc2Text);
            
	for ($i = 0; $i < $numDesc2LangEntries; $i++) {
        
		$html_text = text2HTML($desc2Text[$i]);
		$item = str_replace($oldName, $name, $desc2Item[$i]);
        	$sql = "UPDATE language_items
                	SET     text = '$html_text',
                        	url = '$desc2Url[$i]',
				item = '$item'
                	WHERE lang = '$desc2Lang[$i]'
                	AND   page = '$desc2Page[$i]'
                	AND   item = '$desc2Item[$i]'";
        
        	dbQuery($sql); 
	}
    }           
                
$sql='';        
        
	$numDesc2LangEntries_new    = count($new_desc2Text);

	for ($i = 0; $i < $numDesc2LangEntries_new; $i++) {
		$html_text = text2HTML($new_desc2Text[$i]);
		$item = str_replace($oldName, $name, $new_desc2Item[$i]);
        	if (!($new_desc2Text[$i]=='') && !($new_desc2Lang[$i]=='')) {
                	$sql = "INSERT INTO language_items (lang, page, item, text, url)
                        	VALUES ('$new_desc2Lang[$i]','$new_desc2Page[$i]','$item', '$html_text', '$new_desc2Url[$i]')";
                	dbQuery($sql);
        	}
	}



	header('Location: index.php?catId='. $catId);
}

/*
        Clone a product
*/
function cloneProduct()
{
// READ IN HTTP parameters
    $productId   = (int)$_GET['productId'];
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
    $oldName     = $_POST['txtOldName'];
    $displayOrder = $_POST['txtDisplayOrder'];
    $mainImage   = $_POST['imageName'];
    $active      = $_POST['active'];

    if (isSet($_POST['pi_id'])) {
        $productItemId = $_POST['pi_id'];
        $productItemFlavor = $_POST['pi_flavor'];
        $productItemFlavorDisplayOrder = $_POST['pi_flavor_display_order'];
        $productItemStockQty = $_POST['pi_stock_qty'];
        $productItemWeight =  $_POST['pi_weight'];
        $productItemShippingWeight =  $_POST['pi_shipping_weight'];
    }
    $new_productId = $_POST['pd_id'];
    
    $new_productItemFlavor = $_POST['pi_flavor_new'];
    $new_productItemFlavorDisplayOrder = $_POST['pi_flavor_display_order_new'];
    $new_productItemStockQty = $_POST['pi_stock_qty_new'];
    $new_productItemWeight =  $_POST['pi_weight_new'];
    $new_productItemShippingWeight =  $_POST['pi_shipping_weight_new'];

    if (isSet($_POST['name_lang'])) {
        $nameLang = addSlashTopSkates($_POST['name_lang']);
        $namePage = addSlashTopSkates($_POST['name_page']);
        $nameItem = addSlashTopSkates($_POST['name_item']);
        $nameText = addSlashTopSkates($_POST['name_text']);
        $nameUrl =  addSlashTopSkates($_POST['name_url']);
    }
    $new_nameLang = addSlashTopSkates($_POST['new_name_lang']);
    $new_namePage = addSlashTopSkates($_POST['new_name_page']);
    $new_nameItem = addSlashTopSkates($_POST['new_name_item']);
    $new_nameText = addSlashTopSkates($_POST['new_name_text']);
    $new_nameUrl =  addSlashTopSkates($_POST['new_name_url']);

    if (isSet($_POST['desc_lang'])) {
        $descLang = addSlashTopSkates($_POST['desc_lang']);
        $descPage = addSlashTopSkates($_POST['desc_page']);
        $descItem = addSlashTopSkates($_POST['desc_item']);
        $descText = addSlashTopSkates($_POST['desc_text']);
        $descUrl =  addSlashTopSkates($_POST['desc_url']);
    }
    $new_descLang = addSlashTopSkates($_POST['new_desc_lang']);
    $new_descPage = addSlashTopSkates($_POST['new_desc_page']);
    $new_descItem = addSlashTopSkates($_POST['new_desc_item']);
    $new_descText = addSlashTopSkates($_POST['new_desc_text']);
    $new_descUrl =  addSlashTopSkates($_POST['new_desc_url']);

    if (isSet($_POST['desc2_lang'])) {
        $desc2Lang = addSlashTopSkates($_POST['desc2_lang']);
        $desc2Page = addSlashTopSkates($_POST['desc2_page']);
        $desc2Item = addSlashTopSkates($_POST['desc2_item']);
        $desc2Text = addSlashTopSkates($_POST['desc2_text']);
        $desc2Url =  addSlashTopSkates($_POST['desc2_url']);
    }
    $new_desc2Lang = addSlashTopSkates($_POST['new_desc2_lang']);
    $new_desc2Page = addSlashTopSkates($_POST['new_desc2_page']);
    $new_desc2Item = addSlashTopSkates($_POST['new_desc2_item']);
    $new_desc2Text = addSlashTopSkates($_POST['new_desc2_text']);
    $new_desc2Url =  addSlashTopSkates($_POST['new_desc2_url']);


        $price       = str_replace(',', '', $_POST['txtPrice']);
        $price_retail       = str_replace(',', '', $_POST['txtPriceRetail']);

        // if uploading a new image
        // remove old image
        if ($mainImage != '') {
                $mainImage = "'$mainImage'";
        } else {
                // if we're not updating the image
                // make sure the old path remain the same
                // in the database
                $mainImage = 'pd_image';
        }

        $sql   = "INSERT INTO tbl_product
                  (cat_id, pd_reference, pd_image_large, pd_thumbnail, pd_image, pd_date, pd_last_update, pd_active, pd_display_order) 
		  VALUES
		  ($catId, '$name', $mainImage, $mainImage, $mainImage, now(), now(), $active, $displayOrder)";

        $result = dbQuery($sql);
        $product_id = mysql_insert_id();  // product id that was generated by the current insert statement in tbl_product

        $sql   = "INSERT INTO tbl_tariff (ta_id, ta_pd_id, ta_category, ta_price, ta_date, ta_last_update, ta_active)
         VALUES (NULL, '$product_id', 0, '$price', NOW(), NOW(), 1)";

        $result = dbQuery($sql);



// Retrieve the newly inserted product ID
	$sql = "SELECT pd_id FROM tbl_product WHERE pd_reference = '$name'";
	$result = dbQuery($sql);
	$row = dbFetchAssoc($result);

// Exit if there was a problem inserting a new ID
	if (!($row['pd_id']) || ($row['pd_id'] == $productId)) {
		header('Location: index.php?catId='. $catId);
		return;	
	}
		
	$productId = $row['pd_id'];
	$productinfo= new ProductInfo();
  //$productinfo->setPdid($_GET['pd_id']);
   $admin = new AdminCustomer();
  $alltype=$admin->getAllType();
  $ref = $productinfo->getPDReference();
  
	$admin->clonePrice($_POST['pd_id'][0],$row['pd_id']);
	$admin->cloneImage($_POST['pd_id'][0],$row['pd_id']);
	//print_r();
// PRODUCT ITEM SQL Statements

$sql='';

    if (isSet($productItemWeight)) {
         $numProductItemEntries    = count($productItemWeight);

         for ($i = 0; $i < $numProductItemEntries; $i++) {
                $sql = "INSERT INTO tbl_product_item 
			( pi_pd_id
			, pi_flavor
			, pi_flavor_display_order
			, pi_stock_qty
			, pi_weight
			, pi_shipping_weight)
                        VALUES 
			( $productId
			, '$productItemFlavor[$i]'
			, $productItemFlavorDisplayOrder[$i]
			, $productItemStockQty[$i]
			, $productItemWeight[$i]
			, $productItemShippingWeight[$i])";
                dbQuery($sql);
        }
    }

$sql='';

    $numProductItemEntries_new    = count($new_productItemWeight);

    for ($i = 0; $i < $numProductItemEntries_new; $i++) {
        if (!($new_productItemWeight[$i]=='')) {
                $sql = "INSERT INTO tbl_product_item 
			( pi_pd_id
			, pi_flavor
			, pi_flavor_display_order
			, pi_stock_qty
			, pi_weight
			, pi_shipping_weight)
                        VALUES 
			( $productId
			, '$new_productItemFlavor[$i]'
			, $new_productItemFlavorDisplayOrder[$i]
			, $new_productItemStockQty[$i]
			, $new_productItemWeight[$i]
			, $new_productItemShippingWeight[$i])";
                dbQuery($sql);
        }
    }


// LANGUAGE ITEM SQL Statements for NAME field

$sql='';

    if (isSet($nameText)) {
        $numNameLangEntries    = count($nameText);

        for ($i = 0; $i < $numNameLangEntries; $i++) {

                $html_text = text2HTML($nameText[$i]);
                $item = str_replace($oldName, $name, $nameItem[$i]);
                $sql = "INSERT INTO language_items 
			( lang
			, page
			, item
			, text
			, url)
                        VALUES 
			( '$nameLang[$i]'
			, '$namePage[$i]'
			, '$item'
			, '$html_text'
			, '$nameUrl[$i]')";
                dbQuery($sql);
        }
    }

$sql='';

    $numNameLangEntries_new    = count($new_nameText);

    for ($i = 0; $i < $numNameLangEntries_new; $i++) {
        $html_text = text2HTML($new_nameText[$i]);
        $item = str_replace($oldName, $name, $new_nameItem[$i]);
        if (!($new_nameText[$i]=='') && !($new_nameLang[$i]=='')) {
                $sql = "INSERT INTO language_items (lang, page, item, text, url)
                        VALUES ('$new_nameLang[$i]','$new_namePage[$i]','$item', '$html_text', '$new_nameUrl[$i]')";
                dbQuery($sql);
        }
    }



// LANGUAGE ITEM SQL Statements for DESC field

$sql='';

    if (isSet($descText)) {
        $numDescLangEntries    = count($descText);

        for ($i = 0; $i < $numDescLangEntries; $i++) {

                $html_text = text2HTML($descText[$i]);
                $item = str_replace($oldName, $name, $descItem[$i]);
                $sql = "INSERT INTO language_items
                        ( lang
                        , page
                        , item
                        , text
                        , url)
                        VALUES
                        ( '$descLang[$i]'
                        , '$descPage[$i]'
                        , '$item'
                        , '$html_text'
                        , '$descUrl[$i]')";
                dbQuery($sql);
        }
    }

$sql='';

    $numDescLangEntries_new    = count($new_descText);

    for ($i = 0; $i < $numDescLangEntries_new; $i++) {
        $html_text = text2HTML($new_descText[$i]);
        $item = str_replace($oldName, $name, $new_descItem[$i]);
        if (!($new_descText[$i]=='') && !($new_descLang[$i]=='')) {
                $sql = "INSERT INTO language_items (lang, page, item, text, url)
                        VALUES ('$new_descLang[$i]','$new_descPage[$i]','$item', '$html_text', '$new_descUrl[$i]')";
                dbQuery($sql);
        }

    }

// LANGUAGE ITEM SQL Statements for DESC2 field

$sql='';

    if (isSet($desc2Text)) {
        $numDesc2LangEntries    = count($desc2Text);

        for ($i = 0; $i < $numDesc2LangEntries; $i++) {

                $html_text = text2HTML($desc2Text[$i]);
                $item = str_replace($oldName, $name, $desc2Item[$i]);
                $sql = "INSERT INTO  language_items
                        ( lang
                        , page
                        , item
                        , text
                        , url)
                        VALUES
                        ( '$desc2Lang[$i]'
                        , '$desc2Page[$i]'
                        , '$item'
                        , '$html_text'
                        , '$desc2Url[$i]')";
                dbQuery($sql);
        }
    }

$sql='';

        $numDesc2LangEntries_new    = count($new_desc2Text);

        for ($i = 0; $i < $numDesc2LangEntries_new; $i++) {
                $html_text = text2HTML($new_desc2Text[$i]);
                $item = str_replace($oldName, $name, $new_desc2Item[$i]);
                if (!($new_desc2Text[$i]=='') && !($new_desc2Lang[$i]=='')) {
                        $sql = "INSERT INTO language_items (lang, page, item, text, url)
                                VALUES ('$new_desc2Lang[$i]','$new_desc2Page[$i]','$item', '$html_text', '$new_desc2Url[$i]')";
                        dbQuery($sql);
                }
        }



       header('Location: index.php?catId='. $catId);
}


/*
	Remove a product
*/
function deleteProduct()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
	// remove any references to this product from
	// tbl_order_item and tbl_cart
//	$sql = "DELETE FROM tbl_order_item
//	        WHERE pd_id = $productId";
//	dbQuery($sql);
			
//	$sql = "DELETE FROM tbl_cart
//	        WHERE pd_id = $productId";	
//	dbQuery($sql);
			
	// get the image name and thumbnail
//	$sql = "SELECT pd_image, pd_thumbnail
//	        FROM tbl_product
//			WHERE pd_id = $productId";
			
//	$result = dbQuery($sql);
//	$row    = dbFetchAssoc($result);

	// remove the product image and thumbnail
//	if ($row['pd_image']) {
//		unlink(SRV_ROOT . 'images/product/' . $row['pd_image']);
//		unlink(SRV_ROOT . 'images/product/' . $row['pd_thumbnail']);
//	}
	
	// remove the product from database;
	$sql = "SELECT pd_reference FROM tbl_product 
	        WHERE pd_id = $productId";
	dbQuery($sql);

        $result = dbQuery($sql);
        $row    = dbFetchAssoc($result);

        if ($row['pd_reference']) {
		// remove the corresponding language_items from database;
		$sql = "DELETE FROM language_items 
	       		 WHERE item = 'product_".$row['pd_reference']."_name'";
		dbQuery($sql);
                $sql = "DELETE FROM language_items
                         WHERE item = 'product_".$row['pd_reference']."_desc'";
                dbQuery($sql);
                $sql = "DELETE FROM language_items
                         WHERE item = 'product_".$row['pd_reference']."_desc2'";
                dbQuery($sql);

	}
	// remove the product_items from database;
	$sql = "DELETE FROM tbl_product_item 
	        WHERE pi_pd_id = $productId";
	dbQuery($sql);
	
	// remove the product from database;
	$sql = "DELETE FROM tbl_product 
	        WHERE pd_id = $productId";
	dbQuery($sql);
	

	header('Location: index.php?catId=' . $_GET['catId']);
}

/*
        Remove a product Item
*/
function deleteProductItem()
{
        if (isset($_GET['productItemId']) && (int)$_GET['productItemId'] > 0) {
                $productItemId = (int)$_GET['productItemId'];
        } else {
                header('Location: index.php');
        }
        
        // remove any references to this product from
        // tbl_order_item and tbl_cart
//        $sql = "DELETE FROM tbl_order_item
//                WHERE pd_id = $productId";
//        dbQuery($sql);
                        
//        $sql = "DELETE FROM tbl_cart
//                WHERE pd_id = $productId";  

//        dbQuery($sql);
                        
        // remove the product item from database;
        $sql = "DELETE FROM tbl_product_item 
                WHERE pi_id = $productItemId";
        dbQuery($sql);
        
        header('Location: index.php?view=modify&productId=' . $_GET['productId']);
}

/*
        Remove a language Item
*/
function deleteLanguageItem()
{
        if (isset($_GET['lang']) && !($_GET['lang'] == '')) {
                $lang = $_GET['lang'];
        } else {
                header('Location: index.php');
        }

        if (isset($_GET['item']) && !($_GET['item'] == '')) {
                $item = $_GET['item'];
        } else {
                header('Location: index.php');
        }

        // remove the language item from database;
        $sql = "DELETE FROM language_items
                WHERE lang = '$lang'
		AND   item = '$item'";

        dbQuery($sql);
        header('Location: index.php?view=modify&productId=' . $_GET['productId']);
}




/*
	Remove a product image
*/
function deleteImage()
{
	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
		$productId = (int)$_GET['productId'];
	} else {
		header('Location: index.php');
	}
	
//	$deleted = _deleteImage($productId);

	// update the image and thumbnail name in the database
	$sql = "UPDATE tbl_product
			SET pd_image = '', pd_thumbnail = '', pd_image_large = ''
			WHERE pd_id = $productId";
	dbQuery($sql);		

	header("Location: index.php?view=modify&productId=$productId");
}

function _deleteImage($productId)
{
	// we will return the status
	// whether the image deleted successfully
	$deleted = false;
	
	$sql = "SELECT pd_image, pd_thumbnail 
	        FROM tbl_product
			WHERE pd_id = $productId";
	$result = dbQuery($sql) or die('Cannot delete product image. ' . mysql_error());
	
	if (dbNumRows($result)) {
		$row = dbFetchAssoc($result);
		extract($row);
		
		if ($pd_image && $pd_thumbnail) {
			// remove the image file
//			$deleted = @unlink(SRV_ROOT . "images/product/$pd_image");
//			$deleted = @unlink(SRV_ROOT . "images/product/$pd_thumbnail");
		}
	}
	
	return $deleted;
}




?>