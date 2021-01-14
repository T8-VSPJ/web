<?php
	session_start();
	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];

	if(isset($_POST['odstranitUzivatele'])){
	 $sql = "DELETE FROM uzivatele WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==smazan");
	 exit();
	}
?>
