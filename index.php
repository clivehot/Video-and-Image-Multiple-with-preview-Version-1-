<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script src='changeInputText.js'></script>
</head>
<body>
<script type="text/javascript">

	function previewVideo(event) {

		var videofileobj = {};
		videofileobj = event.target.files;
		console.log(videofileobj);
		//Place file into an array so we can manipulate it
		var videofile = [];
		var count = videofileobj.length;
		for (var x=0; x<count; x++) {
             videofile.push(videofileobj[x]);
             var videoname = videofile[x].name;
             console.log(videoname);
             //Split the file name when you come across a .
	         var splitext = videoname.split(".");
	         var ext = splitext.slice(-1)[0];
	         ext = ext.toLowerCase();
	        //console.log(ext);
	    
	    if ( ext == "mp4" ) {
             var previewvideo = "<video width='320' height='240'> <source src='"+URL.createObjectURL(videofile[x])+"' type='video/mp4' ></video>";
		     $("#video-preview").append(previewvideo);
		}        	    
	                                  }
	    
    }

	function clearWarning() {
		$('#video-preview').html("");
	}

	function previewImage(event) {
		var imagefileobj = {};
		imagefileobj = event.target.files;
		console.log(imagefileobj);
		//Place file into an array so we can manipulate it
		var imagefiles = [];
	    //use a for loop to push each file into the array
        var count = imagefileobj.length;
		for (var k=0; k<count; k++) {
             imagefiles.push(imagefileobj[k]);
             var imagename = imagefiles[k].name;
             console.log(imagename);
             //Split the name when you come across a .
             var splitext = imagename.split(".");
             console.log(splitext);
             var ext = splitext.slice(-1)[0];
             ext = ext.toLowerCase();
             console.log(ext);

             if ( ext == "jpg" ) {
		           var previewimage = "<img src='"+URL.createObjectURL(imagefiles[k])+"' width='250' height='250' />";
		           $("#image-preview").append(previewimage);
		     }                               
        } 
     
	}    

    $(document).ready(function(){
	   $('#input-label').inputFileText({
          text: 'Select Video File'
       });
    });

</script>

//create a folder called video for videos to be uploaded 
<?php
if (isset($_REQUEST['upload'])) {
    $name=$_FILES['uploadvideo']['name'];
    $tmp_name=$_FILES['uploadvideo']['tmp_name'];
    $target_path="video/";
    $target_path=$target_path.basename($name);
    move_uploaded_file($_FILES['uploadvideo']['tmp_name'],$target_path);
}
?>
<form enctype="multipart/form-data" method="post" action="">
<input name="MAX_FILE_SIZE" value="100000000000000"  type="hidden"/>
<input type="file" id="input-label" name="uploadvideo" onchange="clearWarning();previewVideo(event);previewImage(event)" multiple />
<input type="submit" name="upload" value="SUBMIT" />
</form>

<div id="video-preview" ><p>Video Files</p></div>
<div id="image-preview" ><p>Images</p></div>

</body>
</html>