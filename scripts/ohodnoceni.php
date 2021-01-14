<?php
if(isset($_POST['ohodnot'])){
  include 'dtb.php';
$idClanku=$_POST['idClanku'];
 $r1 = $_POST['rating'];
 $r2 = $_POST['rating2'];
 $r3 = $_POST['rating3'];
 $r4 = $_POST['rating4'];
 $nazor = $_POST['nazor'];
 $status=1;
  $datum = date("Y-m-d");

            $stmt=mysqli_stmt_init($pripojeni);
             $sql="INSERT INTO hodnoceni (id_clanku, originalita, odbornost, jazyk, aktualnost, nazor, datum_rec) VALUES(?,?,?,?,?,?,?);";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "sssssss",$idClanku,$r1,$r2,$r3,$r4,$nazor,$datum);
                         mysqli_stmt_execute($stmt);
                    	$sql2="UPDATE clankyprijmuti SET status=? WHERE id=?";
    	
  		                    if(mysqli_stmt_prepare($stmt,$sql2)){
  			                mysqli_stmt_bind_param($stmt, "ss",$status,$idClanku);
                             mysqli_stmt_execute($stmt);
                            header("Location: ../pages/odeslaneClanky.php");
  		                }
    			  }

}
else{
   header("Location: ../index.php"); 
}
?> 