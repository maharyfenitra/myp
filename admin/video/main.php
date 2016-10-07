<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// get current configuration
$sql = "SELECT sc_name, sc_address, sc_phone, sc_email, sc_shipping_cost, sc_currency, sc_order_email
        FROM tbl_shop_config";
$result = dbQuery($sql);

// extract the shop config fetched from database
// make sure we query return a row
if (dbNumRows($result) > 0) {
	extract(dbFetchAssoc($result));
} else {
	// since the query didn't return any row ( maybe because you don't run plaincart.sql as is )
	// we just set blank values for all variables
	$sc_name = $sc_address = $sc_phone = $sc_email = $sc_shipping_cost = $sc_currency = '';
	$sc_order_email = 'y';
}

// get available currencies
$sql = "SELECT cy_id, cy_code
        FROM tbl_currency
		ORDER BY cy_code";
$result = dbQuery($sql);

$currency = '';
while ($row = dbFetchAssoc($result)) {
	extract($row);
	$currency .= "<option value=\"$cy_id\"";
	if ($cy_id == $sc_currency) {
		$currency .= " selected";
	}
	
	$currency .= ">$cy_code</option>\r\n";
}		
?>
<?php
$ip = file_get_contents("../ip.txt");
?>
<p>&nbsp;</p>
 <table width="100%" border="0" cellspacing="1" cellpadding="2" class="entryTable">
  <tr id="entryTableHeader"> 
   <td colspan="1">Video Center</td>
   <td colspan="1">Free</td>
   <td colspan="1">Behind FW - dig ur hole</td>
  </tr>
  <tr> 
   <td width="150" class="label">Cam 1 - Tana</td>
   <td class="content"><a href="http://<?php echo $ip; ?>:81">http://<?php echo $ip; ?>:81</a></td>
   <td class="content"><a href="http://localhost:81">http://localhost:81</a></td>
  </tr>
  <tr> 
   <td width="150" class="label">Cam 2 - Tana</td>
   <td class="content"><a href="http://<?php echo $ip; ?>:82">http://<?php echo $ip; ?>:82</a></td>
   <td class="content"><a href="http://localhost:82">http://localhost:82</a></td>
  </tr>
  <tr> 
   <td width="150" class="label">Cam 3 - Tana</td>
   <td class="content"><a href="http://<?php echo $ip; ?>:83">http://<?php echo $ip; ?>:83</a></td>
   <td class="content"><a href="http://localhost:83">http://localhost:83</a></td>
  </tr>
  <tr> 
   <td class="label">Cam 4 - Tana</td>
   <td class="content"><a href="http://<?php echo $ip; ?>:84">http://<?php echo $ip; ?>:84</a></td>
   <td class="content"><a href="http://localhost:84">http://localhost:84</a></td>
  </tr>
 </table>
