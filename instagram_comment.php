
<?php
  error_reporting(0);
	
  include('instagram_connect.php');  
	
  $userId = $_SESSION['user_id'];

  $sql = "SELECT * FROM `user` WHERE `user_id` = '$userId'";
		
  $result = mysqli_query($conn, $sql);
			
  while($row = mysqli_fetch_assoc($result)){
		
  $profileImage = $row['user_image'];
		 
  if($profileImage == null){
			  
  $userImage = "<img src='icon/profile_image.jpg' />";
			  
	 }
	 else{
			  
  $userImage = "<img src='$profileImage' />";
			
	  }
		  
 }    
		
 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Instagram Comments</title>
  
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
   
    <div class="comment-body-container">
	     
	<div class="comment-nav-container">
	
	 <ul>
	   
	   <li class="comment-icon"><a class="comment-close"><i class="fas fa-arrow-left"></i></a></li>
	   
	   <li class="comment-name"><a>Comments</a></li>
	   
	 
	 </ul>
	
	</div>
	  
	  <div class="comment-main-container">
	      
		    <div class="comment-post-container">
		         
				
	  
	         </div>
			

		    <div class="comment-comment-container">
	            
			  
	        </div>
	  
	  </div>
	  
	  
	
	<div class="comment-bottom-container">
	
	     <form  method="post" id="comment_form" data-action="comment">
	   
	 		
	      <div class="comment-bottom-inner-container image">
	              
	           <?php echo $userImage; ?>
	
	      </div>
		 
		  
		  <div class="comment-bottom-inner-container comment">
	
	           <input type="text" name="comment"  placeholder="Add a comment..." id="insert_comment"></input>
					
	
	      </div>
		  
		  <div class="comment-bottom-inner-container submit">
	
	          <button type="submit" name="submit" id="submit">Post</button>
					
	
	      </div>
		  
		 </form>
	       			 
	</div>

    </div>
	
	 </div>
	
   
<script>
	
</script>

</body>
</html>