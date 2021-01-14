<?php

if(isset($_POST['registrace'])){

    include_once 'dtb.php';

        
    $jmeno= mysqli_real_escape_string($pripojeni, $_POST['jmeno']);
    $email= mysqli_real_escape_string($pripojeni, $_POST['email']);
     $heslo_1= mysqli_real_escape_string($pripojeni, $_POST['heslo1']);
      $heslo_2= mysqli_real_escape_string($pripojeni, $_POST['heslo2']);

    //Chyby
    //Kontrola jestli nejsou policka prazdna
    if(empty(trim($email)) || empty(trim($heslo_1)) || empty(trim($heslo_2)) || empty(trim($jmeno))){
      header("Location: ../index.php?registrace=prazdna");
      exit();
    }else{
    if ($heslo_1 != $heslo_2 || strlen($heslo_1) < 8) {
	   header("Location: ../index.php?registrace=neplatneheslo&uziv_jmeno=$jmeno&email=$email");
      exit();
    }else{
     //Kontrola jestli jmeno ma spravne znaky a jestli uz neexistuje nejaky udaj
     if(!preg_match("/^[a-zA-Z0-9]*$/", $jmeno)){
      header("Location: ../index.php?registrace=neplatna");
      exit();
     }
     else if(!preg_match("/^[a-zA-Z0-9]*$/", $prijmeni)){
       header("Location: ../index.php?registrace=neplatna");
      exit();
     }
     else if(!isset($_POST['gdprCheck']) && $gdpr != 'souhlasim_se_zpracovanim_udaju'){
       header("Location: ../index.php?error=gdprproblem");
       exit();
     }
     else{
          $sql= "SELECT * FROM uzivatele WHERE jmeno=? OR email=?;";
  		    $stmt=mysqli_stmt_init($pripojeni);
  		    if(mysqli_stmt_prepare($stmt,$sql)){
  			        mysqli_stmt_bind_param($stmt, "ss",$jmeno,$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
  		    }
          $resultCheck = mysqli_fetch_assoc($result);

          if($resultCheck){
          if ($resultCheck['jmeno'] === $jmeno) {
          header("Location: ../index.php?registrace=uzivatelskejmenoexistuje&email=$email");
          exit();
          }
          if ($resultCheck['email'] === $email) {
          header("Location: ../index.php?registrace=emailexistuje&uziv_jmeno=$jmeno");
          exit();
          }
     }else{

     //Zaheshovani hesla
            $hashHeslo=password_hash($heslo_1, PASSWORD_DEFAULT);
            //Vlozeni udaju do databaze
            $sql="INSERT INTO uzivatele (jmeno, email, heslo) VALUES(?,?,?);";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "sss",$jmeno,$email,$hashHeslo);
                  mysqli_stmt_execute($stmt);
    			  }
            header("Location: ../index.php?registrace=uspesna");
            exit();
     }
 }
}
}
} else{
  header("Location: ../index.php");
  exit();
}
