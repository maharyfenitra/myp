<?php

if (!defined('WEB_ROOT')) {

	exit;

}



$categoryList    = getCategoryList();

$categoriesPerRow = 3;

$numCategory     = count($categoryList);

$columnWidth    = (int)(100 / $categoriesPerRow) ;

$imageWidth    = (int)(740 / $categoriesPerRow);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="15">

<?php 

if ($numCategory > 0) {

	$i = 0;

	for ($i; $i < $numCategory; $i++) {

		if ($i % $categoriesPerRow == 0) {
			echo '<tr valign="bottom">';
		}

		// we have $url, $image, $name, $price

		extract ($categoryList[$i]);

		echo "<td width=\"$columnWidth%\" align=\"center\" ><a href=\"$url\"><img src=\"" . $image . "\"" .SetThumbnailDimensions ($image,$imageWidth,130). " border=\"0\"><br><font style=\"color:#4D4D4D\">". db_return_text($lang, 'store', 'category_'.$reference) ."</a></font></td>\r\n";


		if ($i % $categoriesPerRow == $categoriesPerRow - 1) {
			echo '</tr>';
		}

	}

	

	if ($i % $categoriesPerRow > 0) {
		echo '<td colspan="' . ($categoriesPerRow - ($i % $categoriesPerRow)) . '">&nbsp;</td>';
	}

} else {

?>

	<tr><td width="100%" align="center" valign="center">No categories yet</td></tr>

<?php	

}	

?>

</table>

