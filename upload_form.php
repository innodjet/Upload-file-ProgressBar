<!DOCTYPE html>
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<script>
function _(ol){
	return document.getElementById(ol);
}
function uploadFile(){
	var file = _("file1").files[0];
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event){
	_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.round(percent);
	progressBar.style.width = Math.round(percent)+"%";
	_("status").innerHTML = Math.round(percent)+"%";

}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 100;
	_("status").innerHTML = "100%";
	progressBar.style.width = "100%";
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}
</script>
</head>
<body>
</br>
</br>
<input type="file" name="file1" id="file1"><br>
<input type="button" value="Upload File" onclick="uploadFile()">
<br/> 
<div class="progress"> 
    <div class="progress-bar progress-bar-primary" id="progressBar" style="width:0%;"><span id="status"></span></div>
</div>
<br/>
<h3 id="status"></h3>
<p id="loaded_n_total"></p>
<br/>
</body>
</html>
