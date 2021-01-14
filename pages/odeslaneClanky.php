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

<link rel="shortcut icon" href="../photos/favicon.ico" type="image/x-icon">
<link rel="icon" href="../photos/favicon.ico" type="image/x-icon">


</head>
<body>

  <?php
  include "menu.php";




if( $_SESSION['stavAutor'] == 1){
    
    	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	


if($celaURL != "http://logospolytechnos.mzf.cz/pages/odeslaneClanky.php"){
    $idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci
	$sqli = "SELECT * FROM clankyprijmuti WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
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
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>'.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
                                        	if($row['fotka'] > 0)
											{
											
                                        $filename="../photos/clanek".$row['fotka']."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);  
                    				echo '<img src="../photos/clanek'.$row['fotka'].'.'.$fileext[3].'" style="width:100%;"  alt="Uvodni fotografie clanku">';

											}
											else{
											echo '<img src="../photos/default.jpg" style="width:100%;"  alt="Uvodni fotografie clanku">';
  
											}
														echo '<p class="text-muted ">'.$row['popisUvod'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['text'].'</p>
													</div>';
										echo  '</div>
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
												
													';
												
												
													 if(isset($_SESSION['idUzivatele'])){
													$osql="SELECT * FROM clankyprijmuti WHERE id='$idClanku'";
													$ovys=mysqli_query($pripojeni,$osql);
													$orow=mysqli_fetch_assoc($ovys);
													$idos=$orow['id_recenzenta'];
													$status=$orow['status'];
            	                                        if($status == 0 && $idos == $_SESSION['idUzivatele']){
													    echo '<a href="" data-toggle="modal" data-target="#form" class="list-group-item list-group-item-danger">Ohodnotit článek</a>';
													}
													else if ($status == 1 && $_SESSION['idUzivatele']){

													    echo '<a href="" data-toggle="modal" data-target="#form2" class="list-group-item list-group-item-success">Hodnocení</a>';
													}
													
                                                    }
												
											echo '		
												
			<form method="POST" action="../scripts/ohodnoceni.php">
			<input type="hidden" name="idClanku" value="'.$idClanku.'">
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Hodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>
                    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating2" value="5" id="55"><label for="55">☆</label> <input type="radio" name="rating2" value="4" id="44"><label for="44">☆</label> <input type="radio" name="rating2" value="3" id="33"><label for="33">☆</label> <input type="radio" name="rating2" value="2" id="22"><label for="22">☆</label> <input type="radio" name="rating2" value="1" id="11"><label for="11">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating3" value="5" id="555"><label for="555">☆</label> <input type="radio" name="rating3" value="4" id="444"><label for="444">☆</label> <input type="radio" name="rating3" value="3" id="333"><label for="333">☆</label> <input type="radio" name="rating3" value="2" id="222"><label for="222">☆</label> <input type="radio" name="rating3" value="1" id="111"><label for="111">☆</label> </div>
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>
                    <div class="rating"> <input type="radio" name="rating4" value="5" id="5555"><label for="5555">☆</label> <input type="radio" name="rating4" value="4" id="4444"><label for="4444">☆</label> <input type="radio" name="rating4" value="3" id="3333"><label for="3333">☆</label> <input type="radio" name="rating4" value="2" id="2222"><label for="2222">☆</label> <input type="radio" name="rating4" value="1" id="1111"><label for="1111">☆</label> </div>
                    
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4"></textarea> </div>
                 
                </div>
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="ohodnot">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">';
       
                   $hsql="SELECT * FROM hodnoceni WHERE id_clanku='$idClanku'";
					$hvys=mysqli_query($pripojeni,$hsql);
					$hpol=mysqli_fetch_assoc($hvys);
      echo '
       <div class="modal-header border-none">   <h5 class="modal-title" id="exampleModalLabel">Hodnocení ('.date('d.m.Y', strtotime($hpol['datum_rec'])).')</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                   
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>';
         
                    if($hpol['originalita'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['originalita'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['originalita'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['originalita'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['originalita'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                     echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>';
                       if($hpol['odbornost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['odbornost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['odbornost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['odbornost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['odbornost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>';
                     if($hpol['jazyk'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['jazyk'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['jazyk'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['jazyk'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['jazyk'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>';
                       if($hpol['aktualnost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['aktualnost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['aktualnost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['aktualnost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['aktualnost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                     <div class="comment-box text-center">
                    <h4><small>Názor</small></h4>
                     </div>
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4" disabled>'.$hpol['nazor'].'</textarea> </div>
                   
                </div>
                  <div class="modal-footer">
                 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>






												</div>
											</div>
										</div>
									</div>
								
						</div>

						</div>
				</div>';
		  }
		}
	
    
    
}
else{
        $idPom=$_SESSION['idUzivatele'];
   
    $ted = date("Y-m-d");
   
      $sql = "SELECT * FROM clankyprijmuti WHERE id_autora='$idPom'"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
       $vys = mysqli_query($pripojeni,$sql);
    echo'
 
        <div class="justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Výpis vašich příspěvků</h4>
                        
						
				<div class="btn-group" style="margin-bottom:20px">
				    <button  type="button" class="btn btn-success btn-circle btn-filter" data-target="oka"><i class="fas fa-check"></i></button>
                    <button  type="button" class="btn btn-danger btn-circle btn-filter" data-target="noka"><i class="fas fa-times"></i></button>
                    <button  type="button" class="btn btn-warning btn-circle btn-filter" data-target="ceka"><i style="color:white" class="fas fa-clock"></i></button>
                    <button  type="button" class="btn btn-dark btn-circle btn-filter" data-target="all"><i style="color:white" class="fas fa-layer-group"></i></button>
				</div>
							
							
                        <div class="col-12 container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titulek</th>
                                        
                                        <th>Datum</th>
                                        <th>Redaktor</th>
                                        <th>Recenzent</th>
                                        <th> </th> 
                                        <th>Status</th>
                                       
                                     '
                                       ;
                                        
                                        
                                   echo '</tr>
                                </thead>';
                           
                           
                             

                                    while($row = mysqli_fetch_assoc($vys)){
                              $id_clanku=$row['id'];
                            $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                          
 
                                     echo '<tbody>';
                                 if($row['status'] == 11){
                                     echo '<tr data-status="oka">';
                                 }
                                 else if($row['status'] == 10)
                                 {
                                     echo '<tr data-status="noka">';
                                 }
                                 else if($row['status'] == 1){
                                     echo '<tr data-status="ceka">';
                                 }
                                 else if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0 || $row['id_recenzenta'] == 0){
                                     echo '<tr data-status="ceka">';
                                 }
                                 else{
                                       echo '<tr>';
                                 }
                                 
                                   
                                 echo' <td>'.++$i.'</td>
                                        <td>'.$row['titulek'].'</td>
                                 
                                        <td>'.date('d.m.Y', $datu).'</td>';
                                       
                                       
                                            $sql2="SELECT * FROM uzivatele WHERE id='".$row['id_redaktora']."'";
                                            $vys2=mysqli_query($pripojeni,$sql2);
                                            $row2=mysqli_fetch_assoc($vys2);
                                            $sql3="SELECT * FROM uzivatele WHERE id='".$row['id_recenzenta']."'";
                                            $vys3=mysqli_query($pripojeni,$sql3);
                                            $row3=mysqli_fetch_assoc($vys3);
                                            if($row2['jmeno'] == '' && $row3['jmeno'] == ''){
                                                 echo ' <td>-</td>
                                                        <td>-</td>
                                                 '; 
                                            }
                                            else{
                                                   echo ' <td>'.$row2['jmeno'].'</td>
                                             <td>'.$row3['jmeno'].'</td>
                                                 '; 
                                      
                                            }
                                         
                                       
                                         echo '<td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';  
                                          if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0)
                                         {
                                                 echo '  <td><label class="badge badge-warning">Čeká na ohodnocení</label></td>
                                                
                                                 '; 
                                          }
                                          else if($row['status'] == 1){
                                              echo '  <td><label class="badge badge-warning">Čeká na schválení</label></td>
                                             
                                              '; 
                                          }
                                         else if($row['status'] == 0){
                                                 echo '  <td><label class="badge badge-danger">Neohodnocen</label></td>
                                                
                                                 ';  
                                          }
                                          else if($row['status'] == 11){
                                              echo '  <td><label class="badge badge-success">Schválen</label></td>
                                              
                                              ';   
                                          }
                                          else if($row['status'] == 10){
                                               echo '  <td><label class="badge badge-danger">Zamítnut</label></td>';
                                

                                          }
                                          
                                        
                                       
                                      
                                  echo ' </tr>';
                                  
                                  
                    if($row['status'] == 1){
                          echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="schvalen'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Opravdu chcete schválit příspěvek?</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                  
';

    
   echo ' 
                  <div class="modal-footer">
                  <button class="btn btn-success send" name="schvaleni">Schválit<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
         ';
         
                          echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="zamitnut'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Opravdu chcete zamítnout příspěvek?</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                  
';

    
   echo ' 
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="zamitnuti">Zamítnout<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
         ';         
                 }
              
                 
                                            
                                        
           echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="addrecenzent'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Předat recenzentovi k ohodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>

              <div class="comment-box text-center">
              
                    <h4><small>Recenzent</small></h4>
<select style="width:90%" class="custom-select" class="form-control" name="addrecenzent">';

$sqll="SELECT * FROM uzivatele WHERE recenzent='1'";
$vyss=mysqli_query($pripojeni,$sqll);
while($polee=mysqli_fetch_assoc($vyss)){
        echo '<option value="'.$polee['id'].'">'.$polee['jmeno'].'</option>';
    }
    
   echo ' </select>
 
              </div>
          <div class="comment-box text-center">
                    <h4><small>Termín</small></h4>
                <input style="width:90%" class="form-control" type="date" name="adddo">
               </div>
               
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="addrec">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
                                            
                                            
                                
                                
                              </tbody>  ';
                               
                                    
                                }
                         
                          
                                 
                              
                      
                            echo '</table>
                                                              



                        </div>
                    </div>
                </div>
            </div>
        </div>
';

     
         
   
}
    
    ?>
    
<script>
$(document).ready(function () {


    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
           $('tbody tr').css('display', 'none');
        $('tbody tr[data-status="' + $target + '"]').css('display', 'contents');
    
      }
      else {
        $('tbody tr').css('display', 'contents');
      }
    });

 });
</script>
    <?php
    
    
    
}




if( $_SESSION['stavSefredaktor'] == 1){
    
    	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	


if($celaURL != "http://logospolytechnos.mzf.cz/pages/odeslaneClanky.php"){
    $idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci
	$sqli = "SELECT * FROM clankyprijmuti WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
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
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>'.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
                                        	if($row['fotka'] > 0)
											{
											
                                        $filename="../photos/clanek".$row['fotka']."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);  
                    				echo '<img src="../photos/clanek'.$row['fotka'].'.'.$fileext[3].'" style="width:100%;"  alt="Uvodni fotografie clanku">';

											}
											else{
											echo '<img src="../photos/default.jpg" style="width:100%;"  alt="Uvodni fotografie clanku">';
  
											}
														echo '<p class="text-muted ">'.$row['popisUvod'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['text'].'</p>
													</div>';
										echo  '</div>
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
												
													';
												
												
													 if($_SESSION['idUzivatele']){
													$osql="SELECT * FROM clankyprijmuti WHERE id='$idClanku'";
													$ovys=mysqli_query($pripojeni,$osql);
													$orow=mysqli_fetch_assoc($ovys);
													$idos=$orow['id_recenzenta'];
													$status=$orow['status'];
            	                                        if($status == 0 && $idos == $_SESSION['idUzivatele']){
													    echo '<a href="" data-toggle="modal" data-target="#form" class="list-group-item list-group-item-danger">Ohodnotit článek</a>';
													}
													else if ($status == 1 && $_SESSION['idUzivatele']){

													    echo '<a href="" data-toggle="modal" data-target="#form2" class="list-group-item list-group-item-success">Hodnocení</a>';
													}
													
                                                    }
												
											echo '		
												
			<form method="POST" action="../scripts/ohodnoceni.php">
			<input type="hidden" name="idClanku" value="'.$idClanku.'">
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Hodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>
                    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating2" value="5" id="55"><label for="55">☆</label> <input type="radio" name="rating2" value="4" id="44"><label for="44">☆</label> <input type="radio" name="rating2" value="3" id="33"><label for="33">☆</label> <input type="radio" name="rating2" value="2" id="22"><label for="22">☆</label> <input type="radio" name="rating2" value="1" id="11"><label for="11">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating3" value="5" id="555"><label for="555">☆</label> <input type="radio" name="rating3" value="4" id="444"><label for="444">☆</label> <input type="radio" name="rating3" value="3" id="333"><label for="333">☆</label> <input type="radio" name="rating3" value="2" id="222"><label for="222">☆</label> <input type="radio" name="rating3" value="1" id="111"><label for="111">☆</label> </div>
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>
                    <div class="rating"> <input type="radio" name="rating4" value="5" id="5555"><label for="5555">☆</label> <input type="radio" name="rating4" value="4" id="4444"><label for="4444">☆</label> <input type="radio" name="rating4" value="3" id="3333"><label for="3333">☆</label> <input type="radio" name="rating4" value="2" id="2222"><label for="2222">☆</label> <input type="radio" name="rating4" value="1" id="1111"><label for="1111">☆</label> </div>
                    
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4"></textarea> </div>
                 
                </div>
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="ohodnot">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">';
       
                   $hsql="SELECT * FROM hodnoceni WHERE id_clanku='$idClanku'";
					$hvys=mysqli_query($pripojeni,$hsql);
					$hpol=mysqli_fetch_assoc($hvys);
      echo '
       <div class="modal-header border-none">   <h5 class="modal-title" id="exampleModalLabel">Hodnocení ('.date('d.m.Y', strtotime($hpol['datum_rec'])).')</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                   
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>';
         
                    if($hpol['originalita'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['originalita'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['originalita'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['originalita'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['originalita'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                     echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>';
                       if($hpol['odbornost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['odbornost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['odbornost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['odbornost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['odbornost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>';
                     if($hpol['jazyk'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['jazyk'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['jazyk'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['jazyk'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['jazyk'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>';
                       if($hpol['aktualnost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['aktualnost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['aktualnost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['aktualnost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['aktualnost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                     <div class="comment-box text-center">
                    <h4><small>Názor</small></h4>
                     </div>
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4" disabled>'.$hpol['nazor'].'</textarea> </div>
                   
                </div>
                  <div class="modal-footer">
                 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>






												</div>
											</div>
										</div>
									</div>
								
						</div>

						</div>
				</div>';
		  }
		}
	
    
    
}
else{
        $idPom=$_SESSION['idUzivatele'];
   
    $ted = date("Y-m-d");
   

    echo'
 
        <div class="justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Výpis prací uživatelů</h4>
                   <select class="form-control" id="vyber">
                   <option selected disabled hidden>Zvolte výpis</option>
                      <optgroup label="Autor" id="autor"><option value="allautor" style="font-weight: bold">Všichni autoři</option>';
                            $sql = "SELECT * FROM uzivatele WHERE autor='1'"; 	 
                     $vys = mysqli_query($pripojeni,$sql);
                      	while($row=mysqli_fetch_assoc($vys)){
						   
						        echo '
									<option value="'.$row['id'].'">'.$row['jmeno'].'</option>
        
						        ';
						  
						    
						}			
                     echo '	</optgroup> 
                     <optgroup label="Redaktor" id="redaktor"><option value="allredaktor" style="font-weight: bold">Všichni redaktoři</option>';
                           $sql2 = "SELECT * FROM uzivatele WHERE redaktor='1'"; 	 
                            $vys2 = mysqli_query($pripojeni,$sql2);
						while($row2=mysqli_fetch_assoc($vys2)){
						   
						        echo '
									<option value="'.$row2['id'].'">'.$row2['jmeno'].'</option>
        
						        ';
						    
						    
						}			
                     echo '</optgroup> 
                     <optgroup label="Recenzent" id="recenzent"><option value="allrecenzent" style="font-weight: bold">Všichni recenzenti</option>';
                           $sql3 = "SELECT * FROM uzivatele WHERE recenzent='1'"; 	 
                            $vys3 = mysqli_query($pripojeni,$sql3);
							while($row3=mysqli_fetch_assoc($vys3)){
						  
						        echo '
									<option value="'.$row3['id'].'">'.$row3['jmeno'].'</option>
        
						        ';
						  
						    
						}			
                     echo '	</optgroup> 
                ';		
								
								
							
						echo '	</select> 
                     
                     
                     
                     
						
				<div id="rbtn" class="btn-group" style="margin-bottom:20px;margin-top:20px">
				    <button  type="button" class="btn btn-success btn-circle btn-filter" data-target="oka"><i class="fas fa-check"></i></button>
                    <button  type="button" class="btn btn-danger btn-circle btn-filter" data-target="noka"><i class="fas fa-times"></i></button>
                    <button  type="button" class="btn btn-warning btn-circle btn-filter" data-target="ceka"><i style="color:white" class="fas fa-clock"></i></button>
                    <button  type="button" class="btn btn-dark btn-circle btn-filter" data-target="all"><i style="color:white" class="fas fa-layer-group"></i></button>
				</div>
				
									
				<div id="rbtn2" class="btn-group" style="margin-bottom:20px;margin-top:20px">
				    <button  type="button" class="btn btn-success btn-circle btn-filter" data-target="oka"><i class="fas fa-check"></i></button>
                    <button  type="button" class="btn btn-danger btn-circle btn-filter" data-target="noka"><i class="fas fa-times"></i></button>
                    <button  type="button" class="btn btn-dark btn-circle btn-filter" data-target="all"><i style="color:white" class="fas fa-layer-group"></i></button>
				</div>
							
							
                        <div class="col-12 container">
                        <div class="table-responsive">
                        
                           <table class="table" data-status="allautor">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                          <th>Autor</th>
                                        <th>Titulek</th>
                                        <th>Datum</th>
                                
                                        <th> </th> 
                                        '
                                       ;
                                        
                                     
                                        
                                   echo '</tr>
                                </thead>';
                           
                          
                                $sql = "SELECT * FROM clankyprijmuti WHERE id_autora > 0"; 
                                $vys=mysqli_query($pripojeni,$sql);
                                 
                                while($row=mysqli_fetch_assoc($vys)){
                                    $id_clanku=$row['id'];
                                       $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
                              echo '
                                <tbody>';
                                
                                if($row['status'] == 11){
                                    echo '<tr data-userid="'.$row['id_autora'].'"  data-status="oka">';
                                 }
                                 else if($row['status'] == 10)
                                 {
                                     echo '<tr data-userid="'.$row['id_autora'].'"  data-status="noka">';
                                 }
                                 else if($row['status'] == 1){
                                     echo '<tr data-userid="'.$row['id_autora'].'"  data-status="ohod">';
                                 }
                                 else if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0 || $row['id_recenzenta'] == 0){
                                     echo '<tr data-userid="'.$row['id_autora'].'"  data-status="ceka">';
                                 }
                                 else{
                                     echo '<tr>';
                                 }
                                 $sql22="SELECT * FROM uzivatele WHERE id='".$row['id_recenzenta']."'";
                                            $vys22=mysqli_query($pripojeni,$sql22);
                                            $row22=mysqli_fetch_assoc($vys22);
                                            
                                      
                                 echo' <td>'.++$i.'</td>
                                          <td>'.$row2['jmeno'].'</td>
                                      
                                        <td>'.$row['titulek'].'</td>
                                         <td>'.date('d.m.Y', $datu).'</td>
                                   
                                       ';
                                      
                                       
                                         echo '<td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';  
                                         
                                          
                                        
                                       
                                 
                                   echo' 
                                 
                                   
                                   </tr>
                                    ';
                                }
                                
                        echo    '</tbody>
                            
                            ';
                             

                              
                              
                      
                            echo '</table>
                        
                        
                                <table class="table" data-status="allrecenzent">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                           <th>Recenzent</th>
                                    
                                        <th>Titulek</th>
                                        <th>Autor</th>
                                        <th>Datum</th>
                                        <th>Od</th>
                                        <th>Do</th>
                                        <th> </th> 
                                        <th>Status</th>'
                                       ;
                                        
                                     
                                        
                                   echo '</tr>
                                </thead>';
                           
                          
                                $sql = "SELECT * FROM clankyprijmuti WHERE id_recenzenta > 0"; 
                                $vys=mysqli_query($pripojeni,$sql);
                                 
                                while($row=mysqli_fetch_assoc($vys)){
                                    $id_clanku=$row['id'];
                                       $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
                              echo '
                                <tbody>';
                                
                             
                                  if($row['status'] == 1 || $row['status'] == 11 || $row['status'] == 10){
                                     echo '<tr data-userid="'.$row['id_recenzenta'].'"  data-status="oka">';
                                 }
                                 else if($row['status'] == 0){
                                     echo '<tr data-userid="'.$row['id_recenzenta'].'"  data-status="noka">';
                                 }
                                
                                 else{
                                     echo '<tr>';
                                 }
                                 $sql22="SELECT * FROM uzivatele WHERE id='".$row['id_recenzenta']."'";
                                            $vys22=mysqli_query($pripojeni,$sql22);
                                            $row22=mysqli_fetch_assoc($vys22);
                                            
                                      
                                 echo' <td>'.++$i2.'</td>
                                      
                                       <td>'.$row22['jmeno'].'</td>
                                        <td>'.$row['titulek'].'</td>
                                        <td>'.$row2['jmeno'].'</td>
                                        <td>'.date('d.m.Y', $datu).'</td>';
                                      
                                        
                                            
                                          
                                            echo ' 
                                            
                                           
                                                 <td>'.date('d.m.Y', $od).'</td>
                                                <td>'.date('d.m.Y', $do).'</td>'; 
                                        
                                       
                                         echo '<td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';  
                                       
                                          if($row['status'] == 1 || $row['status'] == 11 || $row['status'] == 10 ){
                                              echo '  <td><label class="badge badge-success">Ohodnotil</label></td>'; 
                                          }
                                         else if($row['status'] == 0){
                                                 echo '  <td><label class="badge badge-danger">Neohodnotil</label></td>';  
                                          }
                                          
                                          
                                       
                                 
                                   echo' 
                                 
                                   
                                   </tr>
                                    ';
                                }
                                
                        echo    '</tbody>
                            
                            ';
                             

                              
                              
                      
                            echo '</table>
                                                                                   
                        
                        
                            <table class="table" data-status="allredaktor">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Redaktor</th>
                                        <th>Titulek</th>
                                        <th>Autor</th>
                                        <th>Datum</th>

                                     
                                        <th> </th> 
                                        <th>Status</th>'
                                       ;
                                        
                                     
                                        
                                   echo '</tr>
                                </thead>';
                           
                          
                                $sql = "SELECT * FROM clankyprijmuti WHERE id_redaktora > 0"; 
                                $vys=mysqli_query($pripojeni,$sql);
                                 
                                while($row=mysqli_fetch_assoc($vys)){
                                    $id_clanku=$row['id'];
                                       $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
                              echo '
                                <tbody>';
                                
                                if($row['status'] == 11){
                                    echo '<tr data-userid="'.$row['id_redaktora'].'"  data-status="oka">';
                                 }
                                 else if($row['status'] == 10)
                                 {
                                     echo '<tr data-userid="'.$row['id_redaktora'].'"  data-status="noka">';
                                 }
                                 else if($row['status'] == 1 || $row['status'] == 0){
                                     echo '<tr data-userid="'.$row['id_redaktora'].'"  data-status="ceka">';
                                 }
                                
                                 else{
                                     echo '<tr>';
                                 }
                                      $sql3="SELECT * FROM uzivatele WHERE id='".$row['id_redaktora']."'";
                                            $vys3=mysqli_query($pripojeni,$sql3);
                                            $row3=mysqli_fetch_assoc($vys3);
                                 echo' <td>'.++$i3.'</td>
                                       <td>'.$row3['jmeno'].'</td>
                                        <td>'.$row['titulek'].'</td>
                                        <td>'.$row2['jmeno'].'</td>
                                        <td>'.date('d.m.Y', $datu).'</td>';
                                       
                                        
                                            
                                         
                                      
                                       
                                         echo '<td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';  
                                          if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0)
                                         {
                                            
                                            
                                                 echo '  <td><label class="badge badge-warning">Čeká na ohodnocení</label></td>'; 
                                            
                                            
                                          }
                                          else if($row['status'] == 1){
                                              echo '  <td><label class="badge badge-warning">Čeká na schválení</label></td>'; 
                                          }
                                         else if($row['status'] == 0){
                                                 echo '  <td><label class="badge badge-danger">Neohodnocen</label></td>';  
                                          }
                                          else if($row['status'] == 11){
                                              echo '  <td><label class="badge badge-success">Schválil</label></td>';   
                                          }
                                          else if($row['status'] == 10){
                                               echo '  <td><label class="badge badge-danger">Zamítl</label></td>';  
                                          }
                                          
                                          
                                       
                                 
                                   echo' 
                                 
                                   
                                   </tr>
                                    ';
                                }
                                
                        echo    '</tbody>
                            
                            ';
                             

                              
                              
                      
                            echo '</table>';
                                                              



echo    '                    </div>
                    </div>
                </div>
            </div>
        </div>
';

     
         
   
}
?>    


<script>
$(document).ready(function () {
 $('table[data-status="allrecenzent"]').css('display', 'none'); 
 $('table[data-status="allredaktor"]').css('display', 'none'); 
 $('table[data-status="allautor"]').css('display', 'none'); 
      $('.btn-filter').css('display', 'none'); 
$('#vyber').on('change', function () {
         var $target = $(this).val();

         var selected = $("option:selected", this);
        if(selected.parent()[0].id == "autor"){
               $('.btn-filter').css('display', 'none'); 
                 if($target == 'allautor'){
                        $('table[data-status="allrecenzent"]').css('display', 'none'); 
                         $('table[data-status="allredaktor"]').css('display', 'none'); 
                        $('table[data-status="allautor"]').css('display', 'table'); 
                        $('tbody tr').css('display', 'contents'); 
                    } 
                    else{
                         $('table').css('display', 'none');
                       $('table[data-status="allautor"]').css('display', 'table');
                        $('tbody tr').css('display', 'none');
                        $('tbody tr[data-userid="' + $target + '"]').css('display', 'contents'); 
    
                    }
                  
        } 
        else if(selected.parent()[0].id == "redaktor"){
              
              

                   
              $('#rbtn .btn-filter').css('display', 'table'); 
              $('#rbtn2 .btn-filter').css('display', 'none'); 
                    if($target == 'allredaktor'){
                         $('table[data-status="allautor"]').css('display', 'none');
                        $('table[data-status="allrecenzent"]').css('display', 'none'); 
                        $('table[data-status="allredaktor"]').css('display', 'table'); 
                        $('tbody tr').css('display', 'contents'); 
                           $('.btn-filter').on('click', function () {
                                var $target2 = $(this).data('target');
                                   if ($target2 != 'all') {
                                          $('tbody tr').css('display', 'none');
                                        $('tbody tr[data-status="' + $target2 + '"]').css('display', 'contents'); 
                                   }
                                   else{
                                        $('tbody tr').css('display', 'contents'); 
                                   }
                             
                          });
    
                    } 
                    else{
                         $('table').css('display', 'none');
                       $('table[data-status="allredaktor"]').css('display', 'table');
                        $('tbody tr').css('display', 'none');
                        $('tbody tr[data-userid="' + $target + '"]').css('display', 'contents'); 
                          $('.btn-filter').on('click', function () {
                                var $target2 = $(this).data('target');
                                 if ($target2 != 'all') {
                                  $('tbody tr').css('display', 'none');
                                     $('tbody tr[data-userid="' + $target + '"][data-status="' + $target2 + '"]').css('display', 'contents'); 
                                     
                                 }else{
                                     $('tbody tr').css('display', 'none');
                                      $('tbody tr[data-userid="' + $target + '"]').css('display', 'contents'); 
                                 }
                               
                          });
    
                    }
                
        }
        else if(selected.parent()[0].id == "recenzent"){
             
              $('#rbtn .btn-filter').css('display', 'none'); 
              $('#rbtn2 .btn-filter').css('display', 'table'); 
              
                 if($target == 'allrecenzent'){
                       
                   
                        $('table[data-status="allautor"]').css('display', 'none');
                        $('table[data-status="allredaktor"]').css('display', 'none');
                        $('table[data-status="allrecenzent"]').css('display', 'table'); 
                        $('tbody tr').css('display', 'contents'); 
                         $('.btn-filter').on('click', function () {
                                var $target2 = $(this).data('target');
                                if ($target2 != 'all') {
                                        $('tbody tr').css('display', 'none');
                                        $('tbody tr[data-status="' + $target2 + '"]').css('display', 'contents');    
                                    
                                }
                                else{
                                      $('tbody tr').css('display', 'contents'); 
                                }
                                   
                             
                         });
                    } 
                    else{
                    
                         $('table').css('display', 'none');
                       $('table[data-status="allrecenzent"]').css('display', 'table');
                        $('tbody tr').css('display', 'none');
                        $('tbody tr[data-userid="' + $target + '"]').css('display', 'contents'); 
                         $('.btn-filter').on('click', function () {
                                var $target2 = $(this).data('target');
                                  if ($target2 != 'all') {
                                      $('tbody tr').css('display', 'none');
                                      $('tbody tr[data-userid="' + $target + '"][data-status="' + $target2 + '"]').css('display', 'contents');  
                                  }
                                  else{
                                       $('tbody tr').css('display', 'none');
                                      $('tbody tr[data-userid="' + $target + '"]').css('display', 'contents'); 
                                  }
                               
                          });
    
                    }
        }
        else{
            $('table[data-status="allautor"]').css('display', 'none');
            $('table[data-status="allredaktor"]').css('display', 'none');
            $('table[data-status="allrecenzent"]').css('display', 'none');
        }
    
    });
    
 });
</script>
<?php    
}





if( $_SESSION['stavRedaktor'] == 1){
    
    	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	


if($celaURL != "http://logospolytechnos.mzf.cz/pages/odeslaneClanky.php"){
    $idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci
	$sqli = "SELECT * FROM clankyprijmuti WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
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
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>'.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
                                        	if($row['fotka'] > 0)
											{
											
                                        $filename="../photos/clanek".$row['fotka']."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);  
                    				echo '<img src="../photos/clanek'.$row['fotka'].'.'.$fileext[3].'" style="width:100%;"  alt="Uvodni fotografie clanku">';

											}
											else{
											echo '<img src="../photos/default.jpg" style="width:100%;"  alt="Uvodni fotografie clanku">';
  
											}
														echo '<p class="text-muted ">'.$row['popisUvod'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['text'].'</p>
													</div>';
										echo  '</div>
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
										
													';
												
												
													 if($_SESSION['idUzivatele']){
													$osql="SELECT * FROM clankyprijmuti WHERE id='$idClanku'";
													$ovys=mysqli_query($pripojeni,$osql);
													$orow=mysqli_fetch_assoc($ovys);
													$idos=$orow['id_recenzenta'];
													$status=$orow['status'];
            	                                        if($status == 0 && $idos == $_SESSION['idUzivatele']){
													    echo '<a href="" data-toggle="modal" data-target="#form" class="list-group-item list-group-item-danger">Ohodnotit článek</a>';
													}
													else if ($status == 1 && $_SESSION['idUzivatele']){

													    echo '<a href="" data-toggle="modal" data-target="#form2" class="list-group-item list-group-item-success">Hodnocení</a>';
													}
													
                                                    }
												
											echo '		
												
			<form method="POST" action="../scripts/ohodnoceni.php">
			<input type="hidden" name="idClanku" value="'.$idClanku.'">
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Hodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>
                    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating2" value="5" id="55"><label for="55">☆</label> <input type="radio" name="rating2" value="4" id="44"><label for="44">☆</label> <input type="radio" name="rating2" value="3" id="33"><label for="33">☆</label> <input type="radio" name="rating2" value="2" id="22"><label for="22">☆</label> <input type="radio" name="rating2" value="1" id="11"><label for="11">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating3" value="5" id="555"><label for="555">☆</label> <input type="radio" name="rating3" value="4" id="444"><label for="444">☆</label> <input type="radio" name="rating3" value="3" id="333"><label for="333">☆</label> <input type="radio" name="rating3" value="2" id="222"><label for="222">☆</label> <input type="radio" name="rating3" value="1" id="111"><label for="111">☆</label> </div>
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>
                    <div class="rating"> <input type="radio" name="rating4" value="5" id="5555"><label for="5555">☆</label> <input type="radio" name="rating4" value="4" id="4444"><label for="4444">☆</label> <input type="radio" name="rating4" value="3" id="3333"><label for="3333">☆</label> <input type="radio" name="rating4" value="2" id="2222"><label for="2222">☆</label> <input type="radio" name="rating4" value="1" id="1111"><label for="1111">☆</label> </div>
                    
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4"></textarea> </div>
                 
                </div>
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="ohodnot">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">';
       
                   $hsql="SELECT * FROM hodnoceni WHERE id_clanku='$idClanku'";
					$hvys=mysqli_query($pripojeni,$hsql);
					$hpol=mysqli_fetch_assoc($hvys);
      echo '
       <div class="modal-header border-none">   <h5 class="modal-title" id="exampleModalLabel">Hodnocení ('.date('d.m.Y', strtotime($hpol['datum_rec'])).')</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                   
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>';
         
                    if($hpol['originalita'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['originalita'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['originalita'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['originalita'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['originalita'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                     echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>';
                       if($hpol['odbornost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['odbornost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['odbornost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['odbornost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['odbornost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>';
                     if($hpol['jazyk'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['jazyk'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['jazyk'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['jazyk'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['jazyk'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>';
                       if($hpol['aktualnost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['aktualnost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['aktualnost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['aktualnost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['aktualnost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                     <div class="comment-box text-center">
                    <h4><small>Názor</small></h4>
                     </div>
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4" disabled>'.$hpol['nazor'].'</textarea> </div>
                   
                </div>
                  <div class="modal-footer">
                 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>







												</div>
											</div>
										</div>
									</div>
								
						</div>

						</div>
				</div>';
		  }
		}
	
    
    
}
else{
        $idPom=$_SESSION['idUzivatele'];
   
    $ted = date("Y-m-d");
   
      $sql = "SELECT * FROM clankyprijmuti"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
       $vys = mysqli_query($pripojeni,$sql);
    echo'
 
        <div class="justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Výpis nově odeslaných příspěvků čekajících na schválení</h4>
                        
						
				<div class="btn-group" style="margin-bottom:20px">
				    <button  type="button" class="btn btn-success btn-circle btn-filter" data-target="oka"><i class="fas fa-check"></i></button>
                    <button  type="button" class="btn btn-danger btn-circle btn-filter" data-target="noka"><i class="fas fa-times"></i></button>
                    <button  type="button" class="btn btn-primary btn-circle btn-filter" data-target="ohod"><i class="fas fa-thumbs-up"></i></button>
                    <button  type="button" class="btn btn-warning btn-circle btn-filter" data-target="ceka"><i style="color:white" class="fas fa-clock"></i></button>
                    <button  type="button" class="btn btn-dark btn-circle btn-filter" data-target="all"><i style="color:white" class="fas fa-layer-group"></i></button>
				</div>
							
							
                        <div class="col-12 container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titulek</th>
                                        <th>Autor</th>
                                        <th>Datum</th>
                                        <th>Recenzent</th>
                                        <th>Od</th>
                                        <th>Do</th>
                                        <th> </th> 
                                        <th>Status</th>
                                        <th>Akce</th>
                                          <th></th>
                                            <th></th>
                                         
                                     '
                                       ;
                                       
                                     
                                        
                                   echo '</tr>
                                </thead>';
                           
                           
                             

                                    while($row = mysqli_fetch_assoc($vys)){
                              $id_clanku=$row['id'];
                            $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
 
                                     echo '<tbody>';
                                 if($row['status'] == 11){
                                     echo '<tr data-status="oka">';
                                 }
                                 else if($row['status'] == 10)
                                 {
                                     echo '<tr data-status="noka">';
                                 }
                                 else if($row['status'] == 1){
                                     echo '<tr data-status="ohod">';
                                 }
                                 else if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0 || $row['id_recenzenta'] == 0){
                                     echo '<tr data-status="ceka">';
                                 }
                                 else{
                                       echo '<tr>';
                                 }
                                 
                                   
                                 echo' <td>'.++$i.'</td>
                                        <td>'.$row['titulek'].'</td>
                                        <td>'.$row2['jmeno'].'</td>
                                        <td>'.date('d.m.Y', $datu).'</td>';
                                        if($row['do'] == '0000-00-00' && $row['od'] == '0000-00-00' && $row['id_recenzenta'] == 0){
                                           echo ' <td>-</td>
                                                <td>-</td>
                                                <td>-</td>'; 
                                        }
                                        else{
                                            $sql2="SELECT * FROM uzivatele WHERE id='".$row['id_recenzenta']."'";
                                            $vys2=mysqli_query($pripojeni,$sql2);
                                            $row2=mysqli_fetch_assoc($vys2);
                                            echo ' <td>'.$row2['jmeno'].'</td>
                                                 <td>'.date('d.m.Y', $od).'</td>
                                                <td>'.date('d.m.Y', $do).'</td>'; 
                                        }
                                       
                                         echo '<td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';  
                                          if($row['do'] != '0000-00-00' && $row['od'] != '0000-00-00' && $row['id_recenzenta'] != 0 && $row['status'] == 0)
                                         {
                                            
                                             if($ted > $row['do']){
                                                 echo '  <td><label class="badge badge-danger">Čeká na ohodnocení</label></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 ';
                                                 
                                             }
                                             else{
                                                 echo '  <td><label class="badge badge-warning">Čeká na ohodnocení</label></td>
                                                 <td></td>
                                                 <td></td>
                                                 <td></td>
                                                 '; 
                                             }
                                               
                                            
                                          }
                                          else if($row['status'] == 1){
                                              echo '  <td><label class="badge badge-success">Ohodnocen</label></td>'; 
                                              echo '<td><a href="" data-toggle="modal" data-target="#schvalen'.$id_clanku.'" class="btn btn-success btn-circle"><i class="fas fa-check"></i></a></td>';
                                              echo '<td><a href="" data-toggle="modal" data-target="#zamitnut'.$id_clanku.'" class="btn btn-danger btn-circle"><i class="fas fa-times"></i></a></td>';
                                         echo '<td><a href="editor.php?id='.$id_clanku.'" class="btn btn-warning btn-circle"><i style="color:white" class="fas fa-pen"></i></a></td>';
                                          }
                                         else if($row['status'] == 0){
                                                 echo '  <td><label class="badge badge-danger">Neohodnocen</label></td>';  
                                  
                                          }
                                          else if($row['status'] == 11){
                                              echo '  <td><label class="badge badge-success">Schválen</label></td>';
                                              
                                          }
                                          else if($row['status'] == 10){
                                               echo '  <td><label class="badge badge-danger">Zamítnut</label></td>';  
                                          }
                                          
                                          if($row['id_recenzenta'] == 0){
                                           echo '<td><a href="" data-toggle="modal" data-target="#addrecenzent'.$id_clanku.'"  class="btn btn-info btn-circle"><i class="fas fa-plus"></i></a>
                                           </td>
                                             <td></td>
                                                 <td></td>
                                               
                                           
                                           ';
                                              
                                          }
                                       
                                      
                                  echo ' </tr>';
                                  
                                  
                    if($row['status'] == 1){
                          echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="schvalen'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Opravdu chcete schválit příspěvek?</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                  
';

    
   echo ' 
                  <div class="modal-footer">
                  <button class="btn btn-success send" name="schvaleni">Schválit<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
         ';
         
                          echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="zamitnut'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Opravdu chcete zamítnout příspěvek?</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                  
';

    
   echo ' 
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="zamitnuti">Zamítnout<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
         ';         
                 }
              
                 
                                            
                                        
           echo '<form method="POST" action="../scripts/add.php">
			<input type="hidden" name="idClanku" value="'.$id_clanku.'">
			 <input type="hidden" value="'.$_SESSION['idUzivatele'].'" name="idRedaktora">
<div class="modal fade" id="addrecenzent'.$id_clanku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Předat recenzentovi k ohodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>

              <div class="comment-box text-center">
              
                    <h4><small>Recenzent</small></h4>
<select style="width:90%" class="custom-select" class="form-control" name="addrecenzent">';

$sqll="SELECT * FROM uzivatele WHERE recenzent='1'";
$vyss=mysqli_query($pripojeni,$sqll);
while($polee=mysqli_fetch_assoc($vyss)){
        echo '<option value="'.$polee['id'].'">'.$polee['jmeno'].'</option>';
    }
    
   echo ' </select>
 
              </div>
          <div class="comment-box text-center">
                    <h4><small>Termín</small></h4>
                <input style="width:90%" class="form-control" type="date" name="adddo">
               </div>
               
                  <div class="modal-footer">
                  <button class="btn btn-success send" name="addrec">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>    
                                            
                                            
                                
                                
                              </tbody>  ';
                               
                                    
                                }
                         
                          
                                 
                              
                      
                            echo '</table>
                                                              



                        </div>
                    </div>
                </div>
            </div>
        </div>
';

     
         
   
}
    
    ?>
    
<script>
$(document).ready(function () {


    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
           $('tbody tr').css('display', 'none');
        $('tbody tr[data-status="' + $target + '"]').css('display', 'contents');
    
      }
      else {
        $('tbody tr').css('display', 'contents');
      }
    });

 });
</script>
    <?php
    
    
    
}



if($_SESSION['stavRecenzant'] == 1){
    	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	


if($celaURL != "http://logospolytechnos.mzf.cz/pages/odeslaneClanky.php"){
    $idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci
	$sqli = "SELECT * FROM clankyprijmuti WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
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
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>'.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
                                        	if($row['fotka'] > 0)
											{
											
                                        $filename="../photos/clanek".$row['fotka']."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);  
                    				echo '<img src="../photos/clanek'.$row['fotka'].'.'.$fileext[3].'" style="width:100%;"  alt="Uvodni fotografie clanku">';

											}
											else{
											echo '<img src="../photos/default.jpg" style="width:100%;"  alt="Uvodni fotografie clanku">';
  
											}
														echo '<p class="text-muted ">'.$row['popisUvod'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['text'].'</p>
													</div>';
										echo  '</div>
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
													';
												
												
													 if($_SESSION['idUzivatele']){
													$osql="SELECT * FROM clankyprijmuti WHERE id='$idClanku'";
													$ovys=mysqli_query($pripojeni,$osql);
													$orow=mysqli_fetch_assoc($ovys);
													$idos=$orow['id_recenzenta'];
													$status=$orow['status'];
            	                                        if($status == 0 && $idos == $_SESSION['idUzivatele']){
													    echo '<a href="" data-toggle="modal" data-target="#form" class="list-group-item list-group-item-danger">Ohodnotit článek</a>';
													}
													else if ($status == 1 && $idos == $_SESSION['idUzivatele']){

													    echo '<a href="" data-toggle="modal" data-target="#form2" class="list-group-item list-group-item-success">Hodnocení</a>';
													}
													
                                                    }
												
											echo '		
												
			<form method="POST" action="../scripts/ohodnoceni.php">
			<input type="hidden" name="idClanku" value="'.$idClanku.'">
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
       <div class="modal-header border-none"> <h5 class="modal-title" id="exampleModalLabel">Hodnocení</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>
                    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating2" value="5" id="55"><label for="55">☆</label> <input type="radio" name="rating2" value="4" id="44"><label for="44">☆</label> <input type="radio" name="rating2" value="3" id="33"><label for="33">☆</label> <input type="radio" name="rating2" value="2" id="22"><label for="22">☆</label> <input type="radio" name="rating2" value="1" id="11"><label for="11">☆</label> </div>
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>
                    <div class="rating"> <input type="radio" name="rating3" value="5" id="555"><label for="555">☆</label> <input type="radio" name="rating3" value="4" id="444"><label for="444">☆</label> <input type="radio" name="rating3" value="3" id="333"><label for="333">☆</label> <input type="radio" name="rating3" value="2" id="222"><label for="222">☆</label> <input type="radio" name="rating3" value="1" id="111"><label for="111">☆</label> </div>
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>
                    <div class="rating"> <input type="radio" name="rating4" value="5" id="5555"><label for="5555">☆</label> <input type="radio" name="rating4" value="4" id="4444"><label for="4444">☆</label> <input type="radio" name="rating4" value="3" id="3333"><label for="3333">☆</label> <input type="radio" name="rating4" value="2" id="2222"><label for="2222">☆</label> <input type="radio" name="rating4" value="1" id="1111"><label for="1111">☆</label> </div>
                    
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4"></textarea> </div>
                 
                </div>
                  <div class="modal-footer">
                  <button class="btn btn-danger send" name="ohodnot">Odeslat<i class="fa fa-long-arrow-right ml-1"></i></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal fade" id="form2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">';
       
                   $hsql="SELECT * FROM hodnoceni WHERE id_clanku='$idClanku'";
					$hvys=mysqli_query($pripojeni,$hsql);
					$hpol=mysqli_fetch_assoc($hvys);
      echo '
       <div class="modal-header border-none">   <h5 class="modal-title" id="exampleModalLabel">Hodnocení ('.date('d.m.Y', strtotime($hpol['datum_rec'])).')</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                   
                    <div class="comment-box text-center">
                    <h4><small>Originalita</small></h4>';
         
                    if($hpol['originalita'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['originalita'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['originalita'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['originalita'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['originalita'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                     echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Odborná úroveň</small></h4>';
                       if($hpol['odbornost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['odbornost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['odbornost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['odbornost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['odbornost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                  <div class="comment-box text-center">
                    <h4><small>Jazyková, stylistická úroveň</small></h4>';
                     if($hpol['jazyk'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['jazyk'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['jazyk'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['jazyk'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['jazyk'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                </div>
                <div class="comment-box text-center">
                    <h4><small>Aktuálnost, zajímavost, přínosnost</small></h4>';
                       if($hpol['aktualnost'] == 1){
echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }else if($hpol['aktualnost'] == 2){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" ><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                         
                    }
                    else if($hpol['aktualnost'] == 3){
  echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';                       
                    }
                    else if($hpol['aktualnost'] == 4){
                     echo' 
                    <div class="rating"> <input type="radio"><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> <input type="radio" checked><label>☆</label> </div> 
                    ';
                    }
                    else if($hpol['aktualnost'] == 5){
                    echo'
                    <div class="rating"> <input type="radio" checked><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> <input type="radio"><label>☆</label> </div>                    
                    
                    ';
                    
                       
                    }
                    echo '
                     <div class="comment-box text-center">
                    <h4><small>Názor</small></h4>
                     </div>
                    <div class="comment-area"> <textarea name="nazor" class="form-control" placeholder="Jaký je tvůj názor?" rows="4" disabled>'.$hpol['nazor'].'</textarea> </div>
                   
                </div>
                  <div class="modal-footer">
                 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
             
                </div>
            </div>
        </div>
    </div>
</div>







												</div>
											</div>
										</div>
									</div>
								
						</div>

						</div>
				</div>';
		  }
		}
	
    
    
}
else{
        $idPom=$_SESSION['idUzivatele'];
   
    $ted = date("Y-m-d");
   
      $sql = "SELECT * FROM clankyprijmuti WHERE id_recenzenta='$idPom' AND status='0' AND do < '$ted'"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
       $vys = mysqli_query($pripojeni,$sql);
    echo'
 
        <div class="justify-content-center">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Výpis nově odeslaných příspěvků čekajících na ohodnocení</h4>';
                        
                if(mysqli_num_rows($vys) <= 0){

                     echo'<div class="btn-group" style="margin-bottom:20px">
                    <button  type="button" class="btn btn-primary btn-circle btn-filter" data-target="ohod"><i class="fas fa-thumbs-up"></i></button>
                    <button  type="button" class="btn btn-warning btn-circle btn-filter" data-target="ceka"><i style="color:white" class="fas fa-clock"></i></button>
                    <button  type="button" class="btn btn-dark btn-circle btn-filter" data-target="all"><i style="color:white" class="fas fa-layer-group"></i></button>
				</div>'; 
                }  
           
                        
                        
  echo      '<div class="col-12 container">
  
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titulek</th>
                                        <th>Autor</th>
                                        <th>Datum</th>
                                        <th>Od</th>
                                         <th>Do</th>
                                         <th> </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>';
                           
                           
                                if(mysqli_num_rows($vys) > 0){
echo'  <div class="alert bg-danger mb-5 py-4" role="alert">
        <div class="d-flex"> 
            <div class="px-3">
               <i style="font-size:25px" class="far fa-angry"></i> 
               <h4 class="alert-heading">Nebyl ohodnocen článek do stanoveného termínu!</h4>

                    
            </div>
        </div>
    </div>
</div>';
                                    while($row = mysqli_fetch_assoc($vys)){
                                      if($ted > $row['do']){
                                         
                                          $id_clanku=$row['id'];
                                $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
               
                                
                            echo '  <tbody>

                                        <tr>
                                         <td>'.++$i.'</td>
                                        <td>'.$row['titulek'].'</td>
                                        <td>'.$row2['jmeno'].'</td>
                                        <td>'.date('d.m.Y', $datu).'</td>
                                        <td>'.date('d.m.Y', $od).'</td>
                                        <td>'.date('d.m.Y', $do).'</td>
                                          <td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';
                                          if($row['status'] == 0){
                                            echo '  <td><label class="badge badge-danger">Neohodnocen</label></td>';  
                                          }
                                       
                                      
                                  echo ' </tr>
                                    
                                </tbody>';
                                         }
                                         
             

                                }
                            }
                            else {
                            $sql = "SELECT * FROM clankyprijmuti WHERE id_recenzenta='$idPom'"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
                            $vys = mysqli_query($pripojeni,$sql);
                             while($row = mysqli_fetch_assoc($vys)){
                                      
                                         
                              $id_clanku=$row['id'];
                            $id_autora=$row['id_autora'];           
                             $od=strtotime($row['od']);
                            $do=strtotime($row['do']);
                            $datu = strtotime($row['datum']);
                            $sqla = "SELECT jmeno FROM uzivatele WHERE id='$id_autora'";
                            $jmeno = mysqli_query($pripojeni,$sqla);
                            $row2 = mysqli_fetch_assoc($jmeno);
               
                                
                            echo '  <tbody>';
                                      if($row['status'] == 1){
                                     echo '<tr data-status="ohod">';

                                    }
                                    else if($row['status'] == 0){
                                   echo '<tr data-status="ceka">';
     
                                    }
                                    else {
                                        echo ' <tr>';
                                    }
                                
                                     echo '<td>'.++$i.'</td>
                                        <td>'.$row['titulek'].'</td>
                                        <td>'.$row2['jmeno'].'</td>
                                        <td>'.date('d.m.Y', $datu).'</td>
                                        <td>'.date('d.m.Y', $od).'</td>
                                        <td>'.date('d.m.Y', $do).'</td>
                                          <td><a href="odeslaneClanky.php?clanek'.$id_clanku.'">Zobrazit článek</a></td>';
                                          if($row['status'] == 0){
                                            echo '  <td><label class="badge badge-danger">Neohodnocen</label></td>';  
                                          }
                                        else if($row['status'] == 1){
                                            echo '  <td><label class="badge badge-success">Ohodnocen</label></td>';  
                                          }
                                      
                                  echo ' </tr>
                                    
                                </tbody>';
                                         
             

                                } 
                            }
                                 
                              
                      
                            echo '</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
';

           

    
   
}
    ?>
    
<script>
$(document).ready(function () {


    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
           $('tbody tr').css('display', 'none');
        $('tbody tr[data-status="' + $target + '"]').css('display', 'contents');
    
      }
      else {
        $('tbody tr').css('display', 'contents');
      }
    });

 });
</script>
    <?php

}



	

   
 
?>


</body>
</html>
