<?php
/*
	Contain the common functions 
	required in shop and admin pages
*/

require_once 'config.php';
require_once 'db.php';


// Set product images dimension function

function SetImageDimensions ($image_filename,$max_width,$max_height) {

    $image_filename=(strpos($image_filename,$_SERVER['DOCUMENT_ROOT'])===false) ? $_SERVER['DOCUMENT_ROOT']."/".$image_filename : $image_filename ;
    
    if (file_exists($image_filename)) {
    
        $size=getimagesize($image_filename);
        if ($size[0]>$max_width || $size[1]>$max_height) {
            $scale = min($max_width/$size[0], $max_height/$size[1]);
            $new_width = intval(floor($scale*$size[0]));
            $new_height = intval(floor($scale*$size[1]));
            return ' width="'.$new_width.'" height="'.$new_height.'"';
        }
     	else { return "";}
    }
    else {return "";}
}  


// Set product thumbnail dimension function

function SetThumbnailDimensions ($image_filename,$max_width,$max_height) {

    $image_filename=(strpos($image_filename,$_SERVER['DOCUMENT_ROOT'])===false) ? $_SERVER['DOCUMENT_ROOT']."/".$image_filename : $image_filename ;
    
    if (file_exists($image_filename)) {
    
        $size=getimagesize($image_filename);
     //   if ($size[0]>$max_width || $size[1]>$max_height) {
            $scale = min($max_width/$size[0], $max_height/$size[1]);
            $new_width = intval(floor($scale*$size[0]));
            $new_height = intval(floor($scale*$size[1]));
            return ' width="'.$new_width.'" height="'.$new_height.'"';
    //   }
    // 	else { return "";}
    }
    else {return "";}
}  


/*
	Make sure each key name in $requiredField exist
	in $_POST and the value is not empty
*/

function checkRequiredPost($requiredField) {

//DB: remove after debug
//	return true;

	$numRequired = count($requiredField);
	$keys        = array_keys($_POST);

	$allFieldExist  = true;
	for ($i = 0; $i < $numRequired && $allFieldExist; $i++) {

		if (!in_array($requiredField[$i], $keys) || $_POST[$requiredField[$i]] == '') {
			$allFieldExist = false;
		}

	}

	return $allFieldExist;
}

