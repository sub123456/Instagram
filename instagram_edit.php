
 <?php
   error_reporting(0);
	
   include('connect.php'); 
   
   session_start();
   
	
  $userId = $_SESSION['user_id'];
  
  
  $sql = "SELECT * FROM `user` WHERE `user_id` = '$userId'";
		
  $result = mysqli_query($conn, $sql);
		
  while($row = mysqli_fetch_assoc($result)){
		
		$fullname = $row['fullname'];
       
	    $username = $row['username'];
 
        $email = $row['email'];
		
		$profileImage = $row['user_image'];
		
		 if($profileImage==null){
			  
			  $userProfileImage = "<img  src='icon/profile_image.jpg'  id='profileImages'/>";
			  
		  }else{
			  
			  $userProfileImage = "<img  src='$profileImage'  id='profileImages'/>";
			
		  }
		
		
  }
  
  
  
 ?>


<!DOCTYPE html>
<html>
<head>
  <title>Instagram Edit Profile</title>
  
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
  <!----add jquery link----> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
 <style>
 
</style>
</head>
<body>

<div class="edit-container">
	
    <div class="edit-menu-container">
	 
	   <ul>
	   
	   <li class="edit-icon"><a class="edit-close"><i class="fas fa-times"></i></a></li>
	   
	   <li class="edit-name"><a>Edit Profile</a></li>
	   
	   <li class="edit-icon"><button type="submit" name="submit" id="edit_submit" style="border:none; background-color:#f0f0f0;"><a style="color:#3897f0;"><i class="fas fa-check"></i></a></button></li>
	 
	 </ul>
	
	</div>
	
	<div class="edit-main-container">
	
	       <div class="edit-image-container">
		
		        <div class="edit-image-inside-container">
		
		          <?php echo $userProfileImage ;?>
				
		        </div>
				
			 <button class="select_image">Change Photo </button>
			
			 <span>
			   
			    <input type="file" name="imagefile" id="input_file" onchange="readUrl(this);" ></input>
			     
			  </span>
			  
	       </div>
		   
		    <span id="messages"> </span>
		
		<div class="edit-profile-detail-container">
		
		     <label>Name</label>
	
	         <input type="text" name="fullname" id="edit_fullname" placeholder="Full name" value="<?php echo $fullname;?>"></input>
			
             <label>Username</label>
	
	         <input type="text" name="username" id="edit_username" placeholder="Username" value="<?php echo $username;?>"></input>
			
             <label>Website</label>
	
	         <input type="text" name="website" id="edit_website" placeholder="Website"></input>
			 
			<label>Bio</label>
	
	         <input type="text" name="bio" id="edit_bio" placeholder="Bio"></input>
						
	    </div>
		
		<div class="edit-tool-container">
	
	          <h6>Try Instagram Buisiness Tools</h6>
	    </div>
		
		<div class="edit-profile-detail-container">
	       
		     <label>Private Information</label>
	
	         <input type="text" name="email" id="edit_email" placeholder="E-mail Address" value="<?php echo $email;?>"></input>
			 
			 <label>Phone Number</label>
	
	         <input type="text" name="phonenumber" id="edit_phonenumber" placeholder="Enter your phone number"></input>
			
			<label>Gender</label>
	
	         <input type="text" name="gender" id="edit_gender" placeholder="Not specified"></input>
			
	    </div>
	
	</div>
	
 </div>	
  
	
<script>
	
	 $(document).ready( function(){
		
         		
     
	    $('.select_image').on('click', function(e){
		   
		   e.preventDefault();
		   
		   
		    $('#input_file').trigger('click');	
			
	     });
		 
		
	   
	  });
	   
	    function readUrl(input){
			
			if(input.files && input.files[0]){
				
				var reader = new FileReader();
				
				reader.onload = function(e){
					
					 $('#profileImages').attr('src', e.target.result);
					
				};
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
			
		}
		
		 
	</script>

</body>
</html>