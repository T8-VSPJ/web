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
  include 'pages/messages.php';
  	
	if($_SESSION['alert'] == 0 && $_SESSION['idUzivatele']){
	 echo ' 
	 <div style="font-size: 20px;" class="alert alert-danger">
	 <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
  <strong>Upozornění!</strong> <br>Jedná se o školní projekt týmu T8 do předmětu RSP!
</div>';
    $_SESSION['alert'] = 1;
	}
	
	
			$sql = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 0";
			$vys = mysqli_query($pripojeni,$sql);
	$sqlBox = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 4";
	$vysBox = mysqli_query($pripojeni,$sqlBox);
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
								<section class="row';if(mysqli_num_rows($vysBox)<1){echo ' justify-content-center';} echo '">
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
																<a href="pages/clanky.php?clanek'.$row['id'].'">';
																	if($row['fotka'] > 0){
	                                  $id=$row['id'];
	            											$filename="photos/clanek".$id."*";
	            											$fileinfo=glob($filename);
	            											$fileext=explode(".",$fileinfo[0]);
																	 echo '<img src="photos/clanek'.$id.'.'.$fileext[1].'" id="fotoCarousel" class="img-fluid w-100" alt="Uvodni fotografie clanku">';
																	}
																	else{
																	 echo '<img src="photos/default.jpg" class="img-fluid w-100" id="fotoCarousel'.$row['id'].'" alt="Uvodni fotografie clanku">';
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
																	<span class="news-author text-white"><a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																	<span class="news-date text-white">| '.date('d.m.Y', $datumik).'</span>
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
																<a href="pages/clanky.php?clanek'.$row['id'].'">';
																	if($row['fotka'] > 0){
	                                  $id=$row['id'];
	            											$filename="photos/clanek".$id."*";
	            											$fileinfo=glob($filename);
	            											$fileext=explode(".",$fileinfo[0]);
																	 echo '<img src="photos/clanek'.$id.'.'.$fileext[1].'" class="img-fluid w-100" id="fotoCarousel" alt="Uvodni fotografie clanku">';
																	}
																	else{
																	 echo '<img src="photos/default.jpg" class="img-fluid w-100" id="fotoCarousel'.$row['id'].'" alt="Uvodni fotografie clanku">';
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
																	<span class="news-author text-white"><a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																	<span class="news-date text-white">| '.date('d.m.Y', $datumik).'</span>
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
									<!--End slider news-->';
										
											if(mysqli_num_rows($vysBox)>0){
											   
								echo	'<!--Start box news-->
									<div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
										<div class="row">
											<!--news box-->';
									
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
											<!--end news box-->
										</div>
									</div>
									<!--End box news-->'; 
											}

						echo	'	</section>
								<!--END SECTION-->
							</div>
						</div>
					</div>';
			}
			
				echo '</div>
				<br>
			  <hr>
			  <br>
			  <div class="box">
			    <div class="container">
			     	<div class="row justify-content-center">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="box-part text-center">
			                        <i class="fab fa-facebook-f fa-5x" style="color:#4c6ef5;margin-bottom:10px;"></i>
									<div class="title">
										<h4>Facebook</h4>
									</div>
									<div class="text">
										<span>Pokud máte zájem probrat věci z webu můžete mě kontaktovat zde.</span>
									</div>
									<a href="https://www.facebook.com/lubos.kucera.961/" target="_blank">Přejít na facebook</a>
								 </div>
							</div>
			
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								<div class="box-part text-center">
			                        <i class="fab fa-github fa-5x" style="color:#24292e;margin-bottom:10px;"></i>
									<div class="title">
										<h4>Github</h4>
									</div>
									<div class="text">
										<span>Kompletní dokumentaci a zdrojové kódy tohoto webu naleznete na skupinovém úložišti. Pro vstup do úložiště je třeba mě kontaktovat (facebook).</span>
									</div>
									<a href="https://github.com/T8-VSPJ" target="_blank">Přejít na úložiště</a>
								 </div>
							</div>
					</div>
			    </div>
			</div>
			<hr>';
	?>


</body>
</html>
