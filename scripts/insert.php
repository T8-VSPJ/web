<?php
	include_once 'dtb.php';
$name=$_POST['tu'];
	$email=$_POST['fu'];
	$phone=$_POST['m'];

if(!empty($phone)){
    
   $sql="INSERT INTO messages (FromUser,ToUser,Message) VALUES ('$name','$email','$phone')";
mysqli_query($pripojeni,$sql); 
}


?>