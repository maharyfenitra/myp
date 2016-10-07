<?php
require_once '../../customer/library/admin_customer.php';
                 $admin=new AdminCustomer();
                  $list=$admin->getAllCustomer();
                  $tb1=$list[2];
                  $tb2=$list[3];
               echo $tb1['name']." ".$tb2['name'];
            $n=count($list);?>
            <table>
         <?php for($i=0;$i<$n;$i++){
                  
                  $tbl=$list[$i]
?>
     <tr><td><?php echo $i;?></td><td><?php $tbl['name'] ?></td><td><?php $tbl['mail'] ?></td><td><?php $tbl['licences'] ?></td></tr>
<?php
}
?>
</table>
