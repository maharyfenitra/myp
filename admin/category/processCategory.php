<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        addCategory();
        break;
      
    case 'modify' :
        modifyCategory();
        break;
        
    case 'delete' :
        deleteCategory();
        break;
    
    case 'deleteLanguageItem' :
        deleteLanguageItem();
        break;

    case 'deleteImage' :
        deleteImage();
        break;
    
	   
    default :
        // if action is not defined or unknown
        // move to main category page
        header('Location: index.php');
}


function text2HTML($text)
{
        $text = htmlentities($text, ENT_NOQUOTES, "iso-8859-1");
        $text = htmlspecialchars_decode($text);
        return $text;
}

/*
    Add a category
*/
function addCategory()
{
    $name        = $_POST['txtReference'];
    $displayOrder  = $_POST['txtDisplayOrder'];
	$displayOrderPics  = $_POST['txtDisplayOrderPics'];
//    $description = $_POST['mtxDescription'];
    $catImage       = $_POST['imageName'];
//    $image       = $_FILES['fleImage'];
    $parentId    = $_POST['hidParentId'];
    
//    $catImage = uploadImage('fleImage', SRV_ROOT . 'images/category/');
    
    $sql   = "INSERT INTO tbl_category (cat_parent_id, cat_reference, cat_image, cat_display_order, cat_display_order_pics) 
              VALUES ('$parentId', '$name', '$catImage', '$displayOrder', '$catdisplayorderPics')";
    $result = dbQuery($sql) or die('Cannot add category' . mysql_error());
    
    header('Location: index.php?catId=' . $parentId);              
}

/*
    Upload an image and return the uploaded image name 
*/
function uploadImage($inputName, $uploadDir)
{
    $image     = $_FILES[$inputName];
    $imagePath = '';
    
    // if a file is given
    if (trim($image['tmp_name']) != '') {
        // get the image extension
        $ext = substr(strrchr($image['name'], "."), 1); 

        // generate a random new file name to avoid name conflict
        $imagePath = md5(rand() * time()) . ".$ext";
        
		// check the image width. if it exceed the maximum
		// width we must resize it
		$size = getimagesize($image['tmp_name']);
		
		if ($size[0] > MAX_CATEGORY_IMAGE_WIDTH) {
			$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_CATEGORY_IMAGE_WIDTH);
		} else {
			// move the image to category image directory
			// if fail set $imagePath to empty string
			if (!move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath)) {
				$imagePath = '';
			}
		}	
    }

    
    return $imagePath;
}

/*
    Modify a category
*/
function modifyCategory()
{
    $catId       = (int)$_GET['catId'];
    $name        = $_POST['txtReference'];
    $oldName     = $_POST['txtOldName'];
    $displayOrder = $_POST['txtDisplayOrder'];
	$displayOrderPics = $_POST['txtDisplayOrderPics'];
//    $description = $_POST['mtxDescription'];
    $catImage       = $_POST['imageName'];
//    $image       = $_FILES['fleImage'];
    $active       = $_POST['active'];
    
    if (isSet($_POST['name_lang'])) {
        $nameLang = $_POST['name_lang'];
        $namePage = $_POST['name_page'];
        $nameItem = $_POST['name_item'];
        $nameText = $_POST['name_text'];
        $nameUrl =  $_POST['name_url'];
    }
    $new_nameLang = $_POST['new_name_lang'];
    $new_namePage = $_POST['new_name_page'];
    $new_nameItem = $_POST['new_name_item'];
    $new_nameText = $_POST['new_name_text'];
    $new_nameUrl =  $_POST['new_name_url'];


//    $catImage = uploadImage('fleImage', SRV_ROOT . 'images/category/');
    
    // if uploading a new image
    // remove old image
    if ($catImage != '') {
//        _deleteImage($catId);
		$catImage = "'$catImage'";
    } else {
		// leave the category image as it was
		$catImage = 'cat_image';
	}
     
    $sql    = "UPDATE tbl_category 
               SET cat_reference = '$name', cat_image = $catImage, cat_active=$active, cat_display_order=$displayOrder, cat_display_order_pics=$displayOrderPics
               WHERE cat_id = $catId";
           
    $result = dbQuery($sql) or die('Cannot update category. ' . mysql_error());

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

    header('Location: index.php');       
}

/*
    Remove a category
*/
function deleteCategory()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	// find all the children categories
	$children = getChildren($catId);
	
	// make an array containing this category and all it's children
	$categories  = array_merge($children, array($catId));
	$numCategory = count($categories);

	// remove all product image & thumbnail 
	// if the product's category is in  $categories
	$sql = "SELECT pd_id, pd_image, pd_thumbnail
	        FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";
	$result = dbQuery($sql);
	
//	while ($row = dbFetchAssoc($result)) {
//		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
//		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
//	}
	
	// delete the products
//	$sql = "DELETE FROM tbl_product
//			WHERE cat_id IN (" . implode(',', $categories) . ")";
//	dbQuery($sql);
	

	// then remove the categories image
//	_deleteImage($categories);

    // finally remove the category from database;
    $sql = "DELETE FROM tbl_category 
            WHERE cat_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
    header('Location: index.php');
}


/*
	Recursively find all children of $catId
*/
function getChildren($catId)
{
    $sql = "SELECT cat_id ".
           "FROM tbl_category ".
           "WHERE cat_parent_id = $catId ";
    $result = dbQuery($sql);
    
	$cat = array();
	if (dbNumRows($result) > 0) {
		while ($row = dbFetchRow($result)) {
			$cat[] = $row[0];
			
			// call this function again to find the children
			$cat  = array_merge($cat, getChildren($row[0]));
		}
    }

    return $cat;
}


/*
    Remove a category image
*/
function deleteImage()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
//	_deleteImage($catId);
	
	// update the image name in the database
	$sql = "UPDATE tbl_category
			SET cat_image = ''
			WHERE cat_id = $catId";
	dbQuery($sql);        

    header("Location: index.php?view=modify&catId=$catId");
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
        header('Location: index.php?view=modify&catId=' . $_GET['catId']);
}

/*
	Delete a category image where category = $catId
*/
function _deleteImage($catId)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

	// get the image(s)
    $sql = "SELECT cat_image 
            FROM tbl_category
            WHERE cat_id ";
	
	if (is_array($catId)) {
		$sql .= " IN (" . implode(',', $catId) . ")";
	} else {
		$sql .= " = $catId";
	}	

    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
	        // delete the image file
    	    $deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
		}	
    }
    
    return $deleted;
}

?>
