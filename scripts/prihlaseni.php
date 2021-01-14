<?php

session_start();

if(isset($_POST['login'])){
  include 'dtb.php';
     
    $email= mysqli_real_escape_string($pripojeni, $_POST['email']);
    $heslo= mysqli_real_escape_string($pripojeni, $_POST['heslo1']);

  //Chyby
  //Kontrola prazdych policek
  if(empty(trim($email)) || empty(trim($heslo))){
    header("Location: ../index.php?prihlaseni=prazdne");
     exit();
  }else{
    $sql="SELECT * FROM uzivatele WHERE email=? OR jmeno=?;";
	$stmt=mysqli_stmt_init($pripojeni);
	  if(mysqli_stmt_prepare($stmt,$sql)){
		 mysqli_stmt_bind_param($stmt, "ss",$email,$email);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
	  }
    $resultCheck = mysqli_num_rows($result);
    if($resultCheck < 1){
     header("Location: ../index.php?prihlaseni=chyba");
     exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
           //Rozheshovani hesla a kontrola
           $hashHesloKontrola = password_verify($heslo, $row['heslo']);

           if($hashHesloKontrola == false){
             header("Location: ../index.php?prihlaseni=heslo&email=$email");
             exit();
           } elseif($hashHesloKontrola == true){
              //Kontrola jestli je ucet overeny a priadne prihlaseni
              $_SESSION['idUzivatele']=$row['id'];
              $_SESSION['jmenoUzivatele']=$row['jmeno'];
              $_SESSION['emailUzivatele']=$row['email'];
              $_SESSION['statusUzivatele']=$row['profilova_fotografie'];

              $_SESSION['stavAutor']=$row['autor'];
              $_SESSION['stavRedaktor']=$row['redaktor'];
              $_SESSION['stavRecenzant']=$row['recenzent'];
              $_SESSION['stavSefredaktor']=$row['sefredaktor'];
              $_SESSION['stavAdmin']=$row['admin'];
              
                $_SESSION['alert']=0;

              header("Location: ../index.php?prihlaseni=uspesne");
           }
        }
    }
  }
}else{
    header("Location: ../index.php?prihlaseni=chyba");
    exit();
}
