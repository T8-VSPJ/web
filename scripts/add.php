<?php
if(isset($_POST['addrec'])){
  include 'dtb.php';
$idClanku=$_POST['idClanku'];
$idRedaktora=$_POST['idRedaktora'];

 $selected = $_POST['addrecenzent'];
 $do = date('Y-m-d', strtotime($_POST['adddo']));

  $datum = date("Y-m-d");
        $stmt=mysqli_stmt_init($pripojeni);
             $sql="UPDATE clankyprijmuti SET id_recenzenta=?, id_redaktora=?, od=?, do=? WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "sssss",$selected,$idRedaktora,$datum,$do,$idClanku);
                        mysqli_stmt_execute($stmt);
                            header("Location: ../pages/odeslaneClanky.php");
  		                
    			  }

            
}
else if(isset($_POST['schvaleni'])){
  include 'dtb.php';
$idClanku=$_POST['idClanku'];



$stav=11;
        $stmt=mysqli_stmt_init($pripojeni);
             $sql="UPDATE clankyprijmuti SET status=? WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "ss",$stav,$idClanku);
                        mysqli_stmt_execute($stmt);
                            $sql2="SELECT * FROM clankyprijmuti WHERE id='$idClanku'";
                            $vys2=mysqli_query($pripojeni,$sql2);
                            $row=mysqli_fetch_assoc($vys2);
                            $titukek=$row['titulek'];
                            $text=$row['text'];
                            $autor=$row['id_autora'];
                            $dat=$row['datum'];
                            $fotka=$row['fotka'];
                                  $sql="INSERT INTO clanky (titulek, text, id_autora, datum, fotka,id_clanku) VALUES(?,?,?,?,?,?);";
			                     if(mysqli_stmt_prepare($stmt,$sql)){
    				            mysqli_stmt_bind_param($stmt, "ssssss",$titukek,$text,$autor,$dat,$fotka,$idClanku);
                                 mysqli_stmt_execute($stmt);
                                   header("Location: ../pages/odeslaneClanky.php"); 
    			                 }
  		                   
    			  }
    			  
    			          

            
}
else if(isset($_POST['zamitnuti'])){
  include 'dtb.php';
$idClanku=$_POST['idClanku'];


$stav=10;
        $stmt=mysqli_stmt_init($pripojeni);
             $sql="UPDATE clankyprijmuti SET status=? WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "ss",$stav,$idClanku);
                        mysqli_stmt_execute($stmt);
                            header("Location: ../pages/odeslaneClanky.php");
  		                
    			  }

            
}
else if(isset($_POST['smazatadmin'])){
  include 'dtb.php';
$idClanku=$_POST['idClanku'];
$idClanku2=$_POST['idClanku2'];
$stav=110;

        $stmt=mysqli_stmt_init($pripojeni);
             $sql="DELETE FROM clanky WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "s",$idClanku);
                        mysqli_stmt_execute($stmt);
                        $sql2="UPDATE clankyprijmuti SET status=? WHERE id=?";
                         if(mysqli_stmt_prepare($stmt,$sql2)){
                           mysqli_stmt_bind_param($stmt, "ss",$stav,$idClanku2);
                           mysqli_stmt_execute($stmt);
                             header("Location: ../pages/odeslaneClanky.php"); 
                         }
                           
  		                
    			  }

            
}
else{
   header("Location: ../index.php"); 
}
?> 