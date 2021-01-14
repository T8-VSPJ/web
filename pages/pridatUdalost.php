<?php
	session_start();
	include_once '../scripts/dtb.php'
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

  <nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" id="menuUvodLogo" href="../index.php"><img src="../photos/logo.png" class="logoNavbar" alt="navbar logo"></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="menuUvod">
          <li class="nav-item">
            <a class="nav-link" href="clanky.php"><i class="fas fa-clipboard-list" style="margin-right:7px;"></i>Články</a>
          </li>
        </ul>
        <div class="ml-auto" id="profilLinky">
          <?php
            if(!isset($_SESSION['idUzivatele'])){
                echo '<button type="submit" class="btn btn-light btn-lg" data-toggle="modal" data-target="#modalLogin" style="margin-top: -5px;float:right;">Login</button>';
            }
            else{
              echo '<form action="../scripts/odhlaseni.php" method="post" style="float:right;">
                       <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                          if($_SESSION['statusUzivatele'] == 1){
                            $filename="../profilovky/profile".$_SESSION['idUzivatele']."*";
                            $fileinfo=glob($filename);
                            $fileext=explode(".",$fileinfo[0]);
                            echo '<img src="../profilovky/profile'.$_SESSION['idUzivatele'].'.'.$fileext[3].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>';
                          }
                          else{
                            echo '<img src="../profilovky/default.jpg" id="profilFoto" width="50" height="48" alt="Profilová fotka"></a>';
                          }
              echo	  '<a id="jmenoUzivateleNavbar" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$_SESSION['jmenoUzivatele'].'</a>

                       <!--DROPDOWN MENU PROFILOVKA-->
                          <div class="dropdown-menu" id="dropMenu">';
														if($_SESSION['stavAutor'] == 1)
														{
															echo '<button class="dropdown-item" style="cursor:pointer;text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Autor</button>';
														}
														else if($_SESSION['stavRedaktor'] == 1)
														{
															echo '<button class="dropdown-item" style="cursor:pointer; text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Redaktor</button>';
														}
														else if($_SESSION['stavRecenzant'] == 1)
														{
															echo '<button class="dropdown-item" style="cursor:pointer; text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Recenzent</button>';
														}
														else if($_SESSION['stavSefredaktor'] == 1)
														{
															echo '<button class="dropdown-item" style="cursor:pointer; text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Šéfredaktor</button>';
														}
														else if($_SESSION['stavAdmin'] == 1)
														{
															echo '<button class="dropdown-item" style="cursor:pointer; text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Admininstátor</button>';
														}

              echo				'<hr><a class="dropdown-item" href="nastaveni.php">Nastavení</a><hr>';
                            if($_SESSION['stavAutor'] == 1 || $_SESSION['stavSefredaktor'] == 1 || $_SESSION['stavAdmin'] == 1 || $_SESSION['stavAdmin'] == 1){
                              echo	'<a class="dropdown-item" href="editor.php">Editor článků</a>';
                            }
														if($_SESSION['stavRedaktor'] == 1 || $_SESSION['stavRecenzant'] == 1 || $_SESSION['stavSefredaktor'] == 1 || $_SESSION['stavAdmin'] == 1){ 	//Přidání události
															echo	'<a class="dropdown-item" href="editor.php">Hodnotit příspěvky</a>';
															echo	'<a class="dropdown-item" href="pridatUdalost.php">Přidat událost</a>';
                            }
                            if($_SESSION['stavAdmin'] == 1){
															echo	'<a class="dropdown-item" href="pages/editor.php">Admin menu</a>';
                            }
                      echo			   '<div class="dropdown-divider"></div>
                                <button class="dropdown-item" type="submit" style="cursor:pointer;">Odhlásit se</button>
                              </div>
                          <!--KONEC DROPDOWN MENU PROFILOVKA-->
                        </form>';
            }
          ?>
      </div>
    </div>
  </nav>
  <!--MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL-->
  <br>
			<div class="modal fade seminor-login-modal" data-backdrop="static" id="modalRegistr">
		      <div class="modal-dialog modal-dialog-centered modal-lg">
		        <div class="modal-content">
		          <div class="modal-header">
		           <h5 class="modal-title">Zaregistrujte se</h5>
		          </div>
		          <br>
		          <form class="modal-body seminor-login-form" method="post" action="../scripts/registrace.php">
		            <div class="form-group">
		              <input type="text" class="form-control" name="jmeno">
		              <label class="form-control-placeholder">Uživatelské jméno</label>
		            </div>
		            <div class="form-group">
		              <input type="email" class="form-control" name="email">
		              <label class="form-control-placeholder">E-mail</label>
		            </div>
		            <div class="form-group">
		              <input type="password" class="form-control" name="heslo1">
		              <label class="form-control-placeholder">Heslo (min. 8 znaků)</label>
		            </div>
		            <div class="form-group">
		              <input type="password" class="form-control" name="heslo2">
		              <label class="form-control-placeholder">Potvrzení hesla</label>
		            </div>
								<div class="form-group" style="background-color:unset!important;border:unset!important;height:unset!important;width: 308px;">
								  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="souhlasim_se_zpracovanim_udaju" name="gdprCheck">
								  <label class="form-check-label" for="inlineCheckbox1">Seznámil/a jsem se s <a href="phpStranky/gdpr.php">informacemi o zpracování osobních údajů</a></label>
								</div>
								<div class="g-recaptcha" data-sitekey="6Ldd7fwUAAAAAPCU09wt00lbvnBU6cJxbFoAIdbu" style="display: table;margin-left:auto;margin-right:auto;"></div>
		            <br>
		            <input type="submit" name="registrace" class="loginButton" value="Registrovat se">
		          </form>
		          <br>
		          <div class="modal-footer">
		              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
		            </div>
		        </div>
		      </div>
		    </div>

		  <div class="modal fade seminor-login-modal" id="modalLogin" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		      <div class="modal-content">
		        <div class="modal-header">
		          <h5 class="modal-title" id="exampleModalLabel">Přihlásit se</h5>
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
		        <div class="modal-body">
							<form class="modal-body" method="post" action="../scripts/prihlaseni.php">
		                <div class="form-group">
		                  <input type="email" class="form-control" name="email">
		                  <label class="form-control-placeholder">E-mail</label>
		                </div>
		                <div class="form-group">
		                  <input type="password" class="form-control" name="heslo1">
		                  <label class="form-control-placeholder">Heslo</label>
		                </div>
										<div class="create-new-fau text-center pt-3">
											<a href="phpStranky/zapomenuteHeslo.php" class="text-primary-fau">Zapomenuté heslo</a>
		                </div>
		                <input type="submit" name="login" class="loginButton" value="Login">
		                <div class="create-new-fau text-center pt-3">
		                    <a href="#" class="text-primary-fau"><span data-toggle="modal" data-target="#modalRegistr" data-dismiss="modal">Nejste zaregistrovaný? Zaregistrujte se zde!</span></a>
		                </div>
		                <br>
		          </form>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
		        </div>
		      </div>
		    </div>
		  </div>
  <!--KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL-->
  <?php
    if(isset($_SESSION['idUzivatele'])){
      if($_SESSION['stavAutor'] == 1 || $_SESSION['stavRedaktor'] == 1 || $_SESSION['stavAdmin'] == 1){
      echo '<div class="container">
          <div class="row">
            <h1 class="uvodVety">Editor událostí</h1>
          </div>
          <form class="editorPravidel" style="text-align: center;" action="../scripts/pridatUdalostSkr.php" method="post">';
        echo '<input type="text" class="form-control" style="width:30%;" placeholder="Název akce" name="nazev" id="nazev"><br>
              <input type="text" class="form-control" style="width:30%;" placeholder="Místo konání" name="misto" id="misto"><br>
              <input type="date" class="form-control" style="width:30%;" name="datum" id="datum"><br>
              <input type="text" class="form-control" style="width:30%;" placeholder="Od kdy do kdy (např. 15:00 - 17:00)" name="trvani" id="trvani"><br>
  	          <input type="text" class="form-control" style="width:50%;" placeholder="Popis akce" name="popisAkce" id="popisAkce"><br>
            <button type="submit" class="btn btn-secondary" data-dismiss="modal" name="submitBtn" style="margin-top: 15px;">Přidat událost</button>
          </form>
    </div>
    <footer id="sticky-footer" class="page-footer py-4 bg-light" style="color:black;position: absolute;width: 100%;bottom:0;">
      <div class="container text-center">
        <small>Vytvořil Luboš Kučera<br>Copyright &copy; 2020. Všechna práva vyhrazena</small>
      </div>
    </footer>';
    }
    else{
      echo '<div class="container" id="textUvod">
              <div class="row">
                <h1 class="uvodVety" style="font-size: 70px;font-weight: bold;color:white;">Něco se nepovedlo! Vrať se na úvodní stránku!</h1>
              </div>
            </div>';
    }
    }
    else{
    echo '<div class="container" id="textUvod">
            <div class="row">
              <h1 class="uvodVety" style="font-size: 70px;font-weight: bold;color:white;">Něco se nepovedlo! Vrať se na úvodní stránku!</h1>
            </div>
          </div>';
    }
  ?>
</body>
</html>
