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
<script>
                  tinymce.init({
                    selector: "textarea",
                    height: 530,
                    plugins: "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    toolbar_mode: "floating",
                  });
                  

</script>

</head>
<body>

  
  <?php
  include "menu.php";
  
  if(isset($_GET["id"]) && $_SESSION['stavRedaktor'] == 1){
     $id= $_GET["id"];
     $sql="SELECT * FROM clankyprijmuti WHERE id='$id'";
     $vys=mysqli_query($pripojeni,$sql);
     $row=mysqli_fetch_assoc($vys);

                    					
     echo '
	<div class="container">
	<div class="row justify-content-center">
	<div class="bg-white" style="width:100%">
    <h4 class="border-bottom py-2 pl-2">Upravit článek</h4>
    <div class="py-2 align-items-start pl-2">

 <div class="pl-sm-4 pl-2" style="float: left;" id="img-section"> <strong>Úvodní fotografie</strong>
            <p>Přijatelný typ souboru .png .jpg .jpeg.<br>Menší než 1MB</p>';
 
   echo '<form method="post" action="../scripts/pridatClanek.php" enctype="multipart/form-data">
			<input id="inpFile" type="file" name="foto">';
								


           echo ' 
        </div>
        <div id="predtim">';
           if($row['fotka'] > 0)
			{
											
              $filename="../photos/clanek".$row['fotka']."*";
                    					$fileinfo=glob($filename);
                    					$fileext=explode(".",$fileinfo[0]);  
            echo '<img src="../photos/clanek'.$row['fotka'].'.'.$fileext[3].'" style="width:190px;height: 140px;float:right"  alt="Uvodni fotografie clanku">';

	    }
	        else{
				echo '<img src="../photos/default.jpg" style="width:190px;height: 140px;float:right" alt="Uvodni fotografie clanku">';
  
		}
        echo '</div>
      <div id="imagePreview" class="image-preview">';
      
      
      	echo '<img src="" class="image-preview__image"><span class="image-preview__default-text">Image Preview</span>
		</div>
        ';
        
          
		echo '

    </div>
    
    <div class="py-2" style="clear:both">
      
            <div class="col-md-12"> <label><strong>Titulek</strong></label> <input value="'.$row['titulek'].'" type="text" name="titulek" class="bg-light form-control"> </div>
       
       
           <div class="col-md-12 py-2"> <label ><strong>Článek</strong></label> 
           <input type="hidden" name="id" value="'.$id.'">
          <textarea name="content">'.$row['text'].'</textarea>
           </div>
       
  
        <div class="py-3 pb-4 pl-3 pr-3"> <button type="submit" style="width:100%" name="uclanek" class="btn btn-success mr-3"><strong>Uložit a schválit</strong></button> </div>

    </div>
    </form>
</div>
</div>
</div>
	';
     
  }
  else if ($_SESSION['stavAutor'] == 1){
        echo '
	<div class="container">
	<div class="row justify-content-center">
	<div class="bg-white" style="width:100%">
    <h4 class="border-bottom py-2 pl-2">Přidat článek</h4>
    <div class="py-2 align-items-start pl-2">';


    echo ' <div class="pl-sm-4 pl-2" style="float: left;" id="img-section"> <strong>Úvodní fotografie</strong>
            <p>Přijatelný typ souboru .png .jpg .jpeg.<br>Menší než 1MB</p>
   <form method="post" action="../scripts/pridatClanek.php" enctype="multipart/form-data">
			<input id="inpFile" type="file" name="foto">
								


        
        </div>
                    <div id="imagePreview" class="image-preview">
      
      
      	        <img src="" class="image-preview__image"><span class="image-preview__default-text">Image Preview</span>
		        </div>
      
            
     </div>
  
    
    <div class="py-2" style="clear:both">
      
            <div class="col-md-12"> <label><strong>Titulek</strong></label> <input type="text" name="titulek" class="bg-light form-control"> </div>
       
       
           <div class="col-md-12 py-2"> <label ><strong>Článek</strong></label> 
          <textarea name="content"> </textarea>
           </div>
       
  
        <div class="py-3 pb-4 pl-3 pr-3"> <button type="submit" style="width:100%" name="addclanek" class="btn btn-success mr-3"><strong>Poslat článek ke schválení</strong></button> </div>

    </div>
    </form>
</div>
</div>
</div>
	';
  
      
  }
  

  
  
  
  
  
  
  
  
  
  
  

  ?>
  <script>
         const inpFile=document.getElementById("inpFile");
       const previewContainer=document.getElementById("imagePreview");
       const previewImage=previewContainer.querySelector(".image-preview__image");
         const previewDefaultText=previewContainer.querySelector(".image-preview__default-text");
         
       
       inpFile.addEventListener("change", function(){
           const file = this.files[0];
      
         if(file){
        
            var filePath = inpFile.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
             
             if (allowedExtensions.exec(filePath)) {
            const reader=new FileReader();
          
             $('#predtim').css('display', 'none');
             $('.image-preview').css('display', 'block');
             
             previewDefaultText.style.display="none";
             previewImage.style.display="flex";
             
             reader.addEventListener("load", function(){
            
                 previewImage.setAttribute("src", this.result);
                 
             });
             reader.readAsDataURL(file);
  	
            }
            else{
               alert("Špatný formát souboru!"); 
               inpFile.value = '';
            }
            
         }
       });
  </script>
</body>
</html>
