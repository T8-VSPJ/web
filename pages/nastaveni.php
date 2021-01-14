<?php
	session_start();
	include '../scripts/kontrola.php';
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

<link rel="shortcut icon" href="../photos/favicon.ico" type="image/x-icon">
<link rel="icon" href="../photos/favicon.ico" type="image/x-icon">
</head>
<body>

  <?php
  include 'menu.php';
	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$sessionid=$_SESSION['idUzivatele'];
	
	echo '
	<div class="container">
	<div class="row justify-content-center">
	<div class="bg-white" style="width:100%">
    <h4 class="border-bottom py-2 pl-2">Nastavení</h4>
    <div class="py-2 align-items-start pl-2">';
    if($_SESSION['statusUzivatele'] == 1){
       	$filename="../profilovky/profile".$sessionid."*";
        $fileinfo=glob($filename);
		$fileext=explode(".",$fileinfo[0]); 
echo '<img style="border-radius:50%;width:150px;height:150px;float:left" src="../profilovky/profile'.$sessionid.'.'.$fileext[3].'" class="img " alt="">
';
    }
    else if($_SESSION['statusUzivatele'] == 0){
        
      echo '<img style="border-radius:50%;width:150px;height:150px;float:left" src="../profilovky/default.jpg" class="img" alt="">
  ';

    }
    echo ' <div class="pl-sm-4 pl-2" style="float: left;" id="img-section"> <strong>Profilová fotografie</strong>
            <p>Přijatelný typ souboru .png .jpg .jpeg.<br>Menší než 1MB</p>';
            if($_SESSION['statusUzivatele'] == 0){
                 echo '<form action="../scripts/uploadProfilovky.php" method="post" enctype="multipart/form-data" id="vybratFot">
										<input type="file" name="foto">
								
									<button name="submit" type = "submit" class="btn btn-primary button border"><strong>Nahrát</strong></button>
									<input type="hidden" name="idUzivatele" value="'.$_SESSION['idUzivatele'].'">
				</form>';
            }
            else if($_SESSION['statusUzivatele'] == 1){
                echo '<form action="../scripts/smazaniProfilovky.php" method="post" id="smazatFoto">
							<button type = "submit" name="odstranitProfilovouFoto" class="btn btn-danger button border"><strong>Smazat</strong></button>
										<input type="hidden" name="idUzivatele" value="'.$_SESSION['idUzivatele'].'">
				</form>';
            }
           
           echo ' 
        </div>
    </div>
    <form method="post" action="../scripts/profil.php">
    <div class="py-2" style="clear:both">
      
            <div class="col-md-12"> <label><strong>Uživ. jméno</strong></label> <input type="text" name="jmeno" class="bg-light form-control" placeholder="'.$_SESSION['jmenoUzivatele'].'"> </div>
       
       
            <div class="col-md-12 py-2"> <label><strong>Email</strong></label> <input type="text" name="email" class="bg-light form-control" placeholder="'.$_SESSION['emailUzivatele'].'"> </div>
            <div class="col-md-12 py-2"> <label ><strong>Staré heslo</strong></label> <input type="password" name="stareheslo" class="bg-light form-control"> </div>
            <div class="col-md-12 py-2"> <label><strong>Nové heslo (min. 8 znaků)</strong></label> <input type="password" name="noveheslo" class="bg-light form-control"> </div>
           <div class="col-md-12 py-2"> <label ><strong>Potvrď nové heslo</strong></label> <input type="password" name="potvrdnoveheslo" class="bg-light form-control"> </div>
       
  
        <div class="py-3 pb-4"> <button style="float: right;" name="udaje" class="btn btn-success mr-3"><strong>Uložit</strong></button> </div>

    </div>
    </form>
</div>
</div>
</div>
	';
	
	

	if(strpos($celaURL,"uploadFoto=uspesne") == true){
		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Úspěšně jste si změnil/a profilovou fotografii!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"uploadFoto=fotografiejeprilisvelka") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Fotografie, kterou se snažíte nahrát je příliš velká!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"uploadFoto=problemprinahravani") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Fotografie nelze nahrát!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"uploadFoto=spatnytypfotografie") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Fotografie má nepodporovaný formát! (povoleny jsou jpg,jpeg,png)
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"smazaniFoto=uspesne") == true){
		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Úspěšně jste smazal profilovou fotografii!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	?>
  
</body>
</html>
