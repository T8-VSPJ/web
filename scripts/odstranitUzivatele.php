<?php
	session_start();


	if(isset($_POST['odstranitUzivatele'])){
	    	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];
	 $sql = "DELETE FROM uzivatele WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==smazan");
	 exit();
	}
	else{
	     header("Location: ../index.php");
	 exit();
	}
?>
