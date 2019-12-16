
<!DOCTYPE html>
<html>
<head>

 <title>Instagram Upload Post</title>
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!----add icon link----> 
  
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
   <!----add jquery link----> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
 <style>
    *{
	  margin:0;
	  padding:0;
  }
  body{
	  margin:0;
	  
  }
  .upload-top{
	  
	  width:100%;
	  max-width:768px;
	  margin:auto;
	  top:0;
	  position:fixed;
	   
  }
  .upload-top ul{
	  
	  list-style-type:none;
	  margin:0;
	  padding:0;
	  overflow:hidden;
	  height:50px;
	  background-color:#f0f0f0;
	  
  }
  
  .upload-start{
	  float:left;
	  width:70%;
	  
  }
  .upload-end{
	  float:right;
	  width:30%;
	  
  }
 .upload-start a{
	 
	  display:block;
	  text-decoration:none;
	  text-align:start;
	  margin-left:20px;
	  line-height:50px;
	  cursor:pointer;
	  font-size:17px;
	 
  }
  .upload-end a{
	 
	  display:block;
	  text-decoration:none;
	  text-align:center;
	  line-height:50px;
	  cursor:pointer;
	  font-size:17px;
	 
  }
  .upload-container{
	  
	  width:100%;
	  max-width:768px;
	  margin:auto;
	  margin-top:70px;
	  }
  .upload-image-container{
	  
	  width:100%;
	  max-width:300px;
	  height:300px;
	  margin:auto;
	 
  }
  .upload-image-container img{
	
	width:100%;
	height:100%; 
    border:1px solid #ccc;
  }
   span input[type=file]{
		 
		 opacity:0;
	 }
	 
	 input[type=text]{
		  
		  width:100%;
		  padding:8px;
		  margin:6px 0;
		  display:inline-block;
		  box-sizing:border-box;
		  font-size:14px;
		  border:none;
		  background-color:white;
		  
	  }
	 h6{
		
     text-align:center;
     font-size:14px;
     color:red;	
		 
	 }
  
</style>
</head>
<body>
  
	  
   <div class="upload-top">
   
    
   <ul>
    <li class="upload-start"><a><b>Share To</b></a></li>
	
    <li class="upload-end"><a style="color:#3897f0;"  id="form_submit" ><b>Share</b></a></li>
   
   </ul>
   
  </div>
  
   <div class="upload-container">
   
       <a id="message"><a/> 
			  
      <div class="upload-image-container">
	  
	   <img src="icon/placeholder-image.png" class="select_images" id="profileImage" />
	   
	     <span>
			   
			    <input type="file" name="image" id="inputFile" onchange="readUrls(this);" accept="image/*"></input>
			     
	    </span>
			 
	    <input type="text" name="caption" id="caption" placeholder="Write a caption..." ></input>
					
	  </div>
   
   
   </div>
  
	
 <script >
 
	$(document).ready(function(){
		
	 $('.select_images').on('click', function(e){
		   
		   e.preventDefault();
		   
          $('#inputFile').trigger('click');	
		   
		  // alert('ok');
	   });
	  
		   
	});    

  function readUrls(input){
			
			if(input.files && input.files[0]){
				
				var reader = new FileReader();
				
				reader.onload = function(e){
					
					 $('#profileImage').attr('src', e.target.result);
					
				};
				
				reader.readAsDataURL(input.files[0]);
				
			}
			
			
		}
			
 </script>
    
</body>
</html> 