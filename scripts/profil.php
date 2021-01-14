<?php

session_start();

  
  if (isset($_POST["udaje"])) { 
  include_once'dtb.php'; 
    
    $uziv_jmeno= mysqli_real_escape_string($pripojeni, $_POST['jmeno']);
    $email = mysqli_real_escape_string($pripojeni, $_POST['email']);
    $heslo_1 = mysqli_real_escape_string($pripojeni, $_POST['noveheslo']);
    $heslo_2 = mysqli_real_escape_string($pripojeni, $_POST['potvrdnoveheslo']);
    $stareheslo = mysqli_real_escape_string($pripojeni, $_POST['stareheslo']);

    if(empty(trim($uziv_jmeno)) && empty(trim($email)) && empty(trim($heslo_1)) && empty(trim($heslo_2)) && empty(trim($stareheslo))){ 
    header("Location: ../pages/nastaveni.php?profil=prazdny");
    exit();
    }else{
       if(!empty(trim($heslo_1)) && !empty(trim($heslo_2))&& !empty(trim($stareheslo)) && empty(trim($email)) && empty(trim($uziv_jmeno))){
          $sql = "SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
          $result = mysqli_query($pripojeni,$sql);
          $resultCheck=mysqli_num_rows($result);
          if($resultCheck < 1){
            header("location: ../pages/nastaveni.php?profil=chyba");
            exit();
          }else{
              if($row = mysqli_fetch_assoc($result)){
               $overeniHesla=password_verify($stareheslo,$row['heslo']);
                if($overeniHesla == true){
                  if($heslo_1 == $heslo_2 && strlen($heslo_1) > 7){
                    $novyheslo=password_hash($heslo_1,PASSWORD_DEFAULT);
                    $sql="UPDATE uzivatele SET heslo=? WHERE id=?;";
					$stmt=mysqli_stmt_init($pripojeni);
					  if(mysqli_stmt_prepare($stmt,$sql)){
						 mysqli_stmt_bind_param($stmt, "ss",$novyheslo,$_SESSION['idUzivatele']);
     				     mysqli_stmt_execute($stmt); 
					  }

                    session_start();
                    session_unset();
                    session_destroy();
                    header ("location: ../index.php?prihlaseni=zmenahesla");
                    exit();
                  }else{
                   header("Location: ../pages/nastaveni.php?profil=neplatneheslo");
                   exit();
                  }
                }else{
                 header("Location: ../pages/nastaveni.php?profil=hesloneexistuje");
                 exit();
                }
              }
          }  
          
       }
       
        if(!empty(trim($uziv_jmeno))&& empty(trim($email)) && empty(trim($heslo_1)) && empty(trim($heslo_2))&& empty(trim($stareheslo))){
          if(preg_match("/^[a-zA-Z0-9]*$/",$uziv_jmeno)){
              $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
              $result = mysqli_query($pripojeni,$sql);
              $uzivatel = mysqli_fetch_assoc($result);
                  if($uzivatel['jmeno'] === $uziv_jmeno){
                   header("Location: ../pages/nastaveni.php?profil=uzivatelskejmenoexistuje");
                   exit();
                  }else{
                      $sql="UPDATE uzivatele SET jmeno=? WHERE id=?;";
					  $stmt=mysqli_stmt_init($pripojeni);
					  if(mysqli_stmt_prepare($stmt,$sql)){
						mysqli_stmt_bind_param($stmt, "ss",$uziv_jmeno,$_SESSION['idUzivatele']);
      					mysqli_stmt_execute($stmt);  
					  }

                      $_SESSION['jmenoUzivatele']= $uziv_jmeno;
                      header ("location: ../pages/nastaveni.php?profil=uspesny");
                      exit();
                  }
             }else{
              header("Location: ../pages/nastaveni.php?profil=neplatny");
              exit();
             }              
          }
          
          if(!empty(trim($email))&&empty(trim($uziv_jmeno))&& empty(trim($heslo_1)) && empty(trim($heslo_2))&& empty(trim($stareheslo))){
              $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
              $result = mysqli_query($pripojeni,$sql);
              $uzivatel = mysqli_fetch_assoc($result);
              if($uzivatel['email'] === $email){
                   header("Location: ../pages/nastaveni.php?profil=emailexistuje");
                   exit();
                  }else{
                      $sql="UPDATE uzivatele SET email=? WHERE id=?;";
				  $stmt=mysqli_stmt_init($pripojeni);
				  		if(mysqli_stmt_prepare($stmt,$sql)){
				  			mysqli_stmt_bind_param($stmt, "ss",$email,$_SESSION['idUzivatele']);
      						mysqli_stmt_execute($stmt);
						}

                      $_SESSION['emailUzivatele']= $email;
                      header ("location: ../pages/nastaveni.php?profil=uspesny");
                      exit();
                  }
             }
             
             if(!empty(trim($email))&&!empty(trim($uziv_jmeno)) && empty(trim($heslo_1)) && empty(trim($heslo_2))&& empty(trim($stareheslo))){
                  if(preg_match("/^[a-zA-Z0-9]*$/",$uziv_jmeno)){
                     $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                     $result = mysqli_query($pripojeni,$sql);
                     $uzivatel = mysqli_fetch_assoc($result);
                     if($uzivatel['jmeno'] === $uziv_jmeno){
                        header("Location: ../pages/nastaveni.php?profil=uzivatelskejmenoexistuje");
                        exit();
                     }else{
                      $sql="UPDATE uzivatele SET jmeno=? WHERE id=?;";
						 $stmt=mysqli_stmt_init($pripojeni);
						 if(mysqli_stmt_prepare($stmt,$sql)){
							mysqli_stmt_bind_param($stmt, "ss",$uziv_jmeno,$_SESSION['idUzivatele']);
      						mysqli_stmt_execute($stmt); 
						 }
          
                      $_SESSION['jmenoUzivatele']= $uziv_jmeno;
                     }
                  }else{
                      header("Location: ../pages/nastaveni.php?profil=neplatny");
                      exit();
                  } 
                   $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                   $result = mysqli_query($pripojeni,$sql);
                   $uzivatel = mysqli_fetch_assoc($result);
                   if($uzivatel['email'] === $email){
                      header("Location: ../pages/nastaveni.php?profil=emailexistuje");
                      exit();
                   }else{
                     $sql="UPDATE uzivatele SET email=? WHERE id=?;";
					   $stmt=mysqli_stmt_init($pripojeni);
					   if(mysqli_stmt_prepare($stmt,$sql)){
						   mysqli_stmt_bind_param($stmt, "ss",$email,$_SESSION['idUzivatele']);
      					   mysqli_stmt_execute($stmt);
					   }
  
                      $_SESSION['emailUzivatele']= $email;
                      header ("location: ../pages/nastaveni.php?profil=uspesny");
                      exit();
                   }
               
             }
             
             if(!empty(trim($email))&& empty(trim($uziv_jmeno)) && !empty(trim($heslo_1)) && !empty(trim($heslo_2))&& !empty(trim($stareheslo))){
                  $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                  $result = mysqli_query($pripojeni,$sql);
                  $uzivatel = mysqli_fetch_assoc($result);
                    if($uzivatel['email'] === $email){
                            header("Location: ../pages/nastaveni.php?profil=emailexistuje");
                            exit();
                    }else{
                      $sql="UPDATE uzivatele SET email=? WHERE id=?;";
						$stmt=mysqli_stmt_init($pripojeni);
						if(mysqli_stmt_prepare($stmt,$sql)){
             				mysqli_stmt_bind_param($stmt, "ss",$email,$_SESSION['idUzivatele']);
             				mysqli_stmt_execute($stmt); 
          				}   
                      
                      $_SESSION['emailUzivatele']= $email;
                    }
                    $sql = "SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                    $result = mysqli_query($pripojeni,$sql);
                    $resultCheck=mysqli_num_rows($result);
                    if($resultCheck < 1){
                       header("location: ../pages/nastaveni.php?profil=chyba");
                       exit();
                    }else{
                       if($row = mysqli_fetch_assoc($result)){
                          $overeniHesla=password_verify($stareheslo,$row['heslo']);
                          if($overeniHesla == true){
                             if($heslo_1 == $heslo_2 && strlen($heslo_1) > 7){
                                $novyheslo=password_hash($heslo_1,PASSWORD_DEFAULT);
                                $sql="UPDATE uzivatele SET heslo=? WHERE id=?;";
								 $stmt=mysqli_stmt_init($pripojeni);
								 if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$novyheslo,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          							}
                   
                                session_start();
                                session_unset();
                                session_destroy();
                                header ("location: ../index.php?prihlaseni=zmenahesla");
                                exit();
                             }else{
                                header("Location: ../pages/nastaveni.php?profil=neplatneheslo");
                                exit();
                             }
                          
                          }else{
                             header("Location: ../pages/nastaveni.php?profil=hesloneexistuje");
                             exit();
                          }
                       }
                    }
                    
                    
             }
             
             if(empty(trim($email))&&!empty(trim($uziv_jmeno)) && !empty(trim($heslo_1)) && !empty(trim($heslo_2))&& !empty(trim($stareheslo))){
                   if(preg_match("/^[a-zA-Z0-9]*$/",$uziv_jmeno)){
                      $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                      $result = mysqli_query($pripojeni,$sql);
                      $uzivatel = mysqli_fetch_assoc($result);
                        if($uzivatel['jmeno'] === $uziv_jmeno){
                           header("Location: ../pages/nastaveni.php?profil=uzivatelskejmenoexistuje");
                           exit();
                        }else{
                           $sql="UPDATE uzivatele SET jmeno=? WHERE id=?;";
							$stmt=mysqli_stmt_init($pripojeni);
							if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$uziv_jmeno,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          							}
                           
                           $_SESSION['jmenoUzivatele']= $uziv_jmeno;
                        }
                   }else{
                    header("Location: ../pages/nastaveni.php?profil=neplatny");
                    exit();
                   }
                      $sql = "SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                      $result = mysqli_query($pripojeni,$sql);
                      $resultCheck=mysqli_num_rows($result);
                      if($resultCheck < 1){
                         header("location: ../pages/nastaveni.php?profil=chyba");
                         exit();
                      }else{
                          if($row = mysqli_fetch_assoc($result)){
                             $overeniHesla=password_verify($stareheslo,$row['heslo']);
                              if($overeniHesla == true){
                                 if($heslo_1 == $heslo_2 && strlen($heslo_1) > 7){
                                     $novyheslo=password_hash($heslo_1,PASSWORD_DEFAULT);
                                     $sql="UPDATE uzivatele SET heslo=? WHERE id=?;";
									 $stmt=mysqli_stmt_init($pripojeni);
									 if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$novyheslo,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          							}
                                     
                                     session_start();
                                     session_unset();
                                     session_destroy();
                                     header ("location: ../index.php?prihlaseni=zmenahesla");
                                     exit();
                                 }else{
                                   header("Location: ../pages/nastaveni.php?profil=neplatneheslo");
                                   exit();
                                 }
                              }else{
                               header("Location: ../pages/nastaveni.php?profil=hesloneexistuje");
                               exit();
                              }
                          }
                      }
                
                
                
                
                
             } 
             
             if(!empty(trim($email))&&!empty(trim($uziv_jmeno)) && !empty(trim($heslo_1)) && !empty(trim($heslo_2))&& !empty(trim($stareheslo))){
                 if(preg_match("/^[a-zA-Z0-9]*$/",$uziv_jmeno)){
                     $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                     $result = mysqli_query($pripojeni,$sql);
                     $uzivatel = mysqli_fetch_assoc($result);
                      if($uzivatel['jmeno'] === $uziv_jmeno){
                        header("Location: ../pages/nastaveni.php?profil=uzivatelskejmenoexistuje");
                        exit();
                      }else{
                        $sql="UPDATE uzivatele SET jmeno=? WHERE id=?;";
						  $stmt=mysqli_stmt_init($pripojeni);
						  if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$uziv_jmeno,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          						}
                        
                        $_SESSION['jmenoUzivatele']= $uziv_jmeno;
                      }
                 }else{
                    header("Location: ../pages/nastaveni.php?profil=neplatny");
                    exit();
                 }
                 $sql="SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                 $result = mysqli_query($pripojeni,$sql);
                 $uzivatel = mysqli_fetch_assoc($result);
                 if($uzivatel['email'] === $email){
                   header("Location: ../pages/nastaveni.php?profil=emailexistuje");
                   exit();
                 }else{
                      $sql="UPDATE uzivatele SET email=? WHERE id=?;";
					 $stmt=mysqli_stmt_init($pripojeni);
					 if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$email,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          						}
                  
                      $_SESSION['emailUzivatele']= $email;
                 }
                  $sql = "SELECT * FROM uzivatele WHERE id='".$_SESSION['idUzivatele']."'";
                  $result = mysqli_query($pripojeni,$sql);
                  $resultCheck=mysqli_num_rows($result);
                  if($resultCheck < 1){
                     header("location: ../pages/nastaveni.php?profil=chyba");
                     exit();
                  }else{
                     if($row = mysqli_fetch_assoc($result)){
                        $overeniHesla=password_verify($stareheslo,$row['heslo']);
                         if($overeniHesla == true){
                            if($heslo_1 == $heslo_2 && strlen($heslo_1) > 7){
                              $novyheslo=password_hash($heslo_1,PASSWORD_DEFAULT);
                              $sql="UPDATE uzivatele SET heslo=? WHERE id=?;";
								$stmt=mysqli_stmt_init($pripojeni);
								if(mysqli_stmt_prepare($stmt,$sql)){
             							mysqli_stmt_bind_param($stmt, "ss",$novyheslo,$_SESSION['idUzivatele']);
             							mysqli_stmt_execute($stmt); 
          						}
                        
                              session_start();
                              session_unset();
                              session_destroy();
                              header ("location: ../index.php?prihlaseni=zmenauspesna");
                              exit();
                            }else{
                               header("Location: ../pages/nastaveni.php?profil=neplatneheslo");
                               exit();
                            }
                         }else{
                           header("Location: ../pages/nastaveni.php?profil=hesloneexistuje");
                           exit();
                         }
                     }
                  }
                
                
             }
             
              if(empty(trim($heslo_1)) || empty(trim($heslo_2))|| empty(trim($stareheslo))){
              header("Location: ../pages/nastaveni.php?profil=chybahesla");
              exit();
             } 
          }
          



}else{
header("Location: ../index.php");
exit();
} 
  
