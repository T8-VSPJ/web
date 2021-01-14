  <nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" id="menuUvodLogo" href="index.php"><img src="photos/logo.png" class="logoNavbar" alt="navbar logo"></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="menuUvod">
          <li class="nav-item">
            <a class="nav-link" href="pages/clanky.php"><i class="fas fa-clipboard-list" style="margin-right:7px;"></i>Články</a>
          </li>
        </ul>
        <div class="ml-auto" id="profilLinky">
          <?php
            if(!isset($_SESSION['idUzivatele'])){
                echo '<button type="submit" class="btn btn-light btn-lg" data-toggle="modal" data-target="#modalLogin" style="margin-top: -5px;float:right;">Přihlášení</button>';
            }
            else{
              echo '<form action="scripts/odhlaseni.php" method="post" style="float:right;">
                       <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                          if($_SESSION['statusUzivatele'] == 1){
                            $filename="profilovky/profile".$_SESSION['idUzivatele']."*";
                            $fileinfo=glob($filename);
                            $fileext=explode(".",$fileinfo[0]);
                            echo '<img src="profilovky/profile'.$_SESSION['idUzivatele'].'.'.$fileext[1].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>';
                          }
                          else{
                            echo '<img src="profilovky/default.jpg" id="profilFoto" width="50" height="48" alt="Profilová fotka"></a>';
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
                              echo '<button class="dropdown-item" style="cursor:pointer; text-align: center; background-color: #a5cc9f;font-weight: bold;color:black;font-size: 20px;" disabled>Admin</button>';
                            }
              echo				'<hr><a class="dropdown-item" href="pages/nastaveni.php">Nastavení</a><hr>
              <a class="dropdown-item" href="pages/zpravy.php">Zprávy</a>';
                            if($_SESSION['stavAutor'] == 1){
                              echo	'<a class="dropdown-item" href="pages/editor.php">Přidat článek</a>';
                            }
							if($_SESSION['stavAutor'] == 1 || $_SESSION['stavRedaktor'] == 1 || $_SESSION['stavRecenzant'] == 1 || $_SESSION['stavSefredaktor'] == 1 || $_SESSION['stavAdmin'] == 1){ 	//Přidání události
								echo	'<a class="dropdown-item" href="pages/odeslaneClanky.php">Schránka příspěvků</a>';
                            }
                            if($_SESSION['stavAdmin'] == 1){
                                echo	'<a class="dropdown-item" href="pages/pridatUdalost.php">Přidat událost</a>';
								echo	'<a class="dropdown-item" href="pages/amenu.php">Admin menu</a>';
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
		          <form class="modal-body seminor-login-form" method="post" action="scripts/registrace.php">
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
								  <label class="form-check-label" for="inlineCheckbox1">Seznámil/a jsem se s <a href="pages/gdpr.php">informacemi o zpracování osobních údajů</a></label>
								</div>
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
		          <h5 class="modal-title" id="exampleModalLabel">Přihlášení</h5>
		          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true">&times;</span>
		          </button>
		        </div>
		        <div class="modal-body">
							<form class="modal-body" method="post" action="scripts/prihlaseni.php">
		                <div class="form-group">
		                  <input type="text" class="form-control" name="email">
		                  <label class="form-control-placeholder">E-mail nebo uživ. jméno</label>
		                </div>
		                <div class="form-group">
		                  <input type="password" class="form-control" name="heslo1">
		                  <label class="form-control-placeholder">Heslo</label>
		                </div>
										<div class="create-new-fau text-center pt-3">
											<a href="#" data-toggle="modal" data-target="#modalheslo" data-dismiss="modal" class="text-primary-fau">Zapomenuté heslo</a>
		                </div>
		                <input type="submit" name="login" class="loginButton" value="Přihlásit se">
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
		  
		  	<div class="modal fade seminor-login-modal"  tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" id="modalheslo" aria-hidden="true">
		      <div class="modal-dialog modal-dialog-centered modal-lg">
		        <div class="modal-content">
		          <div class="modal-header">
		           <h5 class="modal-title">Zapomenuté heslo</h5>
		          </div>
		          <br>
		          <form class="modal-body seminor-login-form" method="post" action="scripts/heslo.php">
		            <div class="form-group">
		              <input type="email" class="form-control" name="email">
		              <label class="form-control-placeholder">Váš e-mail</label>
		            </div>
		            <div class="form-group">
		              <input type="password" class="form-control" name="heslo1">
		              <label class="form-control-placeholder">Nové heslo (min. 8 znaků)</label>
		            </div>
		            <div class="form-group">
		              <input type="password" class="form-control" name="heslo2">
		              <label class="form-control-placeholder">Potvrzení nového hesla</label>
		            </div>
							
		            <br>
		            <input type="submit" name="oheslo" class="loginButton" value="Obnovit heslo">
		          </form>
		          <br>
		          <div class="modal-footer">
		              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
		            </div>
		        </div>
		      </div>
		    </div>
		  
  <!--KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL KONEC MODAL-->