<?php
session_start();
include_once 'dtb.php';

if(isset($_POST['submitBtn']))
{
    $idAutora=$_SESSION['idUzivatele'];
    $nazev = $_POST['nazev'];
    $misto = $_POST['misto'];
    $trvani=$_POST['trvani'];
    $datum = $_POST['datum'];
    $popisAkce=$_POST['popisAkce'];


    if(empty($nazev)){
      header("Location: ../pages/pridatUdalost.php?error=nezadanyNazev");
      exit();
    }
    else if(empty($misto)){
      header("Location: ../pages/pridatUdalost.php?error=nezadaneMisto");
      exit();
    }
    else if(empty($trvani)){
      header("Location: ../pages/pridatUdalost.php?error=nezadanaDoba");
      exit();
    }
    else if(empty($datum)){
      header("Location: ../pages/pridatUdalost.php?error=nezadaneDatum");
      exit();
    }
    else if(empty($popisAkce)){
      header("Location: ../pages/pridatUdalost.php?error=nezadanyPopis");
      exit();
    }
    $sql="INSERT INTO skolniakce (nazev,misto,datum,kdy,popis) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($pripojeni);

    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "sssss",$nazev,$misto,$datum,$trvani,$popisAkce);
      mysqli_stmt_execute($stmt);
      header("Location: ../pages/pridatUdalost.php?uspesneNahrano");
      exit();
    }
}
?>
