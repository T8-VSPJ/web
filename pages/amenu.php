<?php
	session_start();
	include_once '../scripts/dtb.php';
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

  
  
  <?php
  include "menu.php";
  include "messages.php";
  	

  	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  	if(isset($_SESSION['idUzivatele'])){
  	if($_SESSION['stavAdmin'] == 1){
  			echo '<div class="container" id="textUvod">

  				<br>
  				<div class="row" style="background-color: rgb(103 103 103 / 6%);border-radius: 5px;">';
  								$sql= "SELECT * FROM uzivatele ORDER BY id DESC";
  								$vys= mysqli_query($pripojeni,$sql);

  								echo '<div class="container" style="margin-top:2%;">
  										<div class="row">
  											<div class="col-md-12">
  												<h2>
  													Výpis všech registrovaných uživatelů
  												</h2>
  														<br>
  												<div class="table-responsive">
  												<table class="table table-condensed table-hover">
  													<thead>
  														<tr>
  															<th>
  															#
  															</th>
  															<th>
  																Jméno
  															</th>
  															<th>
  																Email
  															</th>
  															<th>
  																Profilová fotografie
  															</th>
  															<th>
  																Úroveň účtu
  															</th>
  															<th>
  															
  															</th>
  															<th>
  															</th>
  														</tr>
  													</thead>
  													<tbody>';
  														while($row = mysqli_fetch_assoc($vys)){
  														    if($_SESSION['idUzivatele'] != $row['id']){
  															echo	'<tr>
  																			<td class="tabFormWl">
  																				'.++$i.'
  																			</td>
  																			<td class="tabFormWl">
  																				'.$row['jmeno'].'
  																			</td>
  																			<td class="tabFormWl">
  																				'.$row['email'].'
  																			</td>
  																			<td>';
  																				if($row['profilova_fotografie'] == 1)
  																			  {
  																				$fileN="../profilovky/profile".$row['id']."*";
  																				$fileI=glob($fileN);
  																				$fileE=explode(".",$fileI[0]);
  																				echo '<a href="../profilovky/profile'.$row['id'].'.'.$fileE[3].'">
  																						<img src="../profilovky/profile'.$row['id'].'.'.$fileE[3].'" width="50" height="45" alt="Profilová fotka">
  																					  </a>';
  																			  }
  																			  else{
  																						echo '<a href="../profilovky/default.jpg">
  																										<img src="../profilovky/default.jpg" width="50" height="45" alt="Profilová fotka">
  																									 </a>';
  																			  }
  																	echo   '</td>';
  																echo	'<td class="tabFormWl">';
  																                 if($row['autor'] == 0 && $row['redaktor'] == 0 && $row['recenzent'] ==0 && $row['sefredaktor']==0 && $row['admin'] ==0)
  																                 {
  																                     echo '| Bez role |';
  																                 }
  																				 if($row['autor']==1)
  																				 {
  																				     echo '| Autor |';
  																				 }
  																				 if($row['redaktor']==1)
  																				 {
  																				     echo '| Redaktor |';
  																				 }
  																				 if($row['recenzent']==1)
  																				 {
  																				     echo '| Recenzent |';
  																				 }
  																				 if($row['sefredaktor']==1)
  																				 {
  																				     echo '| Šéfredaktor |';
  																				 }
  																				 if($row['admin']==1)
  																				 {
  																				     echo '| Admin |';
  																				 }
  																				 else if($row['ban'] == 1){
  																				 	 echo '<div style="color:darkred;">Banned</div>';
  																				 }
  																				 else if($row['ban'] == 2){
  																					 echo '<div style="color:darkred;">Blacklisted</div>';
  																				 }
  																echo  '</td>
  																<td>
  																<div class="dropdown" style="margin-top:-7px;">';
  																if($row['admin']==0){
  																   echo ' <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;">
  																			Možnosti
  																		</button>'; 
  																}

  																echo		'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
  																				if($row['ban']==0){
  																					echo '
  																					<form action="../scripts/ban.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="banNastroj" style="border:0;cursor:pointer;">
  																								<i class="fas fa-user-times" style="color:#c12e1b;margin-right:5px;"></i>
  																								BAN
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				else{
  																				echo '<form action="../scripts/unban.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="unBan" style="border:0;cursor:pointer;">
  																								<i class="fas fa-user-check" style="margin-right:5px;color:#28a745;"></i>
  																								unBAN
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				if($row['admin']==0){
  																				echo '<form action="../scripts/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
  																							 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;cursor:pointer;">
  																								<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
  																								Odstranit uživatele
  																							 </button>
  																							 <input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																							</form>';
  																														echo '<form action="../scripts/smazaniProfilovky.php" method="post" style="margin-bottom:5px;">
  																							 <button class="dropdown-item" type="submit" name="odstranitProfilovouFotoA" style="margin-right:5px;outline:none;border:0;cursor:pointer;">
  																								<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
  																								Smazat profilovou fotografii
  																							 </button>
  																							 <input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																							</form>';
  																				}
  													
  																echo '</div>
  																		</td>
  																		<td>
  																		    <div class="dropdown" style="margin-top:-7px;">';
  																	    		if($row['admin']==0){
  																echo	'	<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;">
  																			Nastavit role
  																		</button>';
  																		}
  																	echo	
  																	'<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
  																				if($row['autor']==0){
  																				echo '<form action="../scripts/setrole.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="setautor" style="border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="color:#28a745;;margin-right:5px;"></i>
  																								Nastavit autora
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				else{
  																				echo '<form action="../scripts/unsetrole.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="unsetautor" style="border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="margin-right:5px;color:#c12e1b;"></i>
  																								Odebrat autora
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				if($row['redaktor']==0){
  																				echo '<form action="../scripts/setrole.php" method="post" style="margin-bottom:5px;">
  																							 <button class="dropdown-item" type="submit" name="setredaktor" style="margin-right:5px;outline:none;border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="color:#28a745;;margin-right:5px;"></i>
  																								Nastavit redaktora
  																							 </button>
  																							 <input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																							</form>';
  																				}
  																				else{
  																				echo '<form action="../scripts/unsetrole.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="unsetredaktor" style="border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="margin-right:5px;color:#c12e1b;"></i>
  																								Odebrat redaktora
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				if($row['recenzent']==0){
  																				echo '<form action="../scripts/setrole.php" method="post" style="margin-bottom:5px;">
  																							 <button class="dropdown-item" type="submit" name="setrecenzent" style="margin-right:5px;outline:none;border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="color:#28a745;margin-right:5px;"></i>
  																								Nastavit recenzent
  																							 </button>
  																							 <input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																							</form>';
  																				}
  																				else{
  																				echo '<form action="../scripts/unsetrole.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="unsetrecenzent" style="border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="margin-right:5px;color:#c12e1b;"></i>
  																								Odebrat recenzenta
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																				if($row['sefredaktor']==0){
  																				echo '<form action="../scripts/setrole.php" method="post" style="margin-bottom:5px;">
  																							 <button class="dropdown-item" type="submit" name="setsefred" style="margin-right:5px;outline:none;border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="color:#28a745;;margin-right:5px;"></i>
  																								Nastavit šéfredaktora
  																							 </button>
  																							 <input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																							</form>';
  																				}
  																				else {
  																				echo '<form action="../scripts/unsetrole.php" method="post" style="margin-bottom:5px;">
  																							<button class="dropdown-item" type="submit" name="unsetsefred" style="border:0;cursor:pointer;">
  																								<i class="fas fa-address-book" style="margin-right:5px;color:#c12e1b;"></i>
  																								Odebrat šéfredaktora
  																							</button>
  																							<input type="hidden" name="idUzivatele" value="'.$row['id'].'">
  																						</form>';
  																				}
  																	echo '</td>
  																	</tr>';
  														
  														    }
  														    }
  											 echo '</tbody>
  												</table>
  												</div>
  											</div>
  										</div>
  									</div>
  									</div>
  									</div>';
  					}
  			}
  			else{
  				echo '<div class="container" id="textUvod">
  								<div class="row">
  									<h1 style="margin-left:auto;margin-right:auto;margin-top:50px;">Něco se nepovedlo! Vrať se na úvodní stránku!</h1>
  								</div>
  							</div>';
  			}
  ?>
   <?php echo '<input type="hidden" id="a" value="'.$_SESSION['idUzivatele'].'">'; ?>
  <script>
  $(document).ready(function() {
  	var a = $('#a').val();
          setInterval(function(){ 
			   	$.ajax({
				url: "../scripts/update.php",
				type: "POST",
			     data: {
					a: a
			
				},
			
			});     
		
		}, 2000);
  });
    </script>
  
</body>
</html>
