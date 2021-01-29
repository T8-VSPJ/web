<?php
	session_start();


	if(isset($_POST['unBan'])){
	    	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];
	 $sql = "UPDATE uzivatele SET ban=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==unbanned");
	 exit();
	}
	else{
	    header("Location: ../index.php");
	 exit();
	}
?>
