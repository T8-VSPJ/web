<?php
	$pripojeni=mysqli_connect("localhost","root", "", "logos_poly");

	if(!$pripojeni){
        die("Připojení selhalo: ".mysqli_connect_error());
    }
?>
