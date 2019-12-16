<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
	
	 // search users details
	 
	  if(isset($_POST['search'])){
		
		$userId = $_SESSION['user_id'];
		
		$search = $_POST['search'];
		
		$sql = "SELECT * FROM `user` WHERE fullname LIKE '%$search%' AND `user_id` != '$userId'";
		
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
		  
		  echo"<div class='search-main-container'>
		
		            <div class='search-image-container'>
		
		                $userProfileImage
		
		            </div>
		
		    </div>
			 
			 <div class='search-main-container'>
		
		              <p>$fullname</p>
		
		     </div>
			 
			 <div class='search-main-container'>
		
		           <div class='search-like-container'>
		
		             ".make_search_follow($conn, $userId , $followId, $search)."
		
		            </div>
		
		     </div>";
		}
		
	}
	
	 function make_search_follow($conn, $userId , $followId, $search){
		 
		 $sql = "SELECT * FROM `user_follow` WHERE `user_id`= '$userId' AND `follow_id`= '$followId'";
		
		$result = mysqli_query($conn, $sql);
	
		if($row = mysqli_num_rows($result)>0){
			
			$output = ' <button style="background-color:white; color:black; border:1px solid #ccc;" class="user_follow_button" data-action="user_following" data-search="'.$search.'" data-user_id="'.$userId.'" data-user_follow="'.$followId.'">Following</button>';
		}
		else{
			
			$output = ' <button class="user_follow_button" data-action="user_follow" data-search="'.$search.'" data-user_id="'.$userId.'" data-user_follow="'.$followId.'">Follow</button>';
		
		}
		return $output;
	 }
	 
	 
	 
	 if($_POST['action_follow']=='user_follow'){
		
		 $userId = $_POST['user_id'];
		
		 $followId = $_POST['follow_id'];
		
		 $query = "INSERT INTO `user_follow`(`user_id`, `follow_id`) VALUES ('$userId','$followId')";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		  
		 }
	
	 }
	 
	 if($_POST['action_follow']=='user_following'){
		
	     $userId = $_POST['user_id'];
		
		 $followId = $_POST['follow_id'];
		
		 $query = "DELETE FROM `user_follow` WHERE `user_id`='$userId' AND `follow_id`='$followId'";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		 
		}
	
	 }
	 

?>