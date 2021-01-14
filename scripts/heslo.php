<?php
  if (isset($_POST["oheslo"])) { 
  include_once'dtb.php'; 
  
        $email = mysqli_real_escape_string($pripojeni, $_POST['email']);
        $heslo_1 = mysqli_real_escape_string($pripojeni, $_POST['heslo1']);
        $heslo_2 = mysqli_real_escape_string($pripojeni, $_POST['heslo2']);
        
        if(!empty(trim($heslo_1)) && !empty(trim($heslo_2)) && empty(trim($email))){
             header("Location: ../index.php?email=prazdny");
             exit(); 
        }
        else if(empty(trim($heslo_1)) && empty(trim($heslo_2)) && !empty(trim($email))){
              header("Location: ../index.php?heslo=prazdny");
             exit();
        }
        else if(!empty(trim($heslo_1)) && !empty(trim($heslo_2)) && !empty(trim($email))){
             $sql = "SELECT * FROM uzivatele WHERE email='$email'";
             $result = mysqli_query($pripojeni,$sql);
              $resultCheck=mysqli_num_rows($result);
         if($resultCheck < 1){
            header("location: ../index?zapomenuteheslo=chyba");
            exit();
          }else{
              if($row = mysqli_fetch_assoc($result)){
              
              
                  if($heslo_1 == $heslo_2 && strlen($heslo_1) > 7){
                    $novyheslo=password_hash($heslo_1,PASSWORD_DEFAULT);
                    $sql="UPDATE uzivatele SET heslo=? WHERE email=?;";
					$stmt=mysqli_stmt_init($pripojeni);
					  if(mysqli_stmt_prepare($stmt,$sql)){
						 mysqli_stmt_bind_param($stmt, "ss",$novyheslo,$email);
     				     mysqli_stmt_execute($stmt); 
					  }

                
                    header ("location: ../index.php?zmenahesla");
                    exit();
                  }
        
              }  
            }   
        }
        else{
          header("Location: ../index.php?prazdny");
          exit();  
        }
  }
  else{
         header("Location: ../index.php");
          exit();
  }

?>
