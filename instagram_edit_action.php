<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
	
	  if($_FILES['edit_file']['name'] != ''){
		  
	   $userId = $_SESSION['user_id'];
  
	   $target_dir = "instagram_profileimage/";
	   
	   $name = $_FILES['edit_file']['name'];
	   
	   $taraget_file_name =  $target_dir .basename($name);
	   
	   $profile_image_url = 'http://192.168.43.100/social/instagram_profileimage/'.$name;
	   
	   $fullname = $_POST['fullname'];
	  
       $username = $_POST['username'];
	  
       $website = $_POST['website'];
	   
	   $bio = $_POST['bio'];
	  
	   $email = $_POST['email'];
	  
	   $phonenumber = $_POST['phonenumber'];
	   
	   $gender = $_POST['gender'];
	  
	  
	  	  
	   
	   move_uploaded_file($_FILES['edit_file']['tmp_name'], $taraget_file_name );
	  			
				
		$query = "UPDATE `user` SET `fullname`='$fullname',`username`='$username',
		
		`user_image`='$profile_image_url',`website`='$website',`bio`='$bio',
		
		`gender`='$gender',`phonenumber`='$phonenumber',`email`='$email' WHERE `user_id`='$userId'";	
				
		$query_result =mysqli_query($conn, $query);
		
		   if($query_result){
			   
			 echo "success";
			   
			  
			
		   }else{
			   
			   echo "Error";
			
		   }
		
   }
	
?>