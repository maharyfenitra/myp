<?php 

$nom = "Image_uploaded/ex.log";
    $resultat = move_uploaded_file($_FILES['icone']['tmp_name'],$nom);

     if ($resultat) echo "Transfert réussi";

?>
