<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
	
	//fetch follow users
	
	
		 
	if(isset($_POST['action_user'])){
		
		$userId = $_SESSION['user_id'];
		
		$sql = "SELECT * FROM `user` WHERE `user_id` != '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $fullname = $row['fullname'];
		 
          $followId = $row['user_id'];
		 		 
		  $profileImage = $row['user_image'];
		  
		  if($profileImage==null){
			  
			  $userProfileImage = " <img src='icon/profile_image.jpg' />";
			  
		  }else{
			  
			    $userProfileImage = " <img src='$profileImage' />";
			
		  }
		  
		  echo"<div class='follow-main-container'>
		
		            <div class='follow-image-container'>
		
		                $userProfileImage;

		            </div>
		
		     </div>
			 
			 <div class='follow-main-container'>
		
		              <p>$fullname</p>
		
		     </div>
			 
			 <div class='follow-main-container'>
		
		           <div class='follow-like-container'>
		
		              
					  ".make_follow($conn, $userId , $followId)."
		
		            </div>
		
		     </div>";
		}
		
	}
	
	 function make_follow($conn, $userId , $followId){
		 
		 $sql = "SELECT * FROM `user_follow` WHERE `user_id`= '$userId' AND `follow_id`= '$followId'";
		
		$result = mysqli_query($conn, $sql);
	
		if($row = mysqli_num_rows($result)>0){
			
			$output = ' <button style="background-color:white; color:black; border:1px solid #ccc;" class="follow_button" data-action="following" data-user_id="'.$userId.'" data-user_follow="'.$followId.'">Following</button>';
		}
		else{
			
			$output = ' <button class="follow_button" data-action="follow" data-user_id="'.$userId.'" data-user_follow="'.$followId.'">Follow</button>';
		
		}
		return $output;
	 }
	 
	 //users follow and following
	 
	 
	  if($_POST['action_follow']=='follow'){
		
		 $userId = $_POST['user_id'];
		
		 $followId = $_POST['follow_id'];
		
		 $query = "INSERT INTO `user_follow`(`user_id`, `follow_id`) VALUES ('$userId','$followId')";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		  
		 }
	
	 }
	 
	 if($_POST['action_follow']=='following'){
		
	     $userId = $_POST['user_id'];
		
		 $followId = $_POST['follow_id'];
		
		 $query = "DELETE FROM `user_follow` WHERE `user_id`='$userId' AND `follow_id`='$followId'";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		 
		}
	
	 }
	 
	
	
?>