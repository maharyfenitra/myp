
<link href="jquery-ui/jquery-ui.css" rel="stylesheet">
<div>
       <h4 style="text-align: center;"><?php db_get_text($lang, 'all', 'my_account_title'); ?></h4>
</div>


<div>
	<table>
		<tr>
			<td><h6>Parameter</h6> </td>
			<td> <h6>Order</h6></td>
		</tr>
		
		<tr>
			<td style="margin: 3px;">
				<form method="POST" action="/admin/customer/cycle.php" >
				</form>
			</td>
			<td>
			</td>
		</tr>
	</table>
</div>


	
<table border=0 width=100%>
    
    <tr><td><label for="firstname"><?php db_get_text($lang, 'all', 'customer_first_name'); ?> :</label></td><td><input type="text" id="firstname" name="firstname" value='<?php  echo $customer->getShippingFirstName();?>' /></br></td></tr>
    <tr><td><label for="lastname"><?php db_get_text($lang, 'all', 'customer_last_name'); ?> :</label></td><td><input type="text" id="lastname" name="lastname" value='<?php  echo $customer->getShippingLastName();?>' /></br></td></tr>

    <tr><td><label for="mail"><?php db_get_text($lang, 'all', 'customer_mail') ;?> :</label></td><td><input type="email" id="mail" name="mail" value='<?php  echo $customer->getMail();?>'/></br></td></tr>
    <tr><td><label for="password"><?php db_get_text($lang, 'all', 'customer_password'); ?> :</label></td><td><input type="password" id="password" name="password" value='<?php  echo $customer->getPassword();?>'/></br></td></tr>
    <tr><td><label for="password"><?php db_get_text($lang, 'all', 'customer_password_2'); ?> :</label></td><td><input type="password" id="password" name="password_2" value='<?php  echo $customer->getPassword();?>'/></br></td></tr>

    <tr><td><label for="adress"><?php db_get_text($lang, 'all', 'customer_adress'); ?> :</label></td><td><input type="text" id="password" name="adress" value='<?php  echo $customer->getAdress();?>'/></br></td></tr>
    <tr><td><label for="city"><?php db_get_text($lang, 'store', 'checkout_city'); ?> - <?php db_get_text($lang, 'store', 'checkout_zip'); ?> :</label></td><td>

<input name="billing_city" type="text" class="box" id="txtPaymentCity" size="15" maxlength="32" value='<?php  echo $customer->getCity();?>' >
			&nbsp;-&nbsp;&nbsp;&nbsp;<input name="billing_zip" type="text" class="box" id="txtPaymentPostalCode" size="6" maxlength="10" value='<?php  echo $customer->getZip();?>'></br></td></tr>

<tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_country'); ?></td> <td class="content">
                <select  name="billing_country" type="text" class="box" id="txtPaymentCountry" >
                       <option value='<?php echo $customer->getCountry();?>' > <?php echo $customer->getCountry(); ?></option>
                                <?php
                                include "php_includes/country_list.php"
                        ?>

                </select>
                </td>
        </tr>

<tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_phone'); ?></td> <td class="content"><input name="phone" type="text" class="box" id="txtShippingPhone" size="31" maxlength="32" value='<?php  echo $customer->getPhone();?>'></td> </tr>

    <tr><td><label for="birthday"><?php db_get_text($lang, 'all', 'customer_birthday'); ?> *:</label></td><td>
<style>
	body{
		font: 80% "Trebuchet MS", sans-serif;
		margin: 10px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	select {
		width: 300px;
	}
        .ui-datepicker-table
          {
            width :100%;
            }
        th {
    color: #FFF;
    font-family: "Arial";
    font-size: 9px;
	}
	
	#envoyer {
		background-color:red; 
	}
	
	</style>

<input type="text" id="birthday" name="birthday"  value='<?php echo date('d-m-Y', strtotime($customer->getBirthday()));?>'/></td></tr>
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.js"></script>

<script>
   // $("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: '<?php db_get_text($lang, 'all', 'date_format'); ?>', yearRange: "1950:+nn" });
    $("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd-mm-yy', yearRange: "1950:+nn" });
     $('.ui-datepicker-calendar').width(100);
    
  
</script>
    <tr><td><label for="license"><?php db_get_text($lang, 'all', 'customer_license'); ?> :</label></td><td><input type="text" id="club" name="license" value='<?php  echo $customer->getLicences();?>' /></br></td></tr>
    <tr><td><label for="club"><?php db_get_text($lang, 'all', 'customer_club'); ?> :</label></td><td><input type="text" id="club" name="club" value='<?php  echo $customer->getClub();?>'/></br></td></tr>


    <tr><td><input type="hidden" name="name__" value="<?php echo $customer->getName();?>"/>
	<input type="hidden" name="key" value="2"/></td><td><input type="submit" id="envoyer" value="<?php db_get_text($lang, 'all', 'go_button'); ?>"/>
    </td></tr>
    </br></br></br>
    	
   </table>
		
