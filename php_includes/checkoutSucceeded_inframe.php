<?php
require_once 'php_includes/field_controle.php';
/*
Line 1 : Make sure this file is included instead of requested directly
Line 2 : Check if step is defined and the value is two
Line 3 : The POST request must come from this page but the value of step is one
*/


$errorMessage = '&nbsp;';

/*
 Make sure all the required field exist is $_POST and the value is not empty
 Note: txtShippingAddress2 and txtPaymentAddress2 are optional
*/

$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode', 'txtShippingCountry');
//$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingPhone', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode',
//                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentPhone', 'txtPaymentState', 'txtPaymentCity', 'txtPaymentPostalCode');

if (!checkRequiredPost($requiredField)) {
//	$errorMessage = 'Input not complete';
}

$cartContent = getCartContent();
if(isSet($_POST['i'])&&isValidField($_POST['i']))
$cartEntry_productItemId = $_POST['i'];

$numEntries = count($cartEntry_productItemId);

for ($i = 0; $i < $numEntries; $i++) {
     extract($cartContent[$i]);
     $newProductItemId = (int)$cartEntry_productItemId[$i];
     if ($newProductItemId < 0 ) {
		// get back to previous step, as their is still at least one unspecified product flavor!  
                        require_once 'php_includes/checkoutConfirmation_inframe.php';
	               	$pageTitle   = 'Checkout - Step 2 of 2';
                } else {

                        // update product quantity
                        $sql = "UPDATE tbl_cart
                                        SET pi_id = $newProductItemId
                                        WHERE ct_id = $ct_id";

                        dbQuery($sql);

                }
        }

?>
