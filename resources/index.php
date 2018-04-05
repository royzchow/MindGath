<html>
<head>
  <script src="//malsup.github.com/jquery.form.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<title>jQuery AJAX Image Upload</title>
<style>
body {font-family: calibri;}
.bgColor {
    max-width: 440px;
    height: 400px;
    background-color: #c3e8cb;
    padding: 30px;
    border-radius: 4px;
	text-align: center;
}
#targetOuter{
	position:relative;
    text-align: center;
    background-color: #F0E8E0;
    margin: 20px auto;
    width: 200px;
    height: 200px;
	border-radius: 4px;
}
.btnSubmit {
    background-color: #565656;
    border-radius: 4px;
    padding: 10px;
    border: #333 1px solid;
    color: #FFFFFF;
    width: 200px;
	cursor:pointer;
}
.inputFile {
    padding: 5px 0px;
	margin-top:8px;
    background-color: #FFFFFF;
    width: 48px;
    overflow: hidden;
	opacity: 0;
	cursor:pointer;
}
.icon-choose-image {
    position: absolute;
    opacity: 0.1;
    top: 50%;
    left: 50%;
    margin-top: -24px;
    margin-left: -24px;
    width: 48px;
    height: 48px;
}
.upload-preview {border-radius:4px;}
#body-overlay {background-color: rgba(0, 0, 0, 0.6);z-index: 999;position: absolute;left: 0;top: 0;width: 100%;height: 100%;display: none;}
#body-overlay div {position:absolute;left:50%;top:50%;margin-top:-32px;margin-left:-32px;}

</style>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
function showPreview(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
			$("#targetLayer").css('opacity','0.7');
			$(".icon-choose-image").css('opacity','0.5');
        }
		fileReader.readAsDataURL(objFileInput.files[0]);
    }
}

$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			beforeSend: function(){$("#body-overlay").show();},
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
			$("#targetLayer").css('opacity','1');
			setInterval(function() {$("#body-overlay").hide(); },500);
			},
		  	error: function()
	    	{
	    	}
	   });
	}));
});
</script>
</head>
<body>
<div id="body-overlay"><div><img src="loading.gif" width="64px" height="64px"/></div></div>
<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<div id="targetOuter">
	<div id="targetLayer"></div>
	<img src="photo.png"  class="icon-choose-image" />
	<div class="icon-choose-image" >
	<input name="userImage" id="userImage" type="file" class="inputFile" onChange="showPreview(this);" />
	</div>
</div>
<div>
<input type="submit" value="Upload Photo" class="btnSubmit" />
</form>
</div>
</div>
</body>
</html>
