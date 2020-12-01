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
      <a class="navbar-brand" id="menuUvodLogo" href="../index.php"><img src="../photos/logospolytechnikos_logo.png" class="logoNavbar" alt="navbar logo"></a>
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
                            echo '<img src="../profilovky/profile'.$_SESSION['idUzivatele'].'.'.$fileext[1].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>';
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
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$idClanku = substr($celaURL, strrpos($celaURL, 'a')+1);

		if($celaURL == "http://localhost/pages/clanky.php" || $celaURL=="http://loclahost/clanky.php" || $celaURL=="http://localhost/pages/clanky.php?strana".$idClanku){
			if($idClanku == 1){
				$pom = 0;
			}
			else if($idClanku > 1){
				$pom=($idClanku-1)*10;
			}
			else{
				$pom = 0; //POKUD je adresa defaultni (bez cisla stranek) tak se zobrazi prvnich 10 prispevku
			}
			$sql = "SELECT * FROM clanky ORDER BY id DESC LIMIT 10 OFFSET $pom;"; 	//limit 10 clanku, OFFSET - od kolikateho prispevku bude vypisovat
			$vys = mysqli_query($pripojeni,$sql);	//provedení sql dotazu, ve kterém si beru vše od posledního id k prvnímu id

			if(mysqli_num_rows($vys)>0){	//pokud sql tabulka neco obsahuje tak se if provede
				echo '
        <br>
        <div class="container">
          <h1 class="nadpisNastaveni" style="margin-bottom:50px;">Články</h1>
						<div class="row">
							<div class="col-md-12">
							  <p>Zde naleznete všechny články</p>
							</div>
						</div>';
				while($row = mysqli_fetch_assoc($vys)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
					$idcko=$row['id_autora'];
					$sqli = "SELECT * FROM uzivatele WHERE id=$idcko"; 	//limit - max int
					$vysi = mysqli_query($pripojeni,$sqli);
					$rowUzivatel = mysqli_fetch_assoc($vysi);

					$datumik = strtotime($row['datum']);	//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)

					$id=$row['id'];

					echo '<div class="row">
							<div class="col-md-9">

								<div class="row mb-2">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-4">';
														if($row['status'] == 1){
                              $filename="../photos/clanekUvod".$id."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);
														 echo '<img src="../photos/clanekUvod'.$id.'.'.$fileext[3].'" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														else{
														 echo '<img src="../photos/default.jpg" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
											  echo '</div>
													<div class="col-md-8" id="textClankuCss">
														<div class="news-title">
															<a href="?clanek'.$row['id'].'"><h5>'.$row['titulek'].'</h5></a>
														</div>
														<div class="news-cats">
															<ul class="list-unstyled list-inline mb-1">
																<li class="list-inline-item">
																		<small><i class="fas fa-align-left" style="margin-right:5px;"></i>'.$row['zarazeni'].'</small>
																</li>
																 <li class="list-inline-item">
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>Autor: '.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
														</div>
														<div class="news-content">
															<p>'.$row['text'].'</p>
														</div>
														<div class="news-buttons">
															<a class="btn btn-outline-danger btn-sm" href="?clanek'.$row['id'].'">Zobrazit vše</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>';
							$_SESSION['posledniIdStranky']=$row['id'];
				}
				echo '<div class="row mb-2">
							<div class="col-md-12">
								<nav aria-label="Page navigation example">
								  <ul class="pagination">
									<li class="page-item">';
									if($idClanku==1){
							   echo	 '<a class="page-link" href="http://localhost/pages/clanky.php?strana'.($idClanku-1).'" aria-label="Previous" style="background-color: #ffc9c9;pointer-events: none;">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
									else if($idClanku > 1){
							echo	 '<a class="page-link" href="http://localhost/pages/clanky.php?strana'.($idClanku-1).'" aria-label="Previous">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
									else{
							echo	 '<a class="page-link" href="http://localhost/pages/clanky.php?strana1" aria-label="Previous" style="background-color: #ffc9c9;pointer-events: none;">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
							   echo  '</li>';
										$sql = "SELECT * FROM clanky";
										$vys=mysqli_query($pripojeni,$sql);
										$vsechnyClankyPocet = mysqli_num_rows($vys);


										if($vsechnyClankyPocet < 10)
										{
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10) + 1;
										}
										else if($vsechnyClankyPocet == 10){
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10);
										}
										else{
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10) + 1;
										}
										$pomKontrola=0;
										echo '<li class="page-item"><a class="page-link" href="http://localhost/pages/clanky.php?strana1">1</a></li>';
										for ($i = 2; $i <= $_SESSION['pocetStran']; $i++) {
											echo '<li class="page-item"><a class="page-link" href="http://localhost/pages/clanky.php?strana'.$i.'">'.$i.'</a></li>';
											$pomKontrola=$i;
										}
							echo  '<li class="page-item">';
								if($idClanku==$pomKontrola){
								   echo	 '<a class="page-link" href="http://localhost/pages/clanky.php?strana'.($idClanku+1).'" aria-label="Next" style="background-color: #ffc9c9;pointer-events: none;">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  	</a>';
										}
								else if($idClanku == "nky.php")
								{
									echo	 '<a class="page-link" href="http://localhost/pages/clanky.php?strana2" aria-label="Next">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  	</a>';
								}
								else{
								echo  '<a class="page-link" href="http://localhost/pages/clanky.php?strana'.($idClanku+1).'" aria-label="Next">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  </a>';
								}
							echo  '</li>
								  </ul>
								</nav>
							</div>
						</div>
					</div>';
			}else{
				header("Location: clanky.php?zadneprispevky");	//pokud nemame žadné příspěvky tak vyhodíme chybu do URL, že nejsou žádné příspěvky
				exit();
			}
		}
	?>
  <?php
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci



		$sqli = "SELECT * FROM clanky WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
		$vysi = mysqli_query($pripojeni,$sqli);

		if(strpos($celaURL,"clanek".$idClanku."") == true){	//zjistuji jestli URL obsahuje clanek s ID, na které uživatel klikne, když chce zobrazit přispěvek
			if($row = mysqli_fetch_assoc($vysi)){
		   	$_SESSION['idClanku']=$row['id'];
			$_SESSION['titulekClanku'] = $row['titulek'];
			$_SESSION['clanekSamotny'] = $row['text'];

			$datumik = strtotime($row['datum']);
			$idcko=$row['id_autora'];
			$sqli = "SELECT * FROM uzivatele WHERE id=$idcko"; 	//limit - max int
			$vysi = mysqli_query($pripojeni,$sqli);
			$rowUzivatel = mysqli_fetch_assoc($vysi);



			echo '<div class="container" style="margin-top:30px;">
					<div class="row">
						<div class="col-md-9">
							<div class="row mb-2">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body" style="padding:10px;">
											<div class="row">
												<div class="col-md-12">
													<div class="news-title">
														<h2>'.$row['titulek'].'</h2>
													</div>
													<div class="news-cats">
														<ul class="list-unstyled list-inline mb-1">
																<li class="list-inline-item">
																		<small><i class="fas fa-align-left" style="margin-right:5px;"></i>'.$row['zarazeni'].'</small>
																</li>
																 <li class="list-inline-item">
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>Autor: '.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
														if($row['status'] == 1){
                              $filename="../photos/clanekUvod".$_SESSION['idClanku']."*";
                        			$fileinfo=glob($filename);
                        			$fileext=explode(".",$fileinfo[0]);
														 echo '<img src="../photos/clanekUvod'.$_SESSION['idClanku'].'.'.$fileext[3].'" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														else{
														 echo '<img src="../photos/default.jpg" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														echo '<p class="text-muted ">'.$row['popisUvod'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['text'].'</p>
													</div>
													<hr>';
													if(isset($_SESSION['idUzivatele']))
													{
														echo '
														<p style="float:left;">
														Ohodnotit článek<br>
														Každé hodnocení nás posouvá vpřed! Děkujeme</p>
														<form action="" method="post">
															<div class="rating">
																	<input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
																	<input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
																	<input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
																	<input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
																	<input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
															</div>
														</form>';
													}
													/*
													if($_SESSION['adminStav'] == 1){
													echo '<div class="news-footer">
																<div class="news-likes">
																	<form action="../php_soubory/smazatPrispevek.php" method="post" style="margin-bottom:10px;">
																	 	<button type="submit" class="btn btn-danger" name=smazat style="float:left;clear:left;">Smazat</button>
																	</form>
																	<form action="../php_stranky/editorUprava.php" method="post">
																		<button type="submit" class="btn btn-warning" name=upravit style="float:left;margin-left:10px;">
																			Upravit
																		</button>
																	 </form>
																</div>
														  </div>';
													}
													*/
										echo  '</div>
											</div>

										</div>

									</div>

								</div>

							</div>

						</div>
						<div class="col-md-3">
							<div class="row mb-2">
								<div class="col-md-12">
						 			<div class="card">
										<div class="row">
										<div class="col-md-12">
											<div class="card" style="border:unset;">
												<div class="card-body" style="padding:7px;">
													<h5>Menu</h5>
												</div>
											</div>
										</div>
											</div>
												<div class="list-group">
													<a href="javascript:history.back()" class="list-group-item list-group-item-action">Zpět</a>	<!-- php skript na vraceni se zpet podle historie prohlizeni -->
													<a href="javascript:fbshareCurrentPage()" class="list-group-item list-group-item-action">Sdílet</a>
													<a href="#" data-toggle="modal" data-target="#modalBan" class="list-group-item list-group-item-danger">Nahlásit chybu</a>
													<div class="modal fade" tabindex="-1" role="dialog" id="modalBan" aria-hidden="true">
													  <div class="modal-dialog" role="document">
														<div class="modal-content">
														  <div class="modal-header">
															<h5 class="modal-title">Nahlásit chybu v příspěvku</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															  <span aria-hidden="true">&times;</span>
															</button>
														  </div>
														  <div class="modal-body">
															<p>Našli jste chybu v příspěvku?<br> Neváhejte nás kontaktovat o problému a my se s ním vypořádáme!<br>
															   Popiště váš problém do textového pole níže.<br>
															   Např.:
															</p>
															<ul>
																<li>Příspěvek se špatně zobrazuje na telefoním zařízení</li>
																<li>V textu je pravopisná chyba</li>
															</ul>


															<form action="../php_soubory/zadostOpravaClanku.php" method="post">
															<textarea style="width:100%;" name=content>
															</textarea>
															</div>
														  <div class="modal-footer">
																<input type="hidden" name="idClanku" value="'.$row['id'].'">
																<input type="hidden" name="titulekClanku" value="'.$row['titulek'].'">
																<input type="hidden" name="datumVytvoreniClanku" value="'.$row['datum'].'">
																<button type="submit" class="btn btn-danger" name=submitProblem>Odeslat žádost</button>
															</form>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
														  </div>
														</div>
													  </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="card">
												<div class="card-body">
													fotka
												</div>
											</div>
										</div>
									</div>
						</div>
					</div>
				</div>';
		  }
		}
		if($celaURL=="http://localhost/pages/clanky.php?clanek".$idClanku){
			echo '<div class="container" style="margin-top: 20px;margin-bottom: 20px;padding: 20px">
			';
			$sqlKoment="SELECT * FROM komentar WHERE id_clanku=$idClanku;";
			$vysKoment=mysqli_query($pripojeni,$sqlKoment);


			while($rowKoment = mysqli_fetch_assoc($vysKoment))
			{
				$pomJmeno=$rowKoment['id_uzivatele'];
				$sqli = "SELECT * FROM uzivatele WHERE id=$pomJmeno"; 	//limit - max int
				$vysi = mysqli_query($pripojeni,$sqli);
				$rowUzivatel = mysqli_fetch_assoc($vysi);
			echo			  '<div class="row">
										<div class="col-md-6">
						            <div class="karta"> <i class="fa fa-quote-left u-color"></i>
						                <div class="textKomentare">'.$rowKoment['textKomentare'].'</div>
						                <div class="d-flex justify-content-between align-items-center" style="margin-top:20px;margin-bottom">
						                    <div class="user-about"> <span class="font-weight-bold d-block">'.$rowUzivatel['jmeno'].'</span> <span class="u-color">Designer | Developer</span>
						                        <div class="d-flex flex-row mt-1"> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star-o u-color"></i> <i class="fa fa-star-o u-color"></i> <i class="fa fa-star-o u-color"></i> </div>
						                    </div>';
																if($rowUzivatel['profilova_fotografie'] == 1){
		                              $filename="../profilovky/profile".$rowUzivatel['id']."*";
		                        			$fileinfo=glob($filename);
		                        			$fileext=explode(".",$fileinfo[0]);
																 echo '<div class="user-image"><img src="../profilovky/profile'.$_SESSION['idUzivatele'].'.'.$fileext[1].'" class="rounded-circle" width="70" alt="Uvodni fotografie clanku"></div>';
																}
																else{
																 echo '<div class="user-image"><img src="../profilovky/default.jpg" class="rounded-circle" width="70" alt="Uvodni fotografie clanku"></div>';
																}
																echo '
						                </div>
						        </div>
									</div>
						</div>';
			}
			echo '</div>';
		}
		if(isset($_SESSION['idUzivatele']) && $celaURL=="http://localhost/pages/clanky.php?clanek".$idClanku){
			$_SESSION['idDiskuze']=$idClanku;
			echo '<div class="container">
						<div style="margin-top:40px;">';
			echo '<p style="font-size:18px;"><strong>Vložit komentář k tématu</strong></p>';
			if(!isset($_POST['upravitKomentar'])){
			echo '<form id="textAreaKoment" method="post" action="../scripts/pridejKomentar.php">
							<textarea name="content" style="width:70%;float:left;">
							</textarea>
						<button name="submitKomentar" class="btn btn-dark btn-lg" type="submit" style="margin-top:10px;float:left;clear:left;margin-bottom:50px;">Přidat komentář</button>
						</form>';
			}
			echo '</div></div>';
		}
	?>
</body>
</html>
