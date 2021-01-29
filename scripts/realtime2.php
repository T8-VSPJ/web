<?php
session_start();
		include_once 'dtb.php';
	 $idk=$_POST['s'];
	 
	         $sql="SELECT * FROM uzivatele";
	          $vys=mysqli_query($pripojeni,$sql);

	          while($row=mysqli_fetch_assoc($vys)){
	              	if($_SESSION['idUzivatele'] != $row['id']){
	              	   
	              	  echo'
	      
	       <a href="zpravy.php?uzivatel='.$row['id'].'">
		<div class="chat_list" style="'; if($idk == $row['id']){echo 'background:#ff00001c;';} echo '">
		  <div class="chat_people">';
	              	      if($row['profilova_fotografie'] == 1){
		         $filename="../profilovky/profile".$row['id']."*";
        $fileinfo=glob($filename);
		$fileext=explode(".",$fileinfo[0]); 
	   $cas=strtotime(date("Y-m-d H:i:s"). '-1 minute');
		$cas2=date("Y-m-d H:i:s", $cas);

		echo '	<div class="chat_img">';
		
	
		          if($row['last_activity'] > $cas2){
		              echo '<img style="border: 3px solid #00c62d;" src="../profilovky/profile'.$row['id'].'.'.$fileext[3].'" alt="sunil"> </div>';
		          }
		            else{
		              echo '<img style="border: 3px solid red;" src="../profilovky/profile'.$row['id'].'.'.$fileext[3].'" alt="sunil"> </div>';
		          }
		       
		    
		
	 

		    }
		    else{
		        echo '<div class="chat_img">';
		        
		      if($row['last_activity'] > $cas2){
		             		      echo ' <img style="border: 3px solid #00c62d;" src="../profilovky/default.jpg" alt="sunil"> </div>';

		          }
		          else{
		                		      echo ' <img style="border: 3px solid red;" src="../profilovky/default.jpg" alt="sunil"> </div>';

		          }
		        

		    }
		    echo '<div class="chat_ib">
			  <h5><strong>'.$row['jmeno'].'</strong></h5>
			  <p>';
			  if($row['admin'] == 1){
			      echo '<strong>Admin</strong>';
			  }
			  else if($row['redaktor'] == 1){
			       echo '<strong>Redaktor</strong>';
			  }
			  else if($row['recenzent'] == 1){
			       echo '<strong>Recenzent</strong>';
			  }
			  else if($row['sefredaktor'] == 1)
			  {
			       echo '<strong>Šéfredaktor</strong>';
			  }
			  else{
			      echo '<strong>Bez role</strong>'; 
			  }
			  echo '</p>
			</div>
		  </div>
	
		</div>
	   	   </a>
	      
	      
	      
	       ';
	              	}
	          }
	     

            echo $output;
        ?>