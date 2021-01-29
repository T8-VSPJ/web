<?php
session_start();
include_once 'dtb.php';

if(isset($_POST['odstranitProfilovouFoto'])){

	   $id=$_POST['idUzivatele'];
		 $sql = "UPDATE uzivatele SET profilova_fotografie=0 WHERE id=?;";
		 $stmt = mysqli_stmt_init($pripojeni);
		 if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../pages/nastaveni.php?smazaniProfiloveFotky=neuspesne");
			exit();
		 }else{
			 mysqli_stmt_bind_param($stmt,"s",$id);
			 mysqli_stmt_execute($stmt);
			 $jmenoFoto="../profilovky/profile".$id."*";
			 $fotoinfo=glob($jmenoFoto);
			 $fotoext=explode(".",$fotoinfo[0]);
			 $fotoKonc=$fotoext[3];

			 $foto = "../profilovky/profile".$id.".".$fotoKonc;

			 if(!unlink($foto)){
			 }else{
				 if($_SESSION['idUzivatele'] == $id){
				 	$_SESSION['statusUzivatele']=0;
				 }

			 }
			 header("Location: ../pages/nastaveni.php");
			 exit();
		}
	}
if(isset($_POST['odstranitProfilovouFotoA'])){

	   $id=$_POST['idUzivatele'];
		 $sql = "UPDATE uzivatele SET profilova_fotografie=0 WHERE id=?;";
		 $stmt = mysqli_stmt_init($pripojeni);
		 if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../pages/amenu.php?smazaniProfiloveFotky=neuspesne");
			exit();
		 }else{
			 mysqli_stmt_bind_param($stmt,"s",$id);
			 mysqli_stmt_execute($stmt);
			 $jmenoFoto="../profilovky/profile".$id."*";
			 $fotoinfo=glob($jmenoFoto);
			 $fotoext=explode(".",$fotoinfo[0]);
			 $fotoKonc=$fotoext[3];

			 $foto = "../profilovky/profile".$id.".".$fotoKonc;

			 if(!unlink($foto)){
			 }else{
				 if($_SESSION['idUzivatele'] == $id){
				 	$_SESSION['statusUzivatele']=0;
				 }

			 }
			 header("Location: ../pages/amenu.php?smazaniProfiloveFotky=uspesne");
			 exit();
		}
	}
	else{
	  header("Location: ../index.php");
	 exit();  
	}
	 
?>
