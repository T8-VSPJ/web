<?php
  session_start();
  include '../scripts/kontrola.php';
  include_once '../scripts/dtb.php';

  $celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$sessionid=$_SESSION['idUzivatele'];
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
	else if(strpos($celaURL,"profil=neplatny") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Jméno nebylo změněno!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"profil=chyba") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Uživatelský účet nebyl nalezen!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"profil=neplatneheslo") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Heslo nesplňuje požadavky (8 znaků)!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"profil=hesloneexistuje") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Zadal/a jste špatné heslo!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"profil=uzivatelskejmenoexistuje") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Uživatelské jméno je již zabrané!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"profil=emailexistuje") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Email je už používaný na jiném účtě!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"prihlaseni=spatneheslo") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Účet s těmito údaji nebyl nalezen!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"prihlaseni=chyba") == true){
		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Pozor!</strong> Zadal/a jste špatně údaje!
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
	else if(strpos($celaURL,"profil=uspesny") == true){
		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Úspěšně jste si změnil/a nastavení profilu!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	else if(strpos($celaURL,"prihlaseni=uspesne") == true){
		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
							<strong>Úspěšně jste se přihlásil/a!</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';
	}
	if(strpos($celaURL,"uzivatel==zabanovan") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste zabanoval uživatele!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==unbanned") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste unBANoval uživatele!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==smazan") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste smazal profil uživatele!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"error=spatnezadejmeno") == true){
  		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Pozor!</strong> Zadané jméno má špatný tvar!
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"error=spatnezadanyemail") == true){
  		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Pozor!</strong> Zadaný e-mail má špatný tvar!
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"error=spatnezadanyemailajmeno") == true){
  		echo	'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Pozor!</strong> Zadaný e-mail i jméno má špatný tvar!
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"smazaniProfiloveFotky=uspesne") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste smazal profilovou fotografii uživatele!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"smazaniProfiloveFotky=neuspesne") == true){
  		echo	'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Pozor!</strong> Profilová fotografie uživatele se nesmazala! Kontaktujte administrátora
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==autor") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste nastavil roli autora!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==autrunset") == true){
  		echo	'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMess">
  							Odebral jste roli autora
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==redaktor") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste nastavil roli redaktora!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==redktorunset") == true){
  		echo	'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMess">
  							Odebral jste roli redaktora
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==recenzent") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste nastavil roli recenzenta!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	else if(strpos($celaURL,"uzivatel==recnzentunset") == true){
  		echo	'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMess">
  							Odebral jste roli recenzenta
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
    else if(strpos($celaURL,"uzivatel==sefredaktor") == true){
  		echo	'<div class="alert alert-success alert-dismissible fade show" role="alert" id="errorMess">
  							<strong>Úspěšně jste nastavil roli šéfredaktora!</strong>
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
  	
  	else if(strpos($celaURL,"uzivatel==sefrdunset") == true){
  		echo	'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorMess">
  							Odebral jste roli šéfredaktora
  							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  								<span aria-hidden="true">&times;</span>
  							</button>
  						</div>';
  	}
	?>
