<?php
   require_once '../../customer/library/customer.php';
   require_once '../../customer/library/admin_customer.php';  
   //echo "User ".$_GET['name__']; 
    $customer=new Customer($_GET['name__'],null,null,null);  
    $admin=new AdminCustomer(); 
    $listType=$admin->getAllType();
?>
   <form method="POST" action="cycle.php?v=<?php echo $_GET['name__']; ?>">
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
      <tr id="listTableHeader"><td>Item</td><td>Value</td></tr>
      <!-- <tr><td width="150" class="label">User_id</td><td><input class="box" type="text" value="<?php echo$customer->getName();?>" name="name"></td></tr>-->
      <tr><td width="150" class="label">Date of creation account</td><td><label><?php echo $customer->getCu_creation_date();?></label></td></tr>
      <tr><td width="150" class="label">Lastname</td><td><input class="box" type="text" value="<?php echo $customer->getShippingLastName();?>" name="lastname"></td></tr>
      <tr><td width="150" class="label">Firstname</td><td><input class="box" type="text" value="<?php echo $customer->getShippingFirstName();?>" name="firstname"></td></tr>
      <tr><td width="150" class="label">Mail</td><td><input class="box" type="text" value="<?php echo $customer->getMail();?>" name="mail"></td></tr>
      <tr><td width="150" class="label">Birthday</td><td><input class="box" type="text" value="<?php echo $customer->getBirthday();?>" name="birthday"></td></tr>
      <tr><td width="150" class="label">Phone number</td><td><input class="box" type="text" value="<?php echo $customer->getPhone();?>" name="phone"></td></tr>
      <tr><td width="150" class="label">Country</td><td><input class="box" type="text" value="<?php echo $customer->getCountry();?>" name="country"></td></tr>
      
      
      <tr><td width="150" class="label">adress</td><td><input class="box" type="text" value="<?php echo $customer->getAdress();?>" name="adress"></td></tr>
      <tr><td width="150" class="label">zip</td><td><input class="box" type="text" value="<?php echo $customer->getZip();?>" name="zip"></td></tr>
      <tr><td width="150" class="label">club</td><td><input class="box" type="text" value="<?php echo $customer->getClub();?>" name="club"></td></tr>
      
      <tr><td width="150" class="label">Password</td><td><input class="box" type="text" value="<?php echo $customer->getPassword();?>" name="password"></td></tr>
      <tr><td width="150" class="label">Type</td><td>
      
      <select value="<?php echo $admin->getLabelTypeFor($customer->getType());?>" name="type" class="box">
      <option><?php echo $admin->getLabelTypeFor($customer->getType());?></option>
      <?php 
      foreach ($listType as $option){
      ?>
      <option><?php echo $option['label'];?></option>
      <?php }?>
      
      </select>
      
      
      
      
      </td></tr>
      <tr><td width="150" class="label">Active</td><td>
                                                 <select class="box" name="active">
                                                     <option value="<?php $a=$customer->getActive();  echo $a;?>"><?php if($a==1)
                                                             {echo "enable";}else 
                                                        {echo "desable";};?></option>
                                                    <option value="<?php   $b=0; if($a==0) $b=1; echo $b;?>"><?php if($b==1)
                                                             {echo "enable";}else 
                                                        {echo "desable";};?></option>
                                                 </select>
      
                                               </td></tr>
      <tr><td width="150" class="label">Licence</td><td><input type="text" class="box" value="<?php echo $customer->getLicences();?>" name="licence"></td></tr>
      <tr><td width="150" class="label">Last update</td><td><label><?php echo $customer->getCu_last_update();?></label></td></tr>
      
      <tr><td width="150" class="label"><input type="submit"  class="box" value="Modify"name="sub"></td><td><input type="hidden" name="key" value="1"/>
      <!--  <tr><td width="150" class="label"></td><td>  </td></tr>-->
      <input type="hidden" name="name__"  value="<?php echo $_GET['name__']; ?>"/>

</table>

   </form>
