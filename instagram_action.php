
<?php
    error_reporting(0);
	
    include('connect.php'); 
	
	session_start();	
		
	// fetch home page post

	
	 if(isset($_POST['action_home_post'])){
		
		$userId = $_SESSION['user_id'];
		
		//join two table user and user_post, fetch following users post
		
		$sql = "SELECT * FROM `user_post` INNER JOIN  `user` ON user_post.user_id = user.user_id 
		
		LEFT JOIN `user_follow` ON user_post.user_id = user_follow.follow_id 
		
		WHERE user_post.user_id = '$userId' OR user_follow.user_id = '$userId' 
		
		GROUP BY user_post.post_id
		
		ORDER BY `post_id` DESC";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $caption = $row['caption'];
		  
		  $username = $row['username'];
		  
		  $userImage = $row['user_image'];
		  
		  $date = $row['date'];
		  
		  $postUrl = $row['post_url'];
	      
		  $postId = $row['post_id'];
		  		  
		  $usersId = $row['user_id'];
		  
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
						
						<li class='menu-name-icon'><a href='#user-profile' class='user_button' data-username='$username' data-post_id='$postId'>$username</a></li>
						
						<li class='menu-menu-icon'><a><i class='fas fa-ellipsis-v'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				 
				 <div class='main-post-container'>
				 
				       $post_url
					   
				 </div>
				 
				 
				 <div class='comment-icon-container'>
				 
				    <ul>
                          ".make_like($conn, $userId , $postId)."
						  
						<li class='comment-menu-icon'><a href='#comment' class='comment_button' data-user_image='$userImage' data-user_id='$userId' data-post_id='$postId'><i class='far fa-comment'></i></a></li>  
						
						<li class='comment-menu-icon'><a><i class='far fa-share-square'></i></a></li>
                        
						<li class='save-menu-icon'><a><i class='far fa-bookmark'></i></a></li>
   
                    </ul>
				 
				 </div>
				 
				  <div class='post-detail-container'>
				 
				    ".make_posts($conn, $postId)."
					
				    <p><b>$username</b> $caption</p>
					
					".make_posts_comment($conn, $userId ,$postId)."
					
				    
					 ".make_date($conn, $postId)."
					
				   
				 </div>";
		  		 
		}
		
	 }
	  
	
	 function make_like($conn, $userId , $postId){
		 
		 $sql = "SELECT * FROM `post_like` WHERE `user_id`= '$userId' AND `post_id`= '$postId'";
		
		$result = mysqli_query($conn, $sql);
	
		if($row = mysqli_num_rows($result)>0){
			
			$output = '<li class="comment-menu-icon"><a class="like_button" data-action="unlike" data-user_id="'.$userId.'" data-post_id="'.$postId.'"><i class="fas fa-heart" style="color:red;"></i></a></li>';
		}
		else{
			
			$output = '<li class="comment-menu-icon"><a class="like_button" data-action="like" data-user_id="'.$userId.'" data-post_id="'.$postId.'"><i class="far fa-heart"></i></a></li>';
                       
		
		}
		return $output;
	 }
	 
	 
	 
	 if($_POST['action_like']=='like'){
		
		 $userId = $_POST['user_id'];
		
		 $postId = $_POST['post_id'];
		
		 $query = "INSERT INTO `post_like`(`user_id`, `post_id`) VALUES ('$userId','$postId')";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		  
		 }
	
	 }
	 
	 if($_POST['action_like']=='unlike'){
		
	     $userId = $_POST['user_id'];
		
		 $postId = $_POST['post_id'];
		
		 $query = "DELETE FROM `post_like` WHERE `user_id`='$userId' AND `post_id`='$postId'";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		 
		}
	
	 }
	 
	  function make_posts($conn, $postId){
		  
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
	  
	  
	   function make_posts_comment($conn, $userId ,$postId){
		  
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
	  
	  
	  
	   function make_date($conn, $postId){
		  
	    $sql = "SELECT * FROM `user_post` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		$date = $row['date'];
		
		
		$output = '<p style="color:#aaa;">'.make_time($date).'</p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  function make_time($time_ago){
		  
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
		  
		  if($seconds <=60 ){
			  
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
	  
	  // comments and caption
	  
	  
	   if($_POST['action']=='comment'){
		
		 $userId = $_SESSION['user_id'];
		
		 $postId = $_POST['post_id'];
		 
		 $postComment = $_POST['post_comment'];
		
		 
		 $query = "INSERT INTO `post_comment`(`user_id`, `post_id`, `post_comments`,`post_date`) VALUES ('$userId','$postId','$postComment','".date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')))."')";
		
		 $query_result = mysqli_query($conn, $query);
		 
		 if($query_result){
			 
		  
		 }
	 }	
	
       if(isset($_POST['action_comment'])){
		
		$userId = $_POST['user_id'];
		
		$postId = $_POST['post_id'];
		 
		//join two table user and post_comment 
		
		$sql = "SELECT * FROM `post_comment` INNER JOIN  `user` ON post_comment.user_id = user.user_id 
		
		WHERE post_comment.post_id = '$postId' ORDER BY `id` DESC";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $postComment = $row['post_comments'];
		  
		  $username = $row['username'];
		  
		  $userImage = $row['user_image'];
		  
		  $postDate = $row['post_date'];
		  

		  if($userImage==null){
			  
			  $user_image = "<img src='icon/profile_image.jpg'/>";
			  
		  }else{
			  
			    $user_image = "<img src='$userImage' />";
			
		  }
		  
		  echo"<div class='comment-comment-inner-container image'>
	
	              $user_image
	
	           </div>
		 
		  
		      <div class='comment-comment-inner-container name' >
			     
                <div class='comment-name-container'>
							 
				 
			    <p class='comment-name'><b>$username</b> $postComment</p>
					   
				</div>	  

			  <div class='comment-time-container'>
					 
					    
		       <p class='comment-date'>".make_comment_time($postDate)."</p> 
					   
					   
					 
			  </div>
					  
			   <div class='comment-time-container';>
	                       
			  <p class='comment-like'>0 like</p>	
	                  
				       
		      </div>
			  
			  </div>
				
			   <div class='comment-comment-inner-container like'>
	
	             <i class='far fa-heart' style='margin-top:20px'></i>
	           
			   </div> ";
		  
		}
		
	   }
	
	
	 function make_comment_time($time_ago){
		  
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
		  
		  if($seconds <=60 ){
			  
			  return "1s";
		  }
		   else if($minutes <= 60){
			   
			   if($minutes==1){
				   
				   return "1m";
				   
			   }else{
				   
				   return "$minutes m"; 
			   }
		   }
		  
		  else if($hours <= 24){
			   
			   if($hours==1){
				   
				   return "1h";
				   
			   }else{
				   
				   return "$hours h"; 
			   }
		   }
		   else if($days <= 7){
			   
			   if($days==1){
				   
				   return "1d";
				   
			   }else{
				   
				   return "$days d"; 
			   }
		   }
		    else if($weeks <= 4.3){
			   
			   if($weeks==1){
				   
				   return "1w";
				   
			   }else{
				   
				   return "$weeks w"; 
			   }
		   }
		    else if($months <= 12){
			   
			   if($months==1){
				   
				   return "1m";
				   
			   }else{
				   
				   return "$months m"; 
			   }
		   }
		    else {
			   
			   if($years==1){
				   
				   return "1y";
				   
			   }else{
				   
				   return "$years y"; 
			   }
		   }
	  }
	  
	   
	   
	    if(isset($_POST['action_caption'])){
		
		$postId = $_POST['post_id'];
		 
		//join two table user and user_post 
		
		$sql = "SELECT * FROM `user_post` INNER JOIN  `user` ON user_post.user_id = user.user_id 
		
		WHERE user_post.post_id = '$postId' ";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		     
		  $postCaption = $row['caption'];
		  
		  $username = $row['username'];
		  
		  $userImage = $row['user_image'];
		  
		  $postDate = $row['date'];
		  
		  
		  if($userImage==null){
			  
			  $user_image = "<img src='icon/profile_image.jpg'/>";
			  
		  }else{
			  
			    $user_image = "<img src='$userImage' />";
			
		  }
		  
		  echo" <div class='comment-inner-container image'>
	
	           $user_image
			   
	           </div>
		 
		  
		      <div class='comment-inner-container name'>
	
	            <p style='font-size:17px; margin-top:5px; text-align:left;'><b>$username</b> $postCaption</p>	
	             
				 ".make_caption_date($conn, $postId)."
				
	           </div>";
		  
		  
		}
	}
	
 	 function make_caption_date($conn, $postId){
		  
	    $sql = "SELECT * FROM `user_post` WHERE `post_id` = '$postId'";
		
		$result = mysqli_query($conn, $sql);
			
	    while($row = mysqli_fetch_assoc($result)){
		
		$date = $row['date'];
		
		
		$output = '<p style="font-size:14px; margin-top:3px; color:#aaa; text-align:left;">'.make_caption_time($date).'</p>';
			
		}
		
		 return $output ;
		  
	  }
	  
	  
	   function make_caption_time($time_ago){
		  
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
		  
		  if($seconds <=60 ){
			  
			  return "1s";
		  }
		   else if($minutes <= 60){
			   
			   if($minutes==1){
				   
				   return "1m";
				   
			   }else{
				   
				   return "$minutes m"; 
			   }
		   }
		  
		  else if($hours <= 24){
			   
			   if($hours==1){
				   
				   return "1h";
				   
			   }else{
				   
				   return "$hours h"; 
			   }
		   }
		   else if($days <= 7){
			   
			   if($days==1){
				   
				   return "1d";
				   
			   }else{
				   
				   return "$days d"; 
			   }
		   }
		    else if($weeks <= 4.3){
			   
			   if($weeks==1){
				   
				   return "1w";
				   
			   }else{
				   
				   return "$weeks w"; 
			   }
		   }
		    else if($months <= 12){
			   
			   if($months==1){
				   
				   return "1m";
				   
			   }else{
				   
				   return "$months m"; 
			   }
		   }
		    else {
			   
			   if($years==1){
				   
				   return "1y";
				   
			   }else{
				   
				   return "$years y"; 
			   }
		   }
	  }
 
	 
	
	 
 ?>