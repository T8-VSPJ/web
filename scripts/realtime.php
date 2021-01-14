<?php

		include_once 'dtb.php';
$fromUser=$_POST['tu'];
$toUser=$_POST['fu'];
$output="";

    $chats=mysqli_query($pripojeni,"SELECT * FROM messages WHERE 
        (FromUser = '$fromUser' AND ToUser = '$toUser') OR
        
    (FromUser = '$toUser' AND ToUser='$fromUser')
        
       ORDER BY `id` ASC ");
        
          while($chat=mysqli_fetch_assoc($chats)){
                    if($chat['FromUser'] == $fromUser){
                     $output .=    
                     ' <div class="outgoing_msg">
		  <div class="sent_msg">
			<p>'.$chat['Message'].'</p>
			 </div>
		</div>';
         
                         
                    }
                    elseif($chat['FromUser'] != $fromUser){
                                          
   $sql2="SELECT * FROM uzivatele WHERE id='$toUser'";
		 $vys2=mysqli_query($pripojeni,$sql2);
		 $pole2=mysqli_fetch_assoc($vys2);      
           if($pole2['profilova_fotografie'] == 1){
		         $filename="../profilovky/profile".$pole2['id']."*";
        $fileinfo=glob($filename);
		$fileext=explode(".",$fileinfo[0]); 
		$fotoska = '<div class="incoming_msg_img"> <img style="margin-bottom:15px" src="../profilovky/profile'.$pole2['id'].'.'.$fileext[3].'" alt="sunil"> </div>';

		    }
		    else{
		        $fotoska = '<div class="incoming_msg_img"> <img style="margin-bottom:15px" src="../profilovky/default.jpg" alt="sunil"> </div>';

		    }  
		    
		    
        $output .= '<div class="incoming_msg">
        '.$fotoska.'
		  <div class="received_msg">
			<div class="received_withd_msg">
			  <p>'.$chat['Message'].'</p>
		       </div>
		  </div>
		</div>  ';
                        

                  
            }
      
     
          }
            echo $output;
        ?>