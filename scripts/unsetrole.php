<?php
	session_start();
	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];

	if(isset($_POST['unsetautor'])){
	 $sql = "UPDATE uzivatele SET autor=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==autrunset");
	 exit();
	}
	else if(isset($_POST['unsetredaktor'])){
	 $sql = "UPDATE uzivatele SET redaktor=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==redktorunset");
	 exit();
	}
	else if(isset($_POST['unsetrecenzent'])){
	 $sql = "UPDATE uzivatele SET recenzent=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==recnzentunset");
	 exit();
	}
	else if(isset($_POST['unsetsefred'])){
	 $sql = "UPDATE uzivatele SET sefredaktor=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==sefrdunset");
	 exit();
	}
	else{
	 header("Location: ../index.php");
	 exit();
	}
?>
