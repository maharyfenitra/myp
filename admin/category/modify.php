<?php
require '../../php_includes/language.php';
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a category id exists
if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
} else {
	header('Location:index.php');
}

$sql = "SELECT cat_id, cat_reference, cat_image, cat_active, cat_display_order, cat_display_order_pics
		FROM tbl_category
		WHERE cat_id = $catId";
$result = dbQuery($sql);
$row = dbFetchAssoc($result);
extract($row);

?>
<p>&nbsp;</p>
<form action="processCategory.php?action=modify&catId=<?php echo $catId; ?>" method="post" enctype="multipart/form-data" name="frmCategory" id="frmCategory">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category Reference</td>
   <td class="content"><input name="txtReference" type="text" class="box" id="txtReference" value="<?php echo $cat_reference; ?>" size="30" maxlength="50"></td>
   <td class="content"> <input name="txtOldName" type="hidden" class="box" id="txtOldName" value="<?php echo $cat_reference; ?>" ></td>
  </tr>
  <tr> 
   <td width="150" class="label">Display Order</td>
   <td class="content"> <input name="txtDisplayOrder" type="text" class="box" id="txtDisplayOrder" value="<?php echo $cat_display_order; ?>" size="5" maxlenght="5"></td>
  </tr>
	  <tr> 
   <td width="150" class="label">Image Display Order</td>
   <td class="content"> <input name="txtDisplayOrderPics" type="text" class="box" id="txtDisplayOrderPics" value="<?php echo $cat_display_order_pics; ?>" size="5" maxlenght="5"></td>
  </tr>
  <tr>
   <td width="150" class="label">Image</td>
   <td class="content">
    <input name="imageName" type="text" id="imageName" class="box" size="60" value="<?php echo $cat_image;?>">
<?php
	if ($cat_image != '') {
?>
    <br>
    <img src="<?php echo "/".CATEGORY_IMAGE_DIR . $cat_image; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $cat_id; ?>);">Delete 
    Image</a> 
    <?php
	}
?>
   </td>
  </tr>
 <tr>
   <td width="150" class="label">Active</td>
<?php
  if ( isSet($_SESSION['plaincart_user_level']) && ($_SESSION['plaincart_user_level'] == 0 )) {
        if ($cat_active == 1) {
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
 </tr>
 </table>
<?php
// get language item list - NAME
$sql = "SELECT lang, page, item, text, url
        FROM language_items li
                WHERE li.item = 'category_".$cat_reference."'
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
                 $language_item_list_name .= "<tr><td><input type='hidden' name='name_lang[]' value='$lang' size='2'>$lang<input type='hidden' name='name_page[]' value='$page'><input type='hidden' name='name_item[]' value='$item' size='5'></td><td><textarea rows='1' name='name_text[]' cols='60'>$text</textarea></td><td><input type='text' name='name_url[]' value='$url' size='5'></td><td><a href='javascript:deleteLanguageItem(\"".$lang."\",\"".$item."\",".$catId.")'>x</a></td></tr>";

//        }
}

for ($i = $n; $i <= $n + max((3 - $n),2); $i++) {
         $language_item_list_name .= "<tr><td><select name='new_name_lang[]'>".getLangSelectOptionString()."</select><input type='hidden' name='new_name_page[]' value='store'><input type='hidden' name='new_name_item[]' value='category_".$cat_reference."'></td><td><textarea rows='1' name='new_name_text[]' cols='60'></textarea></td><td><input type='text' name='new_name_url[]' value='' size='5'></td></tr>";
}
?>


 <table>
        <?php echo $language_item_list_name; ?>
 </table>
 <p align="center"> 
  <input name="btnModify" type="button" id="btnModify" value="Save Modification" onClick="checkCategoryForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">
 </p>
</form>
