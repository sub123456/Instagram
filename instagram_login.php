<?php
    error_reporting(0);
	
    include('connect.php');
	
	session_start();
	
	if(isset($_POST['submit'])){
		
		$email = $_POST['email'];
		
		$password = $_POST['password'];
		
		
		$sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
		
		$result = mysqli_query($conn, $sql);
		
		if($row = mysqli_num_rows($result)>0){
			
			while($user_row = mysqli_fetch_assoc($result)){
						
						$_SESSION['user_id'] = $user_row['user_id'];
						
						header('location:instagram.php');
			
						$message = "<h6>"."Login Success"."</h6>";
		
					}
			
			
		}else{
			
			if(empty($email)||empty($password)){
				
				
					$message = "<h6>"."Plss fill all fields"."</h6>";
			
				
			}else{
				
				
			    $message = "<h6>"."Email or Password doesn't match"."</h6>";
			
			}
			
		}
		
	}




?>


<!DOCTYPE html>
<html>
<head>
   <title>Instagram Login form </title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <style>
      *{
		  margin:0;
		  padding:0;
	  }
	  .body-container{
		  width:100%;
		  max-Width:350px;
		  margin:auto;
		  
	  }
	  .container{
		   border:1px solid #ccc;
		  margin-top:10px;
	  }
	  .bottom-container{
		   border:1px solid #ccc;
		  margin-top:10px;
	  }
	  .heading{
		  
		  width:100%;
		  max-Width:200px;
		  margin:auto;
		  margin-top:10px;
	  }
	  .heading img{
		  
		  width:100%;
	  }
	  
	 
	  .inner-container p{
		  text-align:center;
		  color:blue;
		  font-size:14px;
	  }
	  .inner-container{
		  padding:25px;
	  }
	  .link-container{
		  padding:20px;
	  }
	  input[type=email],input[type=text],input[type=password]{
		  
		  width:100%;
		  padding:8px;
		  margin:6px 0;
		  display:inline-block;
		  box-sizing:border-box;
		  font-size:12px;
		  border:1px solid #e9e9e9;
		  border-radius:4px;
		  background-color:#F0F0F0;
		  
	  }
	  button{
		  
		  width:100%;
		  padding:8px;
		  margin:8px 0;
		  font-size:12px;
		  border:none;
		  border-radius:5px;
		  background-color:#3897f0;
		  color:white;
		  
		  
	  }
	  h5{
		  
		  text-align:center;
		  color:#C0C0C0;
		  margin-top:5px;
	  }
	  h5 a{
		  
		  text-align:center;
		  color:blue;
		  font-size:14px;
	  }
	  h4{
		 
       text-align:center;		 
	  }
	  @media screen and (max-width:768px){
		  
		  .container{
			  border:none;
		  }
	  }
	  h6{
		  color:red;
		  font-size:12px;
	  }
	
 </style>  
  <body>
  
      <div class="body-container">
	   
   	   
	   <div class="container">
	       
		   <div class="heading"><img src="icon/instagram_name.png"> </div>
	   
	          
			   <form action="instagram_login.php" method="post">
			      
				  <div class="inner-container">
				  
				     <?php echo $message;  ?>
				   
					 <input type="email" name="email" placeholder="Phone number, username, or email" ></input>
				  
				    
				    <input type="password" name="password" placeholder="Password" ></input>
					
					<button type="submit" name="submit">Log In</button>
					
					<h5>OR</h5>
					 
					
					<div class="link-container">
					
					 <h5><a><i class="fab fa-facebook-square"></i> Log in with facebook</a></h5>
					 
					 
					</div>
					
					   
					   <p>Forgot password?</p>
					 
					   
					 
				  
				  
				  </div>
			     
			   </form>
			   
	   </div>
	   
	      <div class="bottom-container">
		  
		       <div class="inner-container">
		  
		             <h4>Don't Have an account? <a href="instagram_signup.php" style="text-decoration:none;">Sign up</a></h4>
				</div>
		  
		  </div>
	   
	   
	   </div>
	   
	 
  </body>
</html>