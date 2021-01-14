<?php
if($_SESSION['stavRecenzant'] == 1){
  
  include 'dtb.php';
   $ted = date("Y-m-d");

   $idPom=$_SESSION['idUzivatele'];
              $sql = "SELECT * FROM clankyprijmuti WHERE id_recenzenta='$idPom' AND status='0'"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
          		$vys = mysqli_query($pripojeni,$sql);
        
            while($row = mysqli_fetch_assoc($vys)){
                 
                       if($ted >  $row['do']){
                      header("Location: ../pages/odeslaneClanky.php");
                    }
            }

}

