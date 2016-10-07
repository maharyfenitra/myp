<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>


<form id="monForm" action="/customer/includes/files_recepter.php?lang=<?php echo $lang ?>" method="post">
    <table>
<tr><td><h2><?php db_get_text($lang, 'all', 'customer_register'); ?></h2></td><td></td></tr>
    <tr><td><label for="firstname"><?php db_get_text($lang, 'all', 'customer_first_name'); ?> *:</label></td><td><input type="text"  maxlength="15" id="firstname" name="firstname" /></br></td></tr>
    <tr><td><label for="lastname"><?php db_get_text($lang, 'all', 'customer_last_name'); ?> *:</label></td><td><input type="text"  maxlength="20" id="lastname" name="lastname" /></br></td></tr>

    <tr><td><label for="mail"><?php db_get_text($lang, 'all', 'customer_mail') ;?> *:</label></td><td><input type="email" id="mail" name="mail" /></br></td></tr>
    <tr><td><label for="password"><?php db_get_text($lang, 'all', 'customer_password'); ?> *:</label></td><td><input type="password" id="password" name="password" /></br></td></tr>
    <tr><td><label for="password"><?php db_get_text($lang, 'all', 'customer_password_2'); ?> *:</label></td><td><input type="password" id="password_2" name="password_2" /></br></td></tr>

    <tr><td><label for="adress"><?php db_get_text($lang, 'all', 'customer_adress'); ?> :</label></td><td><input type="text" id="password" name="adress" /></br></td></tr>
    <tr><td><label for="city"><?php db_get_text($lang, 'store', 'checkout_city'); ?> - <?php db_get_text($lang, 'store', 'checkout_zip'); ?> :</label></td><td>

<input name="billing_city" type="text" class="box" id="txtPaymentCity" size="15" maxlength="32" value="">
			&nbsp;-&nbsp;&nbsp;&nbsp;<input name="billing_zip" type="text" class="box" id="txtPaymentPostalCode" size="6" maxlength="10" value=""></br></td></tr>

<tr> <td class="label"><?php db_get_text($lang, 'store', 'checkout_country'); ?></td> <td class="content">
                <select  name="billing_country" type="text" class="box" id="txtPaymentCountry" >
                        <?php 
                                echo "<option value='";
                                if (isSet($_POST['billing_country'])&& ($_POST['billing_country'] != "")) {
                                        echo $_POST['billing_country'];
                                } 
                                echo "' selected='selected'>";
                                if (isSet($_POST['billing_country']) && ($_POST['billing_country'] != "")) {  
                                        echo $_POST['billing_country']; 
                                } else {
                                        db_get_text($lang, 'store', 'checkout_select_country'); 
                                }
                                echo "</option>";  
                                db_get_text($lang, 'store', 'checkout_select_country_first_elements');
                                include "country_list.php"
                        ?>

                </select>
                </td>
        </tr>

<tr> <td class="label"><?php db_get_text($lang, 'store', 'checkout_phone'); ?></td> <td class="content"><input name="phone" type="text" class="box" id="txtShippingPhone" size="31" maxlength="32" value=""></td> </tr>

    <tr><td><label for="birthday"><?php db_get_text($lang, 'all', 'customer_birthday'); ?> :</label></td><td>

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
	</style>


<input type="text" id="birthday" name="birthday" />
<script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.js"></script>

<script>
     $("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', yearRange: "1950:+nn" });
     $('.ui-datepicker-calendar').width(100);
  
</script>
</br></td></tr>
    <tr><td><label for="license"><?php db_get_text($lang, 'all', 'customer_license'); ?> :</label></td><td><input type="text" id="club" name="license" /></br></td></tr>
    <tr><td><label for="club"><?php db_get_text($lang, 'all', 'customer_club'); ?> :</label></td><td><input type="text" id="club" name="club" /></br></td></tr>


    <tr><td><input type="hidden" id="key" name="key" value="1"/></td><td><input type="submit" id="envoyer" value="<?php db_get_text($lang, 'all', 'go_button'); ?>"/></td></tr>
   </table>
</form>

<div id="welcome" style="display:none;"><h2><?php db_get_text($lang, 'all', 'customer_compte_created'); ?></h2></div>

<script>

$(document).ready(function() {
    $('#monForm').on('submit', function(e) {

     //Debut fonction
        
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
        var $this = $(this);
 
        var pseudo = $('#pseudo').val();
        var mail = $('#mail').val();
        var p_1=$('#password').val();
        var p_2=$('#password_2').val();
       // alert(p_1+"  "+p_2);
        if(p_1!==p_2||p_1===''){
           alert("<?php echo db_get_text_($lang, 'all', 'wrong_confirm_password'); ?>");
            }else
        if(pseudo === '' || mail === '') {
            alert("<?php echo db_get_text_($lang, 'all', 'missing_important_field'); ?>");
             //  return;
                } else {
             $("#monForm").hide();
         $("#register").hide();
         
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: $this.serialize(),
               // dataType: 'json', // JSON
                success: function(json) {
                         if(json!=0){
                           $("#monForm").show();
                           $("#register").show();
                            alert("<?php db_get_text($lang, 'all', 'compte_already_exist'); ?>");
                            }else{
                            
                            $("#welcome").show();
                            
               }
                            //
                   
                }


            });
        }
    });
});

</script>  

