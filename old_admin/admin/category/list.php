<?php

if (!defined('WEB_ROOT')) {

	exit;

}



if (isset($_GET['catId']) && (int)$_GET['catId'] >= 0) {

	$catId = (int)$_GET['catId'];

	$queryString = "&catId=$catId";

} else {

	$catId = 0;

	$queryString = '';

}

	

// for paging

// how many rows to show per page

if (!defined('ROWS_PER_PAGE')) {
        $rowsPerPage = 20;
} else {
        $rowsPerPage = ROWS_PER_PAGE;
}


$sql = "SELECT cat_id, cat_parent_id, cat_reference, cat_image, cat_active, cat_display_order

        FROM tbl_category

		WHERE cat_parent_id = $catId

		ORDER BY cat_display_order";

$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));

$pagingLink = getPagingLink($sql, $rowsPerPage);

?>

<p>&nbsp;</p>

<form action="processCategory.php?action=addCategory" method="post"  name="frmListCategory" id="frmListCategory">

 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="left"> <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" class="box" onClick="addCategory(<?php echo $catId; ?>)">
 </td>
 </tr>
 </table>
 <br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">

  <tr align="center" id="listTableHeader"> 

   <td>Access Sub-Categories</td>

   <td width="75">Image</td>

   <td width="75">Modify</td>

   <td width="75">Display Order</td>

   <td width="75">Delete</td>

   <td width="75">Active</td>

  </tr>

  <?php

$cat_parent_id = 0;

if (dbNumRows($result) > 0) {

	$i = 0;

	

	while($row = dbFetchAssoc($result)) {

		extract($row);

		

		if ($i%2) {

			$class = 'row1';

		} else {

			$class = 'row2';

		}

		

		$i += 1;

		

		if ($cat_parent_id == 0) {

			$cat_reference = "<a href=\"index.php?catId=$cat_id\">$cat_reference</a>";

		}

		

		if ($cat_image) {

			$cat_image =  '/images/category/' . $cat_image;

		} else {

			$cat_image =  '/images/no-image-small.png';

		}		

?>

  <tr class="<?php echo $class; ?>"> 

   <td><?php echo $cat_reference; ?></td>

   <td width="75" align="center"><img src="<?php echo $cat_image; ?>"></td>

   <td width="75" align="center"><a href="javascript:modifyCategory(<?php echo $cat_id; ?>);">Modify</a></td>

   <td width="75" align="center"><?php echo $cat_display_order; ?></a></td>

   <td width="75" align="center"><a href="javascript:deleteCategory(<?php echo $cat_id; ?>);">Delete</a></td>

   <td width="75" align="center"><?php echo $cat_active; ?></a></td>

  </tr>

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

   <td colspan="5" align="center">No Categories Yet</td>

  </tr>

  <?php

}

?>

  <tr> 

   <td colspan="5">&nbsp;</td>

  </tr>

  <tr> 

   <td colspan="5" align="right"> <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Category" class="box" onClick="addCategory(<?php echo $catId; ?>)"> 

   </td>

  </tr>

 </table>

 <p>&nbsp;</p>

</form>
