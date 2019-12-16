
 <?php
    error_reporting(0);
	
    include('connect.php'); 
	session_start();
	
	if(isset($_POST['submit'])){
		
		$fullname = $_POST['fullname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		
		$sql = "SELECT * FROM `user` WHERE `fullname` = '$fullname'";
		
		$result = mysqli_query($conn, $sql);
		
		if($row = mysqli_num_rows($result)>0){
			
			$message = "<h6>"."Name already excist"."</h6>";
			
		}else{
			
			if(empty($fullname)||empty($username)||empty($email)||empty($password)){
				
				
					$message = "<h6>"."Plss fill all fields"."</h6>";
			
				
			}else{
				
				
				$query = "INSERT INTO `user`( `fullname`, `username`,`email`, `password`,`date`) VALUES ('$fullname','$username','$email','$password','".date("Y-m-d").''.date("H:i:s", STRTOTIME(date('h:i:sa')))."')";
			
			    $query_result = mysqli_query($conn, $query);
				
				if($query_result){
					
					$user_sql = "SELECT * FROM `user` WHERE `fullname` = '$fullname'";
		
		            $user_result = mysqli_query($conn, $user_sql);
					
					while($user_row = mysqli_fetch_assoc($user_result)){
						
						$_SESSION['user_id'] = $user_row['user_id'];
						
						header('location:instagram.php');
			
					$message = "<h6>"."Sign Up successfully"."</h6>";
			
					}
				}
			
			}
			
		}
		
	}




?>

<!DOCTYPE html>
<html>
<head>
   <title>Instagram SignUp form </title>
   
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
	  
	  p{
		  text-align:center;
		  color:#ccc;
		  font-size:16px;
	  }
	  .inner-container p{
		  text-align:center;
		  color:#ccc;
		  font-size:14px;
	  }
	  .inner-container{
		  padding:25px;
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
	   
	           <p>Sign up to see photos and videos </p>
			   
			   <p>from your friends. </p>
			   
			   <form action="instagram_signup.php" method="post">
			      
				  <div class="inner-container">
				  
				     <button><i class="fab fa-facebook-square"></i> Log in with facebook</button>
					 
					 <h5>OR</h5>
					 
					 <?php echo $message;?>
					 
					 <input type="email" name="email" placeholder="Mobile Number or Email" ></input>
				  
				    <input type="text" name="fullname" placeholder="Full Name" ></input>
				  
				    <input type="text" name="username" placeholder="Username"></input>
				  
				    <input type="password" name="password" placeholder="Password" ></input>
					
					<button type="submit" name="submit">Sign Up</button>
					
					   
					   <p>By signing up, you agree to our</p>
					 
					   <p>Terms, Data policy and Cookies</p>
					   
					   <p>Policy.</p>
					 
					 
				  
				  
				  </div>
			     
			   </form>
			   
	   </div>
	   
	      <div class="bottom-container">
		  
		       <div class="inner-container">
		  
		             <h4>Have an account? <a href="instagram_login.php" style="text-decoration:none;">Log In</a></h4>
				</div>
		  
		  </div>
	   
	   
	   </div>
	   
	 
  </body>
</html>