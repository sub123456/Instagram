

<?php
    
    include('connect.php'); 
	session_start();
	
	session_unset();
	
	header('location:instagram_login.php');
			
?>
	
