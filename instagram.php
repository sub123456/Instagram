 <?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
	
	if(!isset($_SESSION['user_id'])){
	
	   header('location:instagram_login.php');
	}
     else{
		 
		// $message = "<h2>".$_SESSION['user_id']."</h2>";
	 }
?>


<!DOCTYPE html>
<html>
<head>

 <title>Instagram</title>
 
 <meta charset="utf-8">
  
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <!----add jquery link----> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <script src="scripts.js"></script>
  
 <link rel="stylesheet" href="style.css">  
 
 <style>
  
</style>
</head>
<body>
   
  <div class="home-container">
  
  <div id="Home" class="container actives">
      
      <div class="home-nav-top">
  
         <ul>
   
          <li class="nav-start"><a><i class="fas fa-camera" style="color:black;"></i></a></li>
	
          <li class="nav-img"><a><img src="icon/instagram_name.png"/></a></li>
	
          <li class="nav-end"><a><i class="fas fa-location-arrow" style="color:black;"></i></a></li>
   
         </ul>
   
      </div>

       <div class="home-main-container">
                 
				

        </div>	  
      
  </div>
  
  <div id="Search" class="container">
   
        <?php include('instagram_search.php') ?>	
	   
   </div>
  
  <div id="Upload" class="container">
        
		<?php include('upload.php') ?>
		 
  </div>
  
  <div id="Users" class="container">
      
	   <?php include('instagram_follow.php') ?>	
	   
  </div>
  
  <div id="Profile" class="container">
      
	   <?php include('profile.php') ?>	

  </div>
  
  <div id="user-profile" class="user-profile-home-conatiner">
      
	   <?php include('user_profile.php') ?>	

  </div>
  
  <div class="home-nav-bottom">
  
    <ul>
	
	  <li><a class="tab active"  href="Home"><i class="fas fa-home"></i></a></li>
	  
	 <li><a class="tab"  href="Search"><i class="fas fa-search"></i></a></li>
	 
     <li> <a class="tab" href="Upload" > <i class="fas fa-plus"></i></a></li>
	 
     <li><a class="tab" href="Users"><i class="fas fa-heart"></i></a></li>
	 
     <li><a class="tab" href="Profile"><i class="fas fa-user"></i></a></li>
   
	
	</ul>
  
  </div>
  
 
 </div>
 
 
  <div  class="comment-home-conatiner">
  
       <?php
	   
	    include('instagram_comment.php');
		
	   ?>

  </div>
  
   <div  class="edit-profile-container">
			
			 <?php include('instagram_edit.php') ?>
   </div>
  
  
 
<script>
    
		
    
</script>
    
</body>
</html> 
		