function checkEmailAddress($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!@ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!@ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!@ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!@ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|↪([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}


function getShopConfig()

{

	// get current configuration

	$sql = "SELECT sc_name, sc_address, sc_address_html, sc_bank_account_fr_html, sc_bank_account_intl_html, sc_phone, sc_email, sc_shipping_cost, sc_order_email, cy_symbol, sc_background_color 

			FROM tbl_shop_config sc, tbl_currency cy

			WHERE sc_currency = cy_id";

	$result = dbQuery($sql);

	$row    = dbFetchAssoc($result);



    if ($row) {

        extract($row);

	

        $shopConfig = array('name'           => $sc_name,

                            'address'        => $sc_address,

                            'address_html'   => $sc_address_html,

                            'bank_account_fr_html'   => $sc_bank_account_fr_html,

                            'bank_account_intl_html'   => $sc_bank_account_intl_html,

                            'phone'          => $sc_phone,

                            'email'          => $sc_email,

			    'sendOrderEmail' => $sc_order_email,

                            'shippingCost'   => $sc_shipping_cost,

                            'currency'       => $cy_symbol,

			    'background_color' => $sc_background_color

);

    } else {

        $shopConfig = array('name'           => '',

                            'address'        => '',

                            'address_html'   => '',

                            'bank_account_fr_html'   => '',

                            'bank_account_intl_html'   => '',

                            'phone'          => '',

                            'email'          => '',

			    'sendOrderEmail' => '',

                            'shippingCost'   => '',

                            'currency'       => '',

			    'background_color' => ''

);    

    }



	return $shopConfig;						

}



function displayAmount($amount)

{

	global $shopConfig;

//	return number_format($amount) . ",00 " .$shopConfig['currency'];
	return number_format($amount,1,",","") . "0 " .$shopConfig['currency'];

}

function displayPaypalAmount($amount)

{

        global $shopConfig;

//      return number_format($amount) . ",00 " .$shopConfig['currency'];
        return number_format($amount,1,".","") . "0";

}



/*

	Join up the key value pairs in $_GET

	into a single query string

*/

function queryString()

{
	$qString = array();

	foreach($_GET as $key => $value) {

		if (trim($value) != '') {
			$qString[] = $key. '=' . trim($value);
		} else {
			$qString[] = $key;
		}
	}

	$qString = implode('&', $qString);

	return $qString;
}

/*
	Put an error message on session 
*/

function setError($errorMessage)

{
	if (!isset($_SESSION['plaincart_error'])) {
		$_SESSION['plaincart_error'] = array();
	}

	$_SESSION['plaincart_error'][] = $errorMessage;
}



/*
	print the error message
*/

function displayError()

{
	if (isset($_SESSION['plaincart_error']) && count($_SESSION['plaincart_error'])) {

		$numError = count($_SESSION['plaincart_error']);

		echo '<table id="errorMessage" width="550" align="center" cellpadding="20" cellspacing="0"><tr><td>';

		for ($i = 0; $i < $numError; $i++) {
			echo '&#8226; ' . $_SESSION['plaincart_error'][$i] . "<br>\r\n";
		}

		echo '</td></tr></table>';

		// remove all error messages from session

		$_SESSION['plaincart_error'] = array();

	}

}



/**************************
	Paging Functions
***************************/

function getPagingQuery($sql, $itemPerPage = 10)

{
	if (isset($_GET['page']) && (int)$_GET['page'] > 0) {

		$page = (int)$_GET['page'];

	} else {

		$page = 1;

	}

	// start fetching from this row number

	$offset = ($page - 1) * $itemPerPage;

	return $sql . " LIMIT $offset, $itemPerPage";

}



/*

	Get the links to navigate between one result page to another.

	Supply a value for $strGet if the page url already contain some

	GET values for example if the original page url is like this :


	http://www.phpwebcommerce.com/plaincart/index.php?c=12
	

	use "c=12" as the value for $strGet. But if the url is like this :


	http://www.phpwebcommerce.com/plaincart/index.php
	

	then there's no need to set a value for $strGet

*/

function getPagingLink($sql, $itemPerPage = 10, $strGet = '')

{

	$result        = dbQuery($sql);

	$pagingLink    = '';

	$totalResults  = dbNumRows($result);

	$totalPages    = ceil($totalResults / $itemPerPage);

	

	// how many link pages to show

	$numLinks      = 10;



		

	// create the paging links only if we have more than one page of results

	if ($totalPages > 1) {

	

		$self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;


		if (isset($_GET['page']) && (int)$_GET['page'] > 0) {

			$pageNumber = (int)$_GET['page'];

		} else {

			$pageNumber = 1;

		}

		

		// print 'previous' link only if we're not

		// on page one

		if ($pageNumber > 1) {

			$page = $pageNumber - 1;

			if ($page > 1) {

				$prev = " <a style=\"color:black\" href=\"$self?page=$page&$strGet\">".db_return_text('en','all','navigation_prev')."</a> ";

			} else {

				$prev = " <a style=\"color:black\" href=\"$self?$strGet\">".db_return_text('en','all','navigation_prev')."</a> ";

			}	

				

		//	$first = " <a href=\"$self?$strGet\">".db_return_text('en','all','navigation_first')."</a> ";
			$first = "&nbsp;"; // let's skip the first and last navigation buttons

		} else {

			$prev  = ''; // we're on page one, don't show 'previous' link

			$first = ''; // nor 'first page' link

		}

	

		// print 'next' link only if we're not

		// on the last page

		if ($pageNumber < $totalPages) {

			$page = $pageNumber + 1;

			$next = " <a style=\"color:black\" href=\"$self?page=$page&$strGet\">".db_return_text('en','all','navigation_next')."</a> ";

		//	$last = " <a href=\"$self?page=$totalPages&$strGet\">".db_return_text('en','all','navigation_last')."</a> ";
			$last = "&nbsp;"; // let's skip the first and last navigation buttons

		} else {

			$next = ''; // we're on the last page, don't show 'next' link

			$last = ''; // nor 'last page' link

		}



		$start = $pageNumber - ($pageNumber % $numLinks) + 1;

		$end   = $start + $numLinks - 1;		

		

		$end   = min($totalPages, $end);

		

		$pagingLink = array();

		for($page = $start; $page <= $end; $page++)	{

			if ($page == $pageNumber) {

				$pagingLink[] = " $page ";   // no need to create a link to current page

			} else {

				if ($page == 1) {

					$pagingLink[] = " <a href=\"$self?$strGet\">$page</a> ";

				} else {	

					$pagingLink[] = " <a href=\"$self?page=$page&$strGet\">$page</a> ";

				}	

			}

	

		}

		

		$pagingLink = implode(' | ', $pagingLink);

		

		// return the page navigation link

		$pagingLink = $first . $prev . $pagingLink . $next . $last;

	}

	

	return $pagingLink;

}

?>
