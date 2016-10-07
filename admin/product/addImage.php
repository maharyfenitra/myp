
<?php 
  $pd_id=$_GET['pd_id'];
?>
<link href="https://rawgithub.com/hayageek/jquery-upload-file/master/css/uploadfile.css" rel="stylesheet">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://rawgithub.com/hayageek/jquery-upload-file/master/js/jquery.uploadfile.min.js"></script>

<div id="mulitplefileuploader">Upload</div>

<div id="status"></div>
<script>

$(document).ready(function()
{

var settings = {
	url: "/php_includes/get_files.php?pd_id=<? echo $pd_id;?>",
	method: "POST", 
	allowedTypes:"jpg,png,gif,jpeg",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='gray'>Upload is success</font>");
		
	},
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>

