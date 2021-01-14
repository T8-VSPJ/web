<?php
	session_start();
	include_once 'scripts/dtb.php';

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
<link rel="stylesheet" type="text/css" href="Bootstrap/styly.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src='https://www.google.com/recaptcha/api.js?hl=cs'></script>

<link rel="shortcut icon" href="photos/favicon.ico" type="image/x-icon">
<link rel="icon" href="photos/favicon.ico" type="image/x-icon">
</head>
<body>



  <?php
  include "menu.php";
  	
	if($_SESSION['alert'] == 0 && $_SESSION['idUzivatele']){
	 echo ' 
	 <div style="font-size: 20px;" class="alert alert-danger">
	 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  <strong>Upozornění!</strong> <br>Jedná se o školní projekt týmu T8 do předmětu RSP!
</div>';
    $_SESSION['alert'] = 1;
	}
	
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if($celaURL=="http://logospolytechnos.mzf.cz/index.php" || $celaURL=="http://logospolytechnos.mzf.cz/" || $celaURL=="http://logospolytechnos.mzf.cz/index.php?prihlaseni=uspesne")
		{
			$sql = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 0";
			$vys = mysqli_query($pripojeni,$sql);

			if(mysqli_num_rows($vys)>0){

				echo '<div class="container">
						<div class="row mb-2">
							<div class="col-12 text-center pt-3">
								<h1>Vítejte na Logos Polytechnikos!</h1>
								<p>Web zabývající se aktualitami Vysoké školy Polytechnické v Jihlavě!</p>
								<h2>Nejnovější články</h2>
							</div>
						</div>
						<div class="row">
							<!--Start include wrapper-->
							<div class="include-wrapper pb-5 col-12">
								<!--SECTION START-->
								<section class="row">
									<!--Start slider news-->
									<div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
										<div id="featured" class="carousel slide carousel" data-ride="carousel">
											<!--slider navigate-->
											<ol class="carousel-indicators top-indicator">
												<li data-target="#featured" data-slide-to="0" class="active"></li>
												<li data-target="#featured" data-slide-to="1"></li>
												<li data-target="#featured" data-slide-to="2"></li>
												<li data-target="#featured" data-slide-to="3"></li>
											</ol>

											<!--carousel inner-->
											<div class="carousel-inner">';
											if($row = mysqli_fetch_assoc($vys)){
												$idcko=$row['id_autora'];
												$sqli = "SELECT * FROM uzivatele WHERE id=$idcko"; 	//limit - max int
												$vysi = mysqli_query($pripojeni,$sqli);
												$rowUzivatel = mysqli_fetch_assoc($vysi);
												$datumik = strtotime($row['datum']);//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)



												echo '<!--Item slider-->
												<div class="carousel-item active">
													<div class="card border-0 rounded-0 text-light overflow zoom">
														<!--thumbnail-->
														<div class="position-relative">
															<!--thumbnail img-->
															<div class="ratio_left-cover-1 image-wrapper">
																<a href="'.$row['id'].'">';
																	if($row['status'] == 1){
	                                  $id=$row['id'];
	            											$filename="photos/clanekUvod".$id."*";
	            											$fileinfo=glob($filename);
	            											$fileext=explode(".",$fileinfo[0]);
																	 echo '<img src="photos/clanekUvod'.$id.'.'.$fileext[1].'" id="fotoCarousel" class="img-fluid w-100" alt="Uvodni fotografie clanku">';
																	}
																	else{
																	 echo '<img src="photos/default.jpg" class="img-fluid w-100" id="fotoCarouselDve" alt="Uvodni fotografie clanku">';
																	}
														echo   '</a>
															</div>

															<!--title-->
															<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow"  style="text-align:center;">
																<!--title and description-->
																<a href="'.$row['id'].'">
																	<h2 class="h3 post-title text-white my-1">'.$row['titulek'].'</h2>
																</a>

																<!-- meta title -->
																<div class="news-meta">
																	<span class="news-author text-white">Autor: <a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																	<span class="news-date text-white">'.date('d.m.Y', $datumik).'</span>
																</div>
															</div>
															<!--end title-->
														</div>
														<!--end thumbnail-->
													</div>
												</div>';
											}
											while($row = mysqli_fetch_assoc($vys)){

												echo '<!--Item slider-->
												<div class="carousel-item">
													<div class="card border-0 rounded-0 text-light overflow zoom">
														<!--thumbnail-->
														<div class="position-relative">
															<!--thumbnail img-->
															<div class="ratio_left-cover-1 image-wrapper">
																<a href="'.$row['id'].'">';
																	if($row['status'] == 1){
	                                  $id=$row['id'];
	            											$filename="photos/clanekUvod".$id."*";
	            											$fileinfo=glob($filename);
	            											$fileext=explode(".",$fileinfo[0]);
																	 echo '<img src="photos/clanekUvod'.$id.'.'.$fileext[1].'" class="img-fluid w-100" id="fotoCarousel" alt="Uvodni fotografie clanku">';
																	}
																	else{
																	 echo '<img src="photos/default.jpg" class="img-fluid w-100" id="fotoCarouselDve" alt="Uvodni fotografie clanku">';
																	}
														echo    '</a>
															</div>

															<!--title-->
															<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow"  style="text-align:center;">
																<!--title and description-->
																<a href="'.$row['id'].'">
																	<h2 class="h3 post-title text-white my-1">'.$row['titulek'].'</h2>
																</a>

																<!-- meta title -->
																<div class="news-meta">
																	<span class="news-author text-white">Autor: <a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																	<span class="news-date text-white">'.date('d.m.Y', $datumik).'</span>
																</div>
															</div>
															<!--end title-->
														</div>
														<!--end thumbnail-->
													</div>
												</div>';
											}
										echo'
												<!--end item slider-->
											</div>
											<!--end carousel inner-->
										</div>
										<!--navigation-->
										<a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#featured" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									</div>
									<!--End slider news-->

									<!--Start box news-->
									<div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
										<div class="row">
											<!--news box-->';
											$sqlBox = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 4";
											$vysBox = mysqli_query($pripojeni,$sqlBox);
											while($rowBox = mysqli_fetch_assoc($vysBox)){
												$idBox=$rowBox['id'];

												echo '
												<div class="col-6 pb-1 pt-0 pr-1" style="margin-right:-10px;">
													<div class="card border-0 rounded-0 text-white overflow zoom">
														<!--thumbnail-->
														<div class="position-relative">
															<!--thumbnail img-->
															<div class="ratio_right-cover-2 image-wrapper">
																<a href="'.$rowBox['id'].'">';
																	if($rowBox['status'] == 1){
	                                  $fileN="photos/clanekUvod".$idBox."*";
	            											$fileI=glob($fileN);
	            											$fileX=explode(".",$fileI[0]);
																	 echo '<img src="photos/clanekUvod'.$idBox.'.'.$fileX[1].'" class="img-fluid w-100" id="fotoPostr" alt="Uvodni fotografie clanku">';
																	}
																	else{
																	 echo '<img src="photos/default.jpg" class="img-fluid w-100" id="fotoPostrDve" alt="Uvodni fotografie clanku">';
																	}
													echo		'</a>
															</div>

															<!--title-->
															<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow" style="position:absolute;">
																<!-- category -->
																<a class="p-1 badge badge-primary rounded-0" href="pages/clanky.php?clanek'.$rowBox['id'].'">'.$rowBox['zarazeni'].'</a>

																<!--title and description-->
																<a href="pages/clanky.php?clanek'.$rowBox['id'].'">
																	<h2 class="h5 text-white my-1">'.$rowBox['titulek'].'</h2>
																</a>
															</div>
															<!--end title-->
														</div>
														<!--end thumbnail-->
													</div>
												</div>';
											}

											echo '
											</div>
											<!--end news box-->
										</div>
									</div>
									<!--End box news-->
								</section>
								<!--END SECTION-->
							</div>
						</div>
					</div>';
			}
			echo '<br>
					  <hr>
						<div class="container">
							<div class="row">
						    <div class="col-sm-4">
						      <h3>Nejkomentovanější články</h3>';
										$sqlKom = "SELECT id_clanku FROM komentar GROUP BY id_clanku";
										$vysKom = mysqli_query($pripojeni,$sqlKom);
										$max=0;
										$idMax=0;
										while($rowKom=mysqli_fetch_assoc($vysKom))
										{
												$pomKom=$rowKom['id_clanku'];
												$sqlKome = "SELECT COUNT(id_clanku) as total FROM komentar WHERE id_clanku=$pomKom;";
												$vysKome = mysqli_query($pripojeni,$sqlKome);

												$poc=mysqli_fetch_assoc($vysKome);
												if($poc > $max)
												{
													$max=$poc['total'];
													$idMax=$rowKom['id_clanku'];
												}
										}
										$sqlCla = "SELECT * FROM clanky WHERE id=$idMax;";
										$vysCla = mysqli_query($pripojeni,$sqlCla);
										$rowCla=mysqli_fetch_assoc($vysCla);

										echo '<div class="d-flex justify-content-center container mt-5">
														<div class="card p-2">
																<div class="d-flex justify-content-between align-items-center text-black-50 mb-3" style="width:100%;"><span class="text-uppercase review-text">'.$rowCla['titulek'].'</span><i class="fa fa-info-circle" style="margin-left:10px;"></i></div>
																<div class="d-flex justify-content-between mt-3">
																		<div class="d-flex flex-column align-items-center mr-2 border-right px-2">
																				<div class="num-comment"><span class="mr-1">'.$max.'</span><i class="fa fa-comments" style="color:red;"></i></div><span class="text-uppercase">komentářů</span>
																		</div>
																		<a href="www.google.com">Přejít na článek</a>
																</div>
														</div>';
						echo	'</div>
						    </div>
						    <div class="col-sm-4">
						      <h3>Nejlépe hodnocené články</h3>
						      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean fermentum risus id tortor. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Nam sed tellus id magna elementum tincidunt. Aenean fermentum risus id tortor. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Fusce tellus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Nulla est. Fusce tellus. Vivamus luctus egestas leo.</p>
						    </div>
						    <div class="col-sm-4">
						      <h3>Covid-19 aktuálně</h3>
									<iframe src="https://ourworldindata.org/grapher/total-cases-covid-19?tab=map" width="100%" height="500px"></iframe>
						    </div>
						  </div>
					</div>
					  <br>
						<hr>
					  <br>
					  <div class="container" style="margin-bottom:10px;">
					    <h2>Školní akce</h2>
					    <br>';
			$sql = "SELECT * FROM skolniakce";
			$vys = mysqli_query($pripojeni,$sql);
			while($row = mysqli_fetch_assoc($vys))
			{
			$datum = strtotime($row['datum']);
			echo '<hr><div class="row row-striped">
							<div class="col-2 text-right">
								<h1 class="display-4"><span class="badge badge-danger">'.date("d",$datum).'</span></h1>';
								if(date("m",$datum)==1)
									echo '<h2>Led</h2>';
								else if(date("m",$datum)==2)
									echo '<h2>Úno</h2>';
								else if(date("m",$datum)==3)
									echo '<h2>Bře</h2>';
								else if(date("m",$datum)==4)
									echo '<h2>Dub</h2>';
								else if(date("m",$datum)==5)
									echo '<h2>Kvě</h2>';
								else if(date("m",$datum)==6)
									echo '<h2>Čvn</h2>';
								else if(date("m",$datum)==7)
									echo '<h2>Čvc</h2>';
								else if(date("m",$datum)==8)
									echo '<h2>Srp</h2>';
								else if(date("m",$datum)==9)
									echo '<h2>Zář</h2>';
								else if(date("m",$datum)==10)
									echo '<h2>Říj</h2>';
								else if(date("m",$datum)==11)
									echo '<h2>Lis</h2>';
								else if(date("m",$datum)==12)
									echo '<h2>Pro</h2>';
			echo		'</div>
							<div class="col-10">
								<h3 class="text-uppercase"><strong>'.$row['nazev'].'</strong></h3>
								<ul class="list-inline">';
									if(date("l",$datum)=="Monday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Pondělí</li>';
									else if(date("l",$datum)=="Tuesday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Úterý</li>';
									else if(date("l",$datum)=="Wednesday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Středa</li>';
									else if(date("l",$datum)=="Thursday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Čtvrtek</li>';
									else if(date("l",$datum)=="Friday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Pátek</li>';
									else if(date("l",$datum)=="Saturday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Sobota</li>';
									else if(date("l",$datum)=="Sunday")
										echo '<li class="list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>Neděle</li>';

			echo					'<li class="list-inline-item"><i class="fa fa-clock-o" aria-hidden="true"></i>'.$row['kdy'].'</li>
									<li class="list-inline-item"><i class="fa fa-location-arrow" aria-hidden="true"></i>'.$row['misto'].'</li>
								</ul>
								<p>'.$row['popis'].'</p>
							</div>
						</div>
						<hr>';
				}
				echo '</div>
				<br>
			  <hr>
			  <br>
			  <div class="box">
			    <div class="container">
			     	<div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="box-part text-center">
			                        <i class="fab fa-facebook-f fa-5x" style="color:#4c6ef5;margin-bottom:10px;"></i>
									<div class="title">
										<h4>Facebook</h4>
									</div>
									<div class="text">
										<span>Pokud máte zájem probrat věci z webu můžete mě kontaktovat zde. Jmenuji se Luboš Kučera, rád dělám webové aplikace. V případě zájmu mě neváhejte kontaktovat.</span>
									</div>
									<a href="https://www.facebook.com/lubos.kucera.961/" target="_blank">Přejít na facebook</a>
								 </div>
							</div>
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="box-part text-center">
								    <i class="fab fa-google fa-5x" style="color:red;margin-bottom:10px;"></i>
									<div class="title">
										<h4>Google</h4>
									</div>
									<div class="text">
										<span>Nejste s něčím spokojen a nebo naopak s něčím ohromen? Dejte nám vědět na náš e-mail a my si vaše názory přečteme! Díky vaší komunikaci s námi nám pomáháte zlepšovat web.</span>
									</div>
									<a href="https://google.com/" target="_blank">Kontaktovat</a>
								 </div>
							</div>
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="box-part text-center">
			                        <i class="fab fa-github fa-5x" style="color:#24292e;margin-bottom:10px;"></i>
									<div class="title">
										<h4>Github</h4>
									</div>
									<div class="text">
										<span>Kompletní dokumentaci a zdrojové kódy tohoto webu naleznete na skupinovém úložišti. Pro vstup do úložiště je třeba kontaktovat autora webu (facebook).</span>
									</div>
									<a href="https://github.com/T8-VSPJ" target="_blank">Přejít na úložiště</a>
								 </div>
							</div>
					</div>
			    </div>
			</div>
			<hr>';
		}
	?>


</body>
</html>
