<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
	
	 //upload posts
	 
	 
	 if($_FILES['upload_file']['name'] != ''){
		 
	   $name = $_FILES['upload_file']['name'];
	   
	   $target_dir = "posts/".$name;
	   
	   $post_url = 'http://192.168.43.100/social/posts/'.$name;
	   
	   $caption = $_POST['caption'];
	  
       $userId = $_SESSION['user_id'];
    
	   
	   move_uploaded_file($_FILES['upload_file']['tmp_name'], $target_dir );
	   
	   $save = "posts/".$name; // new file save instagram_post folder
	   
	   $file = "posts/".$name; //original file
	   
	   list($width, $height) = getimagesize($target_dir);
	   
	   $image = imagecreatefromjpeg($file);
	   
	   $info = getimagesize($file);
	   
	   if($info['mime']=='image/jpeg'){
		   
		  $image = imagecreatefromjpeg($file);
	     
	   }elseif($info['mime']=='image/gif'){
		   
		    $image = imagecreatefromjpeg($file);
	      
	   }elseif($info['mime']=='image/png'){
		   
		    $image = imagecreatefromjpeg($file);
	      
	   }
	    //same width same height
	   
	     $new_width=300;
		 
		 $new_height=300;
		 
		 $tn = imagecreatetruecolor($new_width, $new_height);
		 
		 imagecopyresampled($tn,$image,0,0,0,0,$new_width,$new_height,$width, $height);
		 
		 imagejpeg($tn,$save,60);
		 		
		$query = "INSERT INTO `user_post`( `user_id`, `caption`, `post_url`,`date`) VALUES ('$userId','$caption','$post_url','".date("Y-m-d").''.date("H:i:s", STRTOTIME(date('h:i:sa')))."')";	
				
		$query_result =mysqli_query($conn, $query);
		
		   if($query_result){
			   
			echo   $message = "Insert Success";
			  
			
		   }else{
			   
			   $message = "Insert Error";
			
		   }
			
		 
   }

?>