<?php
session_start();
include_once 'dtb.php';

if(isset($_POST['submitBtn']))
{
    $idAutora=$_SESSION['idUzivatele'];
    $titulekText = $_POST['textTitulek'];
    $clanekText = $_POST['content'];
    $popisText=$_POST['textPopis'];
    $datum = date("Y-m-d");
    $zarazeni=$_POST['zarazeniPrispevku'];

    $fotoJmeno = $_FILES['foto']['name'];   // $files - globalni promenna, foto - jmeno z inputu, name - nwm
    $fotoTmp = $_FILES['foto']['tmp_name'];  // tmp - jakoze umisteni
    $fotoVelikost = $_FILES['foto']['size'];
    $fotoError = $_FILES['foto']['error'];
    $fotoTyp = $_FILES['foto']['type'];
    $fotoExt = explode('.', $fotoJmeno); //rozdeleni jmena za ucelem zjisteni koncovky souboru (v mem pripade jpg). Vlastne rozdelime fotoJmeno na pole ve kterem bude jmeno a koncovku
    $fotoPismoExt = strtolower(end($fotoExt));  //pokud se nahraje foto, ktera ma koncovku psanou velkym pismem - timto prikazem se zmeni vsechna velka pismena na mala.
    $povoleno = array('jpg','jpeg','png');


    $sql="INSERT INTO clankyprijmuti (zarazeni,titulek,popisUvod,text,id_autora,datum) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($pripojeni);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else if(empty($titulekText)){
      header("Location: editor.php?error=nezadanyTitulek");
      exit();
    }
    else if(empty($popisText)){
      header("Location: editor.php?error=nezadanyPopis");
      exit();
    }
    else if($zarazeni == "nic"){
      header("Location: editor.php?error=nezadaneZarazeni");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "ssssss",$zarazeni,$titulekText,$popisText,$clanekText,$idAutora,$datum);
      mysqli_stmt_execute($stmt);
      //************************************************************************************
      $sqlPom="SELECT * FROM clankyprijmuti ORDER BY id DESC";
      $vysPom = mysqli_query($pripojeni,$sqlPom);
      $rowPom = mysqli_fetch_assoc($vysPom);

      $idClanku=$rowPom['id'];

      if(in_array($fotoPismoExt, $povoleno)){ //in_array zjisti zda-li pole se jmenemem a koncovkou fotky obsahuje mnou zadane koncovky v promene $povoleno
        if($fotoError === 0){ //pokud neni zadny problem u nahravani fotky {fotka neni jakkoliv vadna napr vetsi nez je pozadovana, jiny typ atd.}
        if($fotoVelikost < 5000000){  // 5 000 000 = 5mb
          $fotoNoveJmeno = "clanekUvod".$idClanku.".".$fotoPismoExt; //vyrobi unikatni jmeno. Delame to protoze se muze stat, ze by dva uzivatele chteli nahrat stejne jmeno fotky napr. foto.jpg. Pokud by se tak stalo tak by se fotka ve slozce prepsala a zmizela.
          $fotoUmisteni = '../photos/' . $fotoNoveJmeno;
          move_uploaded_file($fotoTmp,$fotoUmisteni);

          $sqlStatus = "UPDATE clankyprijmuti SET status=1 WHERE id = '$idClanku';";
          $vysStatus = mysqli_query($pripojeni,$sqlStatus);
          $_SESSION['statusClanku']=$rowPom['status'];
          header("Location: ../pages/editor.php?nahranitextu=uspesne");
          exit();
        }else{
          header("Location: ../pages/editor.php?uploadFoto=fotografiejeprilisvelka");
          exit();
        }
        }else{
        header("Location: ../pages/editor.php?uploadFoto=problemprinahravani");
        exit();
        }
      }else{
        header("Location: ../pages/editor.php?uploadFoto=spatnytypfotografie".$fotoJmeno.a);
        echo $fotoJmeno;
          exit();
      }
      //***************************************************************************************
    }
  }
?>
