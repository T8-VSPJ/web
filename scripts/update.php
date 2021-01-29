<?php

session_start();

    	include_once 'dtb.php';
    	$id=$_POST['a'];
    	$sql="UPDATE uzivatele SET last_activity=NOW() WHERE id='$id'";
    	mysqli_query($pripojeni,$sql);

?>