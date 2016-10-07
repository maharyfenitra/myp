<?php 
require_once 'db.php';
     $pd_id = $_GET['pd_id'];
    // $pd_image=md5(uniqid(rand(), true)).$_FILES['myfile']['name'];
     $pd_image=$_FILES['myfile']['name'];
     //$n="/home/mywheelsproject/image_uploaded/".$pd_image;
      $n="../image_uploaded/".$pd_image;
     $resultat = move_uploaded_file($_FILES['myfile']['tmp_name'],$n);

     if ($resultat) {
       $sql="INSERT INTO tbl_product_image (pd_id, pd_image)
             VALUES ('$pd_id', '$pd_image')";
          dbQuery($sql);
          //header('Location:/admin/product/');
          
}
     else{
         //  echo "Something wrong here :p";
       }
?>
