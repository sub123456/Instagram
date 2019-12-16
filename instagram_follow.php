<!DOCTYPE html>
<html>
<head>
  <title>Instagram user follow</title>
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <!----add jquery link----> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
 <style>
   
</style>
</head>
 <body> 
 
   <div class="user-top-nav">
 
  <ul>
   
   <li><a class="user-tab" containerIds="following">FOLLOWING</a></li>
   
   <li><a class="user-tab activate" containerIds="you">YOU</a></li>

  </ul> 

  </div> 

  <div id="following" class="user-container">
   
      <div class="user-following-container">
		
		     <div class="following-main-container">
		
		            <div class="following-image-container">
		
		                <img src="icon/profile_image.jpg" />
		
		            </div>
		
		     </div>
			 
			 <div class="following-main-container">
		
		              <p>Full Name</p>
		
		     </div>
			 
			 <div class="following-main-container">
		
		           <div class="following-like-container">
		
		              <button>Follow</button>
		
		            </div>
		
		     </div>

		
		</div>

  </div> 

  <div id="you" class="user-container user-active">
   
        <div class="user-follow-container">
		
		     

		
		</div>

  </div>   
  
 <script>
    $(document).ready(function(){
		
		
	});
 </script>
    
</body>
</html> 