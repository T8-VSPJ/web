<?php
	session_start();
	include_once 'dtb.php';
	$id=$_POST['idUzivatele'];

	if(isset($_POST['unBan'])){
	 $sql = "UPDATE uzivatele SET ban=0 WHERE id='$id';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../pages/amenu.php?uzivatel==unbanned");
	 exit();
	}
?>
