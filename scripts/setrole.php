<?php
	session_start();
	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];

	if(isset($_POST['setautor'])){
	 $sql = "UPDATE uzivatele SET autor=1 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==autor");
	 exit();
	}
	else if(isset($_POST['setredaktor'])){
	 $sql = "UPDATE uzivatele SET redaktor=1 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==redaktor");
	 exit();
	}
	else if(isset($_POST['setrecenzent'])){
	 $sql = "UPDATE uzivatele SET recenzent=1 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==recenzent");
	 exit();
	}
	else if(isset($_POST['setsefred'])){
	 $sql = "UPDATE uzivatele SET sefredaktor=1 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==sefredaktor");
	 exit();
	}
?>
