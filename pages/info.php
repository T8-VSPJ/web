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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="shortcut icon" href="../photos/favicon.ico" type="image/x-icon">
<link rel="icon" href="../photos/favicon.ico" type="image/x-icon">
</head>
<body>
  <?php
    include "menu.php";
  ?>
  <div class="container">
    <div class="row" style="text-align:center;">
      <h1 class="uvodVety">Informace o Logos Polytechnikos</h1>
    </div>
	<div class="row" style="text-align:center;">
      <p>Tato stránka slouží k propagaci novinových článků vytvořených a sepsaných teamem Logos Polytechnikos. Propagace článků u nás prochází přes několik lidí a tudíž se zaručuje vysoká kvalita všech článků.</p>
    </div>
    <br><br>
    <div class="row" style="text-align:center;">
      <h2 class="uvodVety">Jak se připojit do teamu Logos Polytechnikos?</h2>
      <p>V případě, že by jste měli zájem stát se členem teamu je postup opravdu jednoduchý. Pomocí soukromých zpráv, které poskytuje náš web máte možnost kontaktovat šéfredaktory, kteří následně projednají veškeré žádosti. Do zprávy je třeba vypsat menší životopis a popsat vaše zkušenosti a případně i vaše schopnosti, kterými by jste mohli náš team obohatit. V případě, že se vám nepodaří team kontaktovat je možnost zaslat žádost na emailovou adresu : kuceral.99@spst.eu</p>
    </div>
</body>
</html>
