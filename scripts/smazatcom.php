<?php
if(isset($_POST['smazatcoment'])){
      include 'dtb.php';
    $id=$_POST['idkomentare'];
    $idClanku='../pages/clanky.php?clanek'.$_POST['idclanku'];
      $stmt=mysqli_stmt_init($pripojeni);
             $sql="DELETE FROM komentar WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "s",$id);
                        mysqli_stmt_execute($stmt);
                        header('Location: ' . $idClanku);    
  		                
    			  }

    
}
else if(isset($_POST['ulozitKomentar'])){
      include 'dtb.php';
    $id=$_GET['id'];
    $text=$_POST['content'];
    $idClanku='../pages/clanky.php?clanek'.$_POST['idclanku'];

      $stmt=mysqli_stmt_init($pripojeni);
             $sql="UPDATE komentar SET textKomentare=? WHERE id=?";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "ss",$text,$id);
                        mysqli_stmt_execute($stmt);
                        header('Location: ' . $idClanku);    
  		                
    			  }
}
else{
    header("Location: ../index.php"); 
}
?>