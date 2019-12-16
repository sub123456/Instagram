
<?php
  error_reporting(0);
	
  include('connect.php'); 
	
        $userId = $_SESSION['user_id'];

       $sql = "SELECT * FROM `user` WHERE `user_id` = '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		  $displayName = $row['username'];
		 
		
		}    
		
 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Instagram profile</title>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <!----add jquery link----> 
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
 <style>
 
	 
 </style>
 </head>
 <body> 
      <div class="profile-main-container">

	  
	 <div class="menu-container">
		 
	          <ul>
			  
	             <li class="nav-name"><a><p><?php echo $displayName;?></p></a></li>
	 
	             <li class="nav-icon"><a><i class="fas fa-history"></i></a></li>
	 
	             <li class="nav-icon"><a><i class="fas fa-user-plus"></i></a></li>
	 
            	 <li class="nav-icon"><a class="menu"><i class="fas fa-ellipsis-v"></i></a></li>
	 
	          </ul>
			  
		    <div class="profile-main-menu">
	  
		        <a href="instagram_logout.php">Log Out</a>
	  
	        </div>
	 
	    </div>
	  
	  
	  <div class="profile-containers">
		 
		      <div class="container-profile">
			  
			        
		      </div>
		  
		   <div class="profile-tabs">
			
			     <ul>
	                 
					 <li ><a class="profile-tab profile-active"  href="#grid"><i class="fas fa-grip-horizontal"></i></a></li>
	                 
					 <li ><a class="profile-tab "  href="#list"><i class="fas fa-list"></i></a></li>
	                 
					 <li ><a class="profile-tab "  href="#tag"><i class="fas fa-portrait"></i></a></li>
	                 
					 <li ><a class="profile-tab "  href="#save"><i class="fas fa-bookmark"></i></a></li>
	 
	            </ul>
				
			</div>
			
			<div id="grid" class="profile-container-inside profile-actives">
			
			     <div class="grid-main-container">
				     
					 
				 
				 </div>
				 
            </div>
			
			<div id="list" class="profile-container-inside">
			
			    <div class="profile-container-list">
				
				
				</div>
       
            </div>
			
			<div id="tag" class="profile-container-inside">
			
			  <p>tag</p>
       
            </div>
			<div id="save" class="profile-container-inside">
			
			  <p>save</p>
       
            </div>
			
		
	  </div>
	  
	    <div id="profile-grid" class="profile-grid-container">
			
		     <div class="profile-grid-nav-container">
	
	            <ul>
	   
	             <li class="profile-grid-icon"><a class="profile-grid-close"><i class="fas fa-arrow-left"></i></a></li>
	   
	             <li class="profile-grid-name"><a style="text-align:left;">Photo</a></li>
	   
	 
	           </ul>
	
	         </div>
			 
			 
			 <div  class="grid-profile-container">
			
			 
             </div>
			 
			 
         </div>
	  
	   
	  </div>
	  
	  
	      
 <script>
 

 </script>
    
 </body>
 </html> 