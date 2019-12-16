$(document).ready(function(){
	
	var user_push, pushing, push = false;
		
		//home main tabs
		
		$(".tab").click(function(){
			
			$(".tab").removeClass("active");
			
			$(this).addClass("active");
			
			var contentId = $(this).attr("href");
			
			if(!push)
				
			history.pushState({}, '', contentId);
		   
		    $(".container").removeClass("actives");
			
			$('.container[id="'+contentId+'"]').addClass("actives");
			
		    push = false;
				
			return false;
			
		
		}); 
		
		//backpress home tabs
	  
	   $(window).on("popstate", function(e) {
		  
         e.preventDefault();
		 
		 push = true;
		 
		var prevTabs = (window.location.href.indexOf("/") > -1) ? window.location.href.split("/").pop() : false;
			
		if(prevTabs == 'instagram.php') {
					
	 	$('mainTab, ul li a[href="Home"]').click();
				
				
		} else {
				
		$('mainTab, ul li a[href="'+prevTabs+'"]').click();
				
			
		}
					
	 });
		
		//profile main tabs
		
		 $(".profile-tab").click(function(){
			
			$(".profile-tab").removeClass("profile-active");
			
			$(this).addClass("profile-active");
		
			var contentId = $(this).attr("href");
			
			if(!pushing)
				
			history.pushState({}, '', contentId);
		   
			var contentId = contentId.substr(1);
			
		    $(".profile-container-inside").removeClass("profile-actives");
			
			$('.profile-container-inside[id="'+contentId+'"]').addClass("profile-actives");
			
		    pushing = false;
				
			return false;
		
			
		}); 
		
		//backpress profile tabs
		
		$(window).bind("popstate", function(e) {
			
		  e.preventDefault();
		  
		 pushing = true;
		 
		var prevTab = (window.location.href.indexOf("#") > -1) ? window.location.href.split("#").pop() : false;
			
		
		if(prevTab == false) {
					
	 	   $(' ul li a[href="#grid"]').click();
				
				
		} else {
				
				
		  $('ul li a[href="#'+prevTab+'"]').click();
			
		}
		
		if(prevTab == false) {
					
	 	   $('.profile-grid-container').hide();
			
		   $(".profile-main-container").css("overflow-y", "scroll");
				
				
		}
		
		if(prevTab == false) {
					
	 	   $('.comment-home-conatiner').hide();		
				
		}
		
		if(prevTab == 'profile-grid') {
					
	 	   $('.profile-grid-container').show();	
		   
		   $('.comment-home-conatiner').hide();		
				
		}
		if(prevTab == false) {
					
	 	   $('.edit-profile-container').hide();
			
		}
		  
	 }); 
	 
	 // profile details
	 
	 fetch_profile();
		
		function fetch_profile()
	   
	   {
		   
		  var action = 'fetch_profile'; 
		   
		   $.ajax({
			   
			   url:"instagram_profile_action.php",
			   
			   method:"post",
			   
			   data:{action_profile:action},
			   
			   success:function(data){
				   
				  $('.container-profile').html(data);
				  
				  
			   }
		   });
	   }
	   
	   //profile menu logout
	   
	   $(document).on('click', '.menu', function(e){
		   
		   e.preventDefault();
		   
		  $('.profile-main-menu').toggle();
			  
	    });
	   
	   //fetch profile grid post
		
		 fetch_grid_post();
		 
		  function fetch_grid_post()
	   
	   {
		   
		  var action = 'fetch_grid_post'; 
		   
		   $.ajax({
			   
			   url:"instagram_profile_action.php",
			   
			   method:"post",
			   
			   data:{action_profile_grid_post:action},
			   
			   success:function(data){
				   
				   $('.grid-main-container').html(data);
			   }
		   });
	   }
	   
	    //fetch profile single post
	   
	   
	    $(document).on('click', '.grid_button', function(){
			
			var postId = $(this).data('post_id');
			
			var action = $(this).data('action');
		
		    var href = $(this).attr('href');
		 
		   fetch_single_post(postId);
		   
		    $('.profile-grid-container').show();
			
			$(".profile-main-container").css("overflow-y", "hidden");
			
			history.pushState({}, '', href);
		   
		 
		  
	   
	   });
	   
	   
	    function fetch_single_post(postId)
	   
	   {
		   var action = 'fetch_single_post';  
		   
		   $.ajax({
			   
			   url:"instagram_profile_action.php",
			   
			   method:"post",
			   
			   data:{action_profile_grid_single_post:action, post_id:postId},
			   
			   success:function(data){
				   
				   $('.grid-profile-container').html(data);
			   }
		   });
	   }
	   
	   //close grid post 
	   
	    $('.profile-grid-close').on('click', function(e){
		   
		   e.preventDefault();
		   
		  window.history.back();
			  
		 
	     });
		
		//fetch profile list post
		
		fetch_list_post();
		 
		  function fetch_list_post()
	   
	   {
		   
		  var action = 'fetch_list_post'; 
		   
		   $.ajax({
			   
			   url:"instagram_profile_action.php",
			   
			   method:"post",
			   
			   data:{action_list_post:action},
			   
			   success:function(data){
				   
				   $('.profile-container-list').html(data);
			   }
		   });
	   }
	   
	   
	   //fetch home post
	     
		 fetch_post();
	   
	     function fetch_post()
	   
	   {
		   
		  var action = 'fetch_post'; 
		   
		   $.ajax({
			   
			   url:"instagram_action.php",
			   
			   method:"post",
			   
			   data:{action_home_post:action},
			   
			   success:function(data){
				   
				   $('.home-main-container').html(data);
			   }
		   });
	   }
		
		
		 //click like post
	   
	    $(document).on('click', '.like_button', function(){
			
			var postId = $(this).data('post_id');
			
			var userId = $(this).data('user_id');
			
			var postlike = $(this).data('action');
			
			
			$.ajax({
			   
			   url:"instagram_action.php",
			   
			   method:"post",
			   
			   data:{action_like:postlike, user_id:userId, post_id:postId},
			   
			   success:function(data){
				   
				   fetch_post();
				   
				   
			   }
		   });
			
			
		});
		
		
		//comments details
		 
		$(document).on('click', '.comment_button', function(e){
			
			e.preventDefault();
			
			var postId = $(this).data('post_id');
			
			var userId = $(this).data('user_id');
		
			var userImage = $(this).data('user_image');
			
			var href = $(this).attr('href');
			
			history.pushState({}, '', href);
			
			$('.comment-home-conatiner').show();
			
			insert_comment(userId, postId);
			
			fetch_comment(userId, postId );
			
			fetch_caption(postId );
			
			fetch_single_post(postId);
			
			fetch_grid_post();
			
			fetch_list_post();
			
		});
		
		
		function insert_comment(userId, postId){
			
			$('#comment_form').unbind('submit').bind('submit', function(e){
		   
		   e.preventDefault();
		   
		   var action = $(this).data('action');
		   
			
		   var postComment = $('#insert_comment').val();
			
	
		   $.ajax({
			   
			   url:"instagram_action.php",
			   
			   method:"post",
			   
			   data:{action:action, post_comment:postComment,  post_id:postId},
			   
			   success:function(data){
				   
				   $('#comment_form')[0].reset();
				  
				 
			      fetch_comment(userId, postId );
				
		          fetch_post();
				   
				  fetch_grid_post();
		   
		          fetch_list_post();
				  
			   }
		   });
		    
	   });
	   
	   
		}
    
	 function fetch_comment(userId, postId )
	   
	   {
		   
		  var action = 'fetch_comment'; 
		   
		   $.ajax({
			   
			   url:"instagram_action.php",
			   
			   method:"post",
			   
			   data:{action_comment:action, user_id:userId, post_id:postId},
			   
			   success:function(data){
				   
				   $('.comment-comment-container').html(data);
				   
			      
				   
				   user_post(postId);
		    
			       user_grid_post(postId);
		    
		 
			   }
		   });
	   }
	   
	   
	    function fetch_caption(postId )
	   
	   {
		   
		  var action = 'fetch_caption'; 
		   
		   $.ajax({
			   
			   url:"instagram_action.php",
			   
			   method:"post",
			   
			   data:{action_caption:action, post_id:postId},
			   
			   success:function(data){
				   
				   $('.comment-post-container').html(data);
				   
			 
			   }
		   });
	   }
	   
	   //close comment
	  
	  $('.comment-close').on('click', function(e){
		   
		   e.preventDefault();
		   
		  window.history.back();
			  
		 
	     });
		
	//users follow details


     $(".user-tab").click(function(){
		    
			  $(".user-tab").removeClass("activate");
			  
		       $(this).addClass("activate");
			
			   $(".user-container").removeClass("user-active");
			 
			   var userId = $(this).attr("containerIds");
			   
			   $("#"+userId).addClass("user-active");
	     });
		 
		 
		   fetch_user();
		 
	   function fetch_user()
	   
	   {
		   
		  var action = 'fetch_user'; 
		   
		   $.ajax({
			   
			   url:"instagram_follow_action.php",
			   
			   method:"post",
			   
			   data:{action_user:action},
			   
			   success:function(data){
				   
				   $('.user-follow-container').html(data);
			   }
		   });
	   }
	   
	    $(document).on('click', '.follow_button', function(){
			
			var followId = $(this).data('user_follow');
			
			var userId = $(this).data('user_id');
			
			var follow = $(this).data('action');
			
			
			$.ajax({
			   
			   url:"instagram_follow_action.php",
			   
			   method:"post",
			   
			   data:{action_follow:follow, user_id:userId, follow_id:followId},
			   
			   success:function(data){
				   
				   fetch_user();
				   
				   fetch_post(); 
				   
				   fetch_profile();
			   }
		   });
			
			
		});
		
		
		// search users details  
		
		
		 $('#search_text').keyup(function(){
	  
	      var search = $(this).val();
		  
		   if(search != ''){
			   
			    search_user(search);
		 
			   
		   }else{
			   
			    search_user();
		 
		   }
			
	
	    });
		
		
		 
	   function search_user(search)
	   
	   {
		    
		   $.ajax({
			   
			   url:"instagram_search_action.php",
			   
			   method:"post",
			   
			   data:{search:search},
			   
			   success:function(data){
				   
				   $('.user-search-container').html(data);
			   }
		   });
	   }
	   
	   
	    $(document).on('click', '.user_follow_button', function(){
			
			var followId = $(this).data('user_follow');
			
			var userId = $(this).data('user_id');
			
			var follow = $(this).data('action');
			
			var search = $(this).data('search');
			
			
			$.ajax({
			   
			   url:"instagram_search_action.php",
			   
			   method:"post",
			   
			   data:{action_follow:follow, user_id:userId, follow_id:followId},
			   
			   success:function(data){
				   
				   search_user(search);
				   
				   fetch_post();
				   
				   fetch_user();
				   
				   fetch_profile();
			   }
		   });
			
			
		});
	   
	   
	   //upload post
	   
	 $('#form_submit').click(function(){ 
		
           var caption = $('#caption').val(); 
		   
		   var file_field = $('#inputFile').val(); 
		   
		  // alert(file_field)
		   
		   if(file_field == '' || caption == '')  
           {  
	   
             $('#message').html("Plss select post or Caption"); 
			 
			 $('#message').css({'color':'red', 'marginLeft':'30%', 'marginBottom':'10px'});
			 
           } 		   
           else  
           {  
	   
		    var file = document.getElementById("inputFile").files[0];
			
			var form_data = new FormData();
			
			form_data.append("upload_file", file);
			
			form_data.append("caption", caption);
			
		   
		  $.ajax({
			  
            url:"instagram_upload_action.php",
           
 		    method:"post",
			
            data: form_data,
		   
           contentType: false,
          
		   cache: false,
          
		   processData: false,
       
           success:function(data){
			   
		   $('ul li a[href="Home"]').click();
		   
		   fetch_post();
		   
		   fetch_grid_post();
		   
		   fetch_list_post();
		   
		   fetch_profile();
		
           }
        
		});
			
	  }
	  
	  });  

	//edit profile
	
	$(document).on('click', '.edit_profile_button', function(){
			
         
		 $('.edit-profile-container').show();
		 
		 
		   var editId = $(this).attr("href");
				
			history.pushState({}, '', editId);
		   
		   
		 return false;

   	   });
	   
	
	  $('#edit_submit').click(function(){ 
		
		    var edit_file = $('#input_file').val(); 
		   
		    var editFullname = $('#edit_fullname').val(); 
		   
		    var editUsername = $('#edit_username').val(); 
		   
		    var editWebsite = $('#edit_website').val(); 
		   
		    var editBio = $('#edit_bio').val(); 
		   
		    var editEmail = $('#edit_email').val(); 
		   
		    var editPhonenumber = $('#edit_phonenumber').val(); 
			
			var editGender = $('#edit_gender').val(); 
		   
		   
		  // alert(file_field)
		   
		   if(edit_file == '' || editFullname == '' || editUsername == '' || editWebsite == '' 
		   
		   || editBio == '' || editEmail == '' || editPhonenumber == '' || editGender == '')  
           {  
	   
             $('#messages').html("Plss fill all the fields.."); 
			 
			 $('#messages').css({'color':'red', 'marginLeft':'30%', 'marginBottom':'10px'});
			 
           } 		   
           else  
           {  
	   
		    var file = document.getElementById("input_file").files[0];
			
			var form_edit_data = new FormData();
			
			form_edit_data.append("edit_file", file);
			
			form_edit_data.append("fullname", editFullname);
			
		    form_edit_data.append("username", editUsername);
			
			form_edit_data.append("website", editWebsite);
			
			form_edit_data.append("bio", editBio);
			
			form_edit_data.append("email", editEmail);
			
			form_edit_data.append("phonenumber", editPhonenumber);
			
			form_edit_data.append("gender", editGender);
			
			
		  $.ajax({
			  
            url:"instagram_edit_action.php",
           
 		    method:"post",
			
            data: form_edit_data,
		   
           contentType: false,
          
		   cache: false,
          
		   processData: false,
       
           success:function(data){
			   
		   //$('ul li a[href="Profile"]').click();
		   
		    $('.edit-profile-container').hide();
			
			$('#edit_website').val(''); 
			
			$('#edit_bio').val(''); 
		   
		    $('#edit_phonenumber').val(''); 
			
		    $('#edit_gender').val(''); 
		   
			
		    history.go(-1);
			
			 fetch_profile();
	      
			 fetch_post();
           }
        
		});
			
	  }
	  
	  });  
	  
	  //close edit profile
	  
	  $('.edit-close').on('click', function(e){
		   
		   e.preventDefault();
		   
		  window.history.back();
			 
		 
	     });

	
	//user profile details
	
	
		
		
 }); 		