<?php
	$pripojeni=mysqli_connect("localhost","logospol", "Logospolytechnos2020", "logospol");

	if(!$pripojeni){
        die("Připojení selhalo: ".mysqli_connect_error());
    }
?>
