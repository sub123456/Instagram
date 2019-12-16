<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();
  
    //fetch profile details
	 
	if(isset($_POST['action_profile'])){
		
		$userId = $_SESSION['user_id'];
		
		$sql = "SELECT * FROM `user` WHERE `user_id` = '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $fullname = $row['fullname'];
		  
		  $website = $row['website'];
		  
		  $bio = $row['bio'];
		  
		  $profileImage = $row['user_image'];
	  
		  if($profileImage==null){
			  
			  $userProfileImage = " <img src='icon/profile_image.jpg'/>";
			  
		  }else{
			  
			    $userProfileImage = " <img src='$profileImage'/>";
			
		  }
		  
		  echo"<div class='profile-container box1'>
	  
	                    <div class='profile-image-container'>
			      
				              $userProfileImage
					 
			             </div>
	  
	               </div>
		 
		 
		         <div class='profile-container box2'>
	  
	                    <div class='profile-edit-container'>
			   
			               <div class='profile-follow-container'>
					
					            ".make_post($conn, $userId)."
					
					           <p class='follow'>Posts</p>
					
					       </div>
					
					       <div class='profile-follow-container'>
					
					           ".make_followers($conn, $userId)."
					
					            <p class='follow'>Followers</p>
					   
					   
					       </div>
					
					       <div class='profile-follow-container'>
					
					          ".make_following($conn, $userId)."
					
					       <p class='follow'>Following</p>
					
					      </div>
					
					   <a href='instagram_edit.php' class='edit_profile_button'><button>Edit Profile</button></a>
					
			          </div>
	  
	               </div>
	  
	              <div class='profile-detail'>
			
			        <p><b>$fullname</b></p>
				
				    <p>$bio</p>
				
				    <p style='color:#3897f0;'>$website</p>
				
			     </div>";
		  
		}
	}
	
	function make_followers($conn, $userId){
		  
		 $sql = "SELECT count(*) As sum FROM `user_follow` WHERE `follow_id` = '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<p><b>0</b></p>';
			
		}else{
			
			$output = '<p><b>'.$row_result.'</b></p>';
			
		}
		
		 return $output ;
		  
	  }

	  
	  function make_following($conn, $userId){
		  
		 $sql = "SELECT count(*) As sum FROM `user_follow` WHERE `user_id` = '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<p><b>0</b></p>';
			
		}else{
			
			$output = '<p><b>'.$row_result.'</b></p>';
			
		}
		
		 return $output ;
		  
	  }

	  
	   function make_post($conn, $userId){
		  
		 $sql = "SELECT count(*) As sum FROM `user_post` WHERE `user_id` = '$userId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<p><b>0</b></p>';
			
		}else{
			
			$output = '<p><b>'.$row_result.'</b></p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  //fetch profile grid post
	  
	  
	  if(isset($_POST['action_profile_grid_post'])){
		
		$userId = $_SESSION['user_id'];
		
		$sql = "SELECT * FROM `user_post` WHERE `user_id` = '$userId' ORDER BY `post_id` DESC";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  
		  $postUrl = $row['post_url'];
		  
		  $postId = $row['post_id'];
		  
		  
	  
		  if($postUrl==null){
			  
			  $post_url = "<img src='icon/post_image.png'/>";
			  
		  }else{
			  
			    $post_url = "<a href='#profile-grid' class='grid_button' data-action='grid'  data-post_id='$postId' ><img src='$postUrl'/></a>";
			
		  }
		  
		  echo"<div class='grid-post-container'>
					 
					 $post_url
				 
			 </div>";
		  
		}
		
	}
	
	//fetch profile single post
	
	if(isset($_POST['action_profile_grid_single_post'])){
		
		$postId = $_POST['post_id'];
		
		//join two table user and user_post
		
		$sql = "SELECT * FROM `user_post` INNER JOIN  `user` ON user_post.user_id = user.user_id
		
		WHERE user_post.post_id = '$postId' ";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $caption = $row['caption'];
		  
		  $username = $row['username'];
		  
		  $userImage = $row['user_image'];
		  
		  $date = $row['date'];
		  
		  $postUrl = $row['post_url'];
		  
		  $postId = $row['post_id'];
		  
		  $userId = $row['user_id'];
		  
		 
		  if($postUrl==null){
			  
			  $post_url = "<img src='icon/post_image.png'/>";
			  
		  }else{
			  
			    $post_url = "<img src='$postUrl' />";
			
		  }
		  
		  
		  if($userImage==null){
			  
			  $user_image = "<img src='icon/profile_image.jpg'/>";
			  
		  }else{
			  
			    $user_image = "<img src='$userImage' />";
			
		  }
		  
		  echo" <div class='menu-main-container' >
				 
				    <ul>
                        <li class='menu-image-icon'><a>$user_image</a></li>
						
                        <li class='menu-name-icon'><a>$username</a></li>
						
                        <li class='menu-menu-icon'><a><i class='fas fa-ellipsis-v'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				 
				 <div class='main-post-container'>
				 
				       $post_url
					   
				 </div>
				 
				 
				 <div class='comment-icon-container'>
				 
				    <ul>
                        <li class='comment-menu-icon'><a><i class='far fa-heart'></i></a></li>
						
                        ".make_profile_comment($conn, $userId , $postId)."
						
						<li class='comment-menu-icon'><a><i class='far fa-share-square'></i></a></li>
                        
						<li class='save-menu-icon'><a><i class='far fa-bookmark'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				  <div class='post-detail-container'>
				 
				    ".make_grid_posts($conn, $postId)."
					
				    <p><b>$username</b> $caption</p>
					
					".make_grid_posts_comment($conn, $userId ,$postId)."
	
				    ".make_grid_date($conn, $postId)."
					
				 </div>";
		  		 
		}
		
	 }
	 
	  function make_profile_comment($conn, $userId , $postId){
		 
		 $sql = "SELECT * FROM `user_post` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
	
		 while($row = mysqli_fetch_assoc($result)){
			 
			 $userId  = $row['user_id'];
		
		     $postId = $row['post_id'];
		
			
			$output = '<li class="comment-menu-icon"><a href="#comment" class="comment_button" data-user_image="'.$userImage.'" data-user_id="'.$userId.'" data-post_id="'.$postId.'"><i class="far fa-comment"></i></a></li>';
		
		}
		return $output;
	 }
	
	 
	function make_grid_posts_comment($conn, $userId ,$postId){
		  
		 $sql = "SELECT count(*) As sum FROM `post_comment` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<a><p style="color:#aaa;">View all 0 comments</p></a>';
					
			
		}else{
			
			$output = '<a style="text-decoration:none;" href="#comment" class="comment_button"  data-user_id="'.$userId.'" data-post_id="'.$postId.'"><p style="color:#aaa;">View all '.$row_result.' comments</p></a>';
			
		}
		
		 return $output ;
		  
	  }
	  
	   
	  				
 function make_grid_posts($conn, $postId){
		  
		 $sql = "SELECT count(*) As sum FROM `post_like` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<p><b>0 Likes</b></p>';
					
			
		}else{
			
			$output = '<p><b>'.$row_result.' Likes</b></p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  
	   function make_grid_date($conn, $postId){
		  
		 $sql = "SELECT * FROM `user_post` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		$date = $row['date'];
		
		
		$output = '<p style="color:#aaa;">'.make_grid_time($date).'</p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  function make_grid_time($time_ago){
		  
		  $time_ago = strtotime($time_ago);
		  
		  $cur_time = time();
		  
		  $time_elapsed = $cur_time - $time_ago;
		  
		  $seconds = $time_elapsed ;
		  
		  $minutes = round($time_elapsed/60);
		  
		  $hours = round($time_elapsed/3600);
		  
		  $days = round($time_elapsed/86400);
		  
		  $weeks = round($time_elapsed/604800);
		  
		  $months = round($time_elapsed/2600640);
		  
		  $years = round($time_elapsed/31207680);
		  
		  if($seconds <= 60){
			  
			  return "Just now";
		  }
		   else if($minutes <= 60){
			   
			   if($minutes==1){
				   
				   return "a minute ago";
				   
			   }else{
				   
				   return "$minutes minutes ago"; 
			   }
		   }
		  
		  else if($hours <= 24){
			   
			   if($hours==1){
				   
				   return "an hour ago";
				   
			   }else{
				   
				   return "$hours hours ago"; 
			   }
		   }
		   else if($days <= 7){
			   
			   if($days==1){
				   
				   return "yesterday";
				   
			   }else{
				   
				   return "$days days ago"; 
			   }
		   }
		    else if($weeks <= 4.3){
			   
			   if($weeks==1){
				   
				   return "a week ago";
				   
			   }else{
				   
				   return "$weeks weeks ago"; 
			   }
		   }
		    else if($months <= 12){
			   
			   if($months==1){
				   
				   return "a month ago";
				   
			   }else{
				   
				   return "$months monthsago"; 
			   }
		   }
		    else {
			   
			   if($years==1){
				   
				   return "one year ago";
				   
			   }else{
				   
				   return "$years years ago"; 
			   }
		   }
	  }
	 	
	// fetch profile list posts
	
	
	if(isset($_POST['action_list_post'])){
		
		$userId = $_SESSION['user_id'];
		
		//join two table user and user_post
		
		$sql = "SELECT * FROM `user_post` INNER JOIN  `user` ON user_post.user_id = user.user_id
		
		WHERE user_post.user_id = '$userId' ORDER BY `post_id` DESC";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $caption = $row['caption'];
		  
		  $username = $row['username'];
		  
		  $userImage = $row['user_image'];
		  
		  $date = $row['date'];
		  
		  $postUrl = $row['post_url'];
		  
		   $postId = $row['post_id'];
		  
	  
		  if($postUrl==null){
			  
			  $post_url = "<img src='icon/post_image.png'/>";
			  
		  }else{
			  
			    $post_url = "<img src='$postUrl' />";
			
		  }
		  
		  
		  if($userImage==null){
			  
			  $user_image = "<img src='icon/profile_image.jpg'/>";
			  
		  }else{
			  
			    $user_image = "<img src='$userImage' />";
			
		  }
		  
		  echo" <div class='menu-main-container' >
				 
				    <ul>
                        <li class='menu-image-icon'><a>$user_image</a></li>
						
                        <li class='menu-name-icon'><a>$username</a></li>
						
                        <li class='menu-menu-icon'><a><i class='fas fa-ellipsis-v'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				 
				 <div class='main-post-container'>
				 
				       $post_url
					   
				 </div>
				 
				 
				 <div class='comment-icon-container'>
				 
				    <ul>
                        <li class='comment-menu-icon'><a><i class='far fa-heart'></i></a></li>
                        <li class='comment-menu-icon'><a href='#comment' class='comment_button' data-user_image='$userImage' data-user_id='$userId' data-post_id='$postId'><i class='far fa-comment'></i></a></li>
                        <li class='comment-menu-icon'><a><i class='far fa-share-square'></i></a></li>
                        <li class='save-menu-icon'><a><i class='far fa-bookmark'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				  <div class='post-detail-container'>
				 
				    ".make_list_posts($conn, $postId)."
					
				    <p><b>$username</b> $caption</p>
					
				    ".make_list_posts_comment($conn, $userId ,$postId)."
					
				    ".make_list_date($conn, $postId)."
					
				 </div>";
		  		 
		}
		
	 }
 function make_list_posts($conn, $postId){
		  
		 $sql = "SELECT count(*) As sum FROM `post_like` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<p><b>0 Likes</b></p>';
					
			
		}else{
			
			$output = '<p><b>'.$row_result.' Likes</b></p>';
			
		}
		
		 return $output ;
		  
	  }
	   function make_list_posts_comment($conn, $userId ,$postId){
		  
		 $sql = "SELECT count(*) As sum FROM `post_comment` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    $row = mysqli_fetch_assoc($result);
		
		$row_result = $row['sum'];
		
		if($row_result==null){
			
			$output = '<a><p style="color:#aaa;">View all 0 comments</p></a>';
					
			
		}else{
			
			$output = '<a style="text-decoration:none;" href="#comment" class="comment_button"  data-user_id="'.$userId.'" data-post_id="'.$postId.'"><p style="color:#aaa;">View all '.$row_result.' comments</p></a>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  
	   function make_list_date($conn, $postId){
		  
		 $sql = "SELECT * FROM `user_post` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		$date = $row['date'];
		
		
		$output = '<p style="color:#aaa;">'.make_list_time($date).'</p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  function make_list_time($time_ago){
		  
		  $time_ago = strtotime($time_ago);
		  
		  $cur_time = time();
		  
		  $time_elapsed = $cur_time - $time_ago;
		  
		  $seconds = $time_elapsed ;
		  
		  $minutes = round($time_elapsed/60);
		  
		  $hours = round($time_elapsed/3600);
		  
		  $days = round($time_elapsed/86400);
		  
		  $weeks = round($time_elapsed/604800);
		  
		  $months = round($time_elapsed/2600640);
		  
		  $years = round($time_elapsed/31207680);
		  
		  if($seconds <= 60){
			  
			  return "Just now";
		  }
		   else if($minutes <= 60){
			   
			   if($minutes==1){
				   
				   return "a minute ago";
				   
			   }else{
				   
				   return "$minutes minutes ago"; 
			   }
		   }
		  
		  else if($hours <= 24){
			   
			   if($hours==1){
				   
				   return "an hour ago";
				   
			   }else{
				   
				   return "$hours hours ago"; 
			   }
		   }
		   else if($days <= 7){
			   
			   if($days==1){
				   
				   return "yesterday";
				   
			   }else{
				   
				   return "$days days ago"; 
			   }
		   }
		    else if($weeks <= 4.3){
			   
			   if($weeks==1){
				   
				   return "a week ago";
				   
			   }else{
				   
				   return "$weeks weeks ago"; 
			   }
		   }
		    else if($months <= 12){
			   
			   if($months==1){
				   
				   return "a month ago";
				   
			   }else{
				   
				   return "$months monthsago"; 
			   }
		   }
		    else {
			   
			   if($years==1){
				   
				   return "one year ago";
				   
			   }else{
				   
				   return "$years years ago"; 
			   }
		   }
	  }
  
  ?>