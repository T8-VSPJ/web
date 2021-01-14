<?php
session_start();


if(isset($_POST['addclanek']))
{
    include_once 'dtb.php';
    
    $idAutora=$_SESSION['idUzivatele'];
    $titulekText = $_POST['titulek'];
    $clanekText = $_POST['content'];
    $status=0;
    $datum = date("Y-m-d");
    $f2=0;
    
    $foto=$_FILES['foto'];

    $fotoJmeno =$foto['name'];   // $files - globalni promenna, foto - jmeno z inputu, name - nwm
    $fotoTmp = $foto['tmp_name'];  // tmp - jakoze umisteni
    $fotoVelikost = $foto['size'];
    $fotoError = $foto['error'];
    $fotoTyp = $foto['type'];
    
    $fotoExt = explode('.', $fotoJmeno); //rozdeleni jmena za ucelem zjisteni koncovky souboru (v mem pripade jpg). Vlastne rozdelime fotoJmeno na pole ve kterem bude jmeno a koncovku
    $fotoPismoExt = strtolower(end($fotoExt));  //pokud se nahraje foto, ktera ma koncovku psanou velkym pismem - timto prikazem se zmeni vsechna velka pismena na mala.
    
    $povoleno = array('jpg','jpeg','png');

  
  
  if(!empty(trim($titulekText)) && !empty(trim($clanekText))){
      
      if($fotoVelikost != 0){

                         
      if(in_array($fotoPismoExt, $povoleno)){ //in_array zjisti zda-li pole se jmeneme a koncovkou fotky obsahuje mnou zadane koncovky v promene $povoleno
      if($fotoError === 0){ //pokud neni zadny problem u nahravani fotky {fotka neni jakkoliv vadna napr vetsi nez je pozadovana, jiny typ atd.}
        if($fotoVelikost < 1000000){  // 1 000 000 = 1mb
         
                         $sql="SELECT * FROM clankyprijmuti ORDER BY id DESC LIMIT 1";
                        $vys=mysqli_query($pripojeni,$sql);
                         $row=mysqli_fetch_assoc($vys);
                         $id=$row['id'];
                         ++$id;
                         
          $fotoNoveJmeno = "clanek".$id.".".$fotoPismoExt; //vyrobi unikatni jmeno. Delame to protoze se muze stat, ze by dva uzivatele chteli nahrat stejne jmeno fotky napr. foto.jpg. Pokud by se tak stalo tak by se fotka ve slozce prepsala a zmizela.
          $fotoUmisteni = '../photos/' . $fotoNoveJmeno;
          move_uploaded_file($fotoTmp,$fotoUmisteni);

          
           $stmt=mysqli_stmt_init($pripojeni);
                $sql="INSERT INTO clankyprijmuti (titulek, text, id_autora, datum, status,fotka) VALUES(?,?,?,?,?,?);";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "ssssss",$titulekText,$clanekText,$idAutora,$datum,$status,$id);
                        mysqli_stmt_execute($stmt);
                          header("Location: ../pages/editor.php?uspesne");
    			  }
        }else{
          header("Location: ../pages/editor.php?uploadFoto=fotografiejeprilisvelka");
        }
      }else{
        header("Location: ../pages/editor.php?uploadFoto=problemprinahravani");
      }
    }else{
      header("Location: ../pages/editor.php?uploadFoto=spatnytypfotografie");
    }
      
                        
               
               
                        
               }else{
                   
                $stmt=mysqli_stmt_init($pripojeni);
                $sql="INSERT INTO clankyprijmuti (titulek, text, id_autora, datum, status,fotka) VALUES(?,?,?,?,?,?);";
			      if(mysqli_stmt_prepare($stmt,$sql)){
    				      mysqli_stmt_bind_param($stmt, "ssssss",$titulekText,$clanekText,$idAutora,$datum,$status,$f2);
                        mysqli_stmt_execute($stmt);
                          header("Location: ../pages/editor.php?uspesne");
    			  }
                   
                   
               }
           
  }
}
else if(isset($_POST['uclanek'])){
       include_once 'dtb.php';
    
    $id = $_POST['id'];
    $titulekText = $_POST['titulek'];
    $clanekText = $_POST['content'];
    $status=11;
    if(!empty(trim($titulekText)) && !empty(trim($clanekText))){
        $sql="UPDATE clankyprijmuti SET titulek=?, text=?, status=? WHERE id=?;";  
				  	  $stmt=mysqli_stmt_init($pripojeni);
				  		if(mysqli_stmt_prepare($stmt,$sql)){
					  		mysqli_stmt_bind_param($stmt, "ssss",$titulekText,$clanekText,$status,$id);
      						mysqli_stmt_execute($stmt);
      					
      				$foto=$_FILES['foto'];

                        $fotoJmeno =$foto['name'];   // $files - globalni promenna, foto - jmeno z inputu, name - nwm
                         $fotoTmp = $foto['tmp_name'];  // tmp - jakoze umisteni
                             $fotoVelikost = $foto['size'];
                        $fotoError = $foto['error'];
                        $fotoTyp = $foto['type'];
    
                         $fotoExt = explode('.', $fotoJmeno); //rozdeleni jmena za ucelem zjisteni koncovky souboru (v mem pripade jpg). Vlastne rozdelime fotoJmeno na pole ve kterem bude jmeno a koncovku
                        $fotoPismoExt = strtolower(end($fotoExt));  //pokud se nahraje foto, ktera ma koncovku psanou velkym pismem - timto prikazem se zmeni vsechna velka pismena na mala.

                        $povoleno = array('jpg','jpeg','png');
                        
        if($fotoVelikost != 0){

                         
      if(in_array($fotoPismoExt, $povoleno)){ //in_array zjisti zda-li pole se jmeneme a koncovkou fotky obsahuje mnou zadane koncovky v promene $povoleno
      if($fotoError === 0){ //pokud neni zadny problem u nahravani fotky {fotka neni jakkoliv vadna napr vetsi nez je pozadovana, jiny typ atd.}
        if($fotoVelikost < 1000000){  // 1 000 000 = 1mb
        	 $jmenoFoto="../photos/clanek".$id."*";
			 $fotoinfo=glob($jmenoFoto);
			 $fotoext=explode(".",$fotoinfo[0]);
			 $fotoKonc=$fotoext[3];

			 $foto = "../photos/clanek".$id.".".$fotoKonc;
            if(!unlink($foto)){
                header("Location: ../pages/editor.php?chyba"); 
            }else{
              $fotoNoveJmeno = "clanek".$id.".".$fotoPismoExt; //vyrobi unikatni jmeno. Delame to protoze se muze stat, ze by dva uzivatele chteli nahrat stejne jmeno fotky napr. foto.jpg. Pokud by se tak stalo tak by se fotka ve slozce prepsala a zmizela.
                $fotoUmisteni = '../photos/' . $fotoNoveJmeno;
                move_uploaded_file($fotoTmp,$fotoUmisteni);
            	  header("Location: ../pages/editor.php?uspesne");  
            }
           	
        
           
          
			      
        }else{
          header("Location: ../pages/editor.php?uploadFoto=fotografiejeprilisvelka");
        }
      }else{
        header("Location: ../pages/editor.php?uploadFoto=problemprinahravani");
      }
    }else{
      header("Location: ../pages/editor.php?uploadFoto=spatnytypfotografie");
    }
      
                        
               
               
                        
               

			}
			else{
			    header("Location: ../pages/editor.php?uspesne");
			}
		
		}
    
    }
    else{
        header("Location: ../pages/editor.php?id='.$id.'");
        exit();
    }
  
                
}
  else{
     header("Location: ../index.php");
     exit();
  }
  
  
  
?>
