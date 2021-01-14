<?php
	session_start();
	include '../scripts/kontrola.php';
	include_once '../scripts/dtb.php';
	if(!$_SESSION['idUzivatele']){
	    header("Location: ../index.php");
	}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
<title>Logos Polytechnikos</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../Bootstrap/styly.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=cs'></script>
<script src="https://cdn.tiny.cloud/1/eoj1vdl030re3i765qa6n3j57jqfnns3nr0518tqoi0f9cvl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="shortcut icon" href="../photos/favicon.ico" type="image/x-icon">
<link rel="icon" href="../photos/favicon.ico" type="image/x-icon">




</head>
<body>
    

    
    
<script>

$(document).ready(function() {

		var fu = $('#fromUser').val();
		var tu = $('#toUser').val();
	
			
	$('#send').on('click', function() {

			var m = $('#message').val(); 
			$.ajax({
				url: "../scripts/insert.php",
				type: "POST",
				data: {
					fu: fu,
					tu: tu,
					m: m
							
				},
					success:function(data){
				    $("#message").val("");
				}
				
			});

	});
	
	 	setInterval(function(){ 
			  	$.ajax({
				url: "../scripts/realtime.php",
				type: "POST",
				data: {
					fu: fu,
					tu: tu
			
				},
				success:function(data){
				    $("#msgBody").html(data);
				}
			});     
		}, 700);   
	
});
</script>
<?php


  include 'menu.php';
   


echo '
<div class="messaging">
  <div class="inbox_msg">
	<div class="inbox_people">
	  <div class="headind_srch">
		<div class="recent_heading">
		  <h4><strong>Zprávy</strong></h4>
		</div>
	
	  </div>
	  <div class="inbox_chat scroll">';
	 
	 
	     
	          $sql="SELECT * FROM uzivatele";
	          $vys=mysqli_query($pripojeni,$sql);
	          while($row=mysqli_fetch_assoc($vys)){
	              	if($_SESSION['idUzivatele'] != $row['id']){
	              	  echo'
	      
	       <a href="zpravy.php?uzivatel='.$row['id'].'">
		<div class="chat_list" style="';if($row['id'] == $_GET["uzivatel"]){echo 'background:#f6495433';} echo '">
		  <div class="chat_people">';
	              	      if($row['profilova_fotografie'] == 1){
		         $filename="../profilovky/profile".$row['id']."*";
        $fileinfo=glob($filename);
		$fileext=explode(".",$fileinfo[0]); 
		echo '<div class="chat_img"> <img src="../profilovky/profile'.$row['id'].'.'.$fileext[3].'" alt="sunil"> </div>';

		    }
		    else{
		        echo '<div class="chat_img"> <img src="../profilovky/default.jpg" alt="sunil"> </div>';

		    }
		    echo '<div class="chat_ib">
			  <h5><strong>'.$row['jmeno'].'</strong></h5>
			  <p>';
			  if($row['admin'] == 1){
			      echo '<strong>Admin</strong>';
			  }
			  else if($row['redaktor'] == 1){
			       echo '<strong>Redaktor</strong>';
			  }
			  else if($row['recenzent'] == 1){
			       echo '<strong>Recenzent</strong>';
			  }
			  else if($row['sefredaktor'] == 1)
			  {
			       echo '<strong>Sefredaktor</strong>';
			  }
			  else{
			      echo '<strong>Bez role</strong>'; 
			  }
			  echo '</p>
			</div>
		  </div>
	
		</div>
	   	   </a>
	      
	      
	      
	       ';
	              	}
	          }


	 
	
	

echo  '</div>
	</div>
	';

if(isset($_GET["uzivatel"])){
    
$_SESSION['toUser'] = $_GET["uzivatel"];

    echo '
    
    <div class="mesgs">
	  <div  id="m" class="msg_history">
		
	    
    
    
	  <div id="msgBody">		</div>	 
	  <div class="type_msg">
		<div class="input_msg_write">
		  <input value="'.$_SESSION['toUser'].'" id="toUser" type="hidden">
         <input value="'.$_SESSION['idUzivatele'].'" id="fromUser" type="hidden">
		  <input type="text" class="write_msg"  id="message" placeholder="Napište zprávu" />
		  <button id="send" class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		</div>
	  </div>
	</div>
    ';
}		
	
echo '	
  </div>
</div>

';


?>
 
</body>
</html>
