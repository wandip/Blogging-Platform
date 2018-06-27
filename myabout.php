<?php
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

$user_id = $_GET['user_id'];

$query = "select * from User where user_id = ?";
$result = $db->execSql($query, array($user_id), $response);

$fname = $response[0]['fname'];
$lname = $response[0]['lname'];
$email = $response[0]['email'];
$site_title = $response[0]['site_title'];
$tagline = $response[0]['tagline'];
$username = $response[0]['username'];
  
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title>Add post</title>
<script>
$(document).ready(function(){
    $(".hide").click(function(){
        $(".ex").toggle("slow");
    });
});
</script>

<meta charset="utf-8">
    <html lang="en-us">
    <link rel="stylesheet" href="css/Settings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>

#myBtn {
	position: fixed;
	bottom: 20px;
	right: 20px;
	z-index: 99;
	border: none;
	outline: none;
	background-color: #111;
	color: white;
	cursor: pointer;
	padding: 9px;
	border-radius: 15px;
	display: none;
}

#myBtn:hover {
	background-color: red;
}

.imageinstruction:hover{
	cursor: pointer;
}


textarea{
	min-height: 300px;
	width: 80%;
	border: 1px solid;
	outline: none;
	padding: 15px;
	margin-bottom: 20px;
	position: relative;
}

input[type=text]{
	padding-left: 15px;
	width: 80%;
	height: 35px;
	border: 1px solid #2E3641;
	display: inline-block;			
	outline: none;
	font-size: 24px;
	color: #2E3641;
	margin-bottom: 20px;
}

input[type=submit]{
	text-align: center;
	vertical-align: middle;
	width : 15%;
	margin-right: 10px;
}

input[type=button]{
	text-align: center;
	vertical-align: middle;
	width : 15%;
	margin-left: 10px;
	background: #008ec2;
  border-color: #006799;
  color: #fff;
  height: 2.3em;
}

input:hover[type="button"] {
    color: #008ec2;
    background-color: #ffffff;
}
.formfield * {
  vertical-align: middle;
}

</style>


<head>
<body>
<h3>Edit 'About Me' Page</h3>
    <div class="sidenav">
      <a href="#"><i class="material-icons">dashboard</i> Dashboard</a>
      <a href="http://localhost/Blog/myposts.php?user_id=<?php echo $user_id?>"><i class="material-icons">edit</i> Manage Posts</a>
      <a href="http://localhost/Blog/myabout.php?user_id=<?php echo $user_id?>"><i class="material-icons">content_copy</i> Edit 'About Me'</a>
      <a href="http://localhost/Blog/users.php?user_id=<?php echo $user_id?>"><i class="material-icons">person</i> Users Info</a>
      <a href="http://localhost/Blog/Settings.php?user_id=<?php echo $user_id?>"><i class="material-icons">settings</i> Settings</a>
      <a href="http://localhost/Blog/Login.php"><i class="material-icons">exit_to_app</i> Log Out</a>
    </div>
    <div class="topnav">  
      <a href="http://localhost/Blog/index.php?site_title=<?php echo $site_title?>"><i class="material-icons">home</i> My Blog</a>
      <a href="http://localhost/Blog/newPost.php?user_id=<?php echo $user_id?>"><i class="material-icons">loupe</i> New</a>
      <p style="margin-left: 85%"><i class="material-icons">account_circle</i>Hello, <?php echo $fname?>!</p>
    </div>
    

<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>



<center>

<form id="myForm" style = "margin-left: 180px;" onsubmit=" return finalcheck()" enctype="multipart/form-data" method="POST">


<label for="title">Title(*) : </label>
<input type = text id="title" name="title" placeholder="Enter title here" required maxlength="25">
<br>
<label for="subtitle">Tagline :</label>
<input type = text id="subtitle" name="subtitle" placeholder="Enter tagline here" required >



	
<br>
<br>

<p class="formfield">
<label style=" vertical-align: top;" for="postt"> Content(*) :</label>

<textarea placeholder="Write about yourself..." id="postt" name="content" required></textarea>
</p>

	



<p>
<center>
<input type="submit" value="Post !" name="postbutton" > 
<input type="button" value="Reset" onclick="resetFunction()" >

<p>
<a href = "tips_frames.html">Check out new post for effective blog writing in our BLOG WRITING AIDS</a></p>

<p>Note : (*) means compulsory</p>
<p>Note : (#) <a onclick="ImageInstruction()" class="imageinstruction"> <u> Instructions to upload Image </u></a></p>

<p>Happy Blogging !</p>

</div>
</center>
</form>

	

	
</center>


<?php
  if (isset($_POST['postbutton'])) {
    $query = "insert into About_Me(user_id,title,sub_title,content) values (?,?,?,?)";
    echo $_POST['title'];
    echo $_POST['subtitle'];
$result = $db->updateSql($query, array($user_id, $_POST['title'],$_POST['subtitle'], $_POST['content']), $response);
if($result){
    echo "Succesfully Posted";var_dump($result);
    echo "<script>alert('posted');</script>";
      var_dump($response);
}
else{
    echo "<script>alert('error:could not update');</script>";
}

} 
  
 else {
    //no button pressed
}
?>

<script>

function resetFunction() {
	document.getElementById("myForm").reset();
	topFunction();
}


function ImageInstruction()
{
	alert("1. Image : JPEG/PNG/JPG \n2. Maximum file size = 2 MB");
}
function cancelFunction() {

    var r = confirm("Discard Post?");
    if (r == true) {
        document.getElementById("myForm").reset();
	topFunction();
    } 
}

function NewFunction() {
    var r = confirm("Discard Current Post?");
    if (r == true) {
        document.getElementById("myForm").reset();
	topFunction();
    } 
}

function checkIfImage()
{
	var x = document.getElementById("myFile");
	if (x.files.length == 0) {
            alert( "Please Select Image");
        }

	var file = x.files[0];

	var FileSize = file.size / 1024 / 1024; // in MB
        if (FileSize > 2) {
            alert('File size exceeds 2 MB');
           document.getElementById("myFile").value = "";
        } else {

var fileType = file["type"];
	var ValidImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
	if ($.inArray(fileType, ValidImageTypes) < 0) {
			document.getElementById("myFile").value = "";
	     alert("Invalid File type!\n Please select JPEG/PNG/JPG");
	}
	else
	{
		alert("File uploaded");
	}
	
        }

	
}

function addattr()
{
	var dd = document.getElementById("hlink");
	if(dd.hasAttribute("required"))
		dd.removeAttribute("required");
	else
		dd.setAttribute("required","");
}

function finalcheck()
{

	

    var dd = document.getElementById("hlink");
	if(dd.hasAttribute("required"))
	{
	
	var d = document.getElementById("hlink");
	var inp = d.value;
	var res = inp.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if(res == null){
        alert("URL is not correct !!\nPlease enter a valid URL");
        return false;
    }
    else
        return true;

	}
	else
		return true;

}

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	document.getElementById("myBtn").style.display = "block";
	} else {
	document.getElementById("myBtn").style.display = "none";
	}
}


function topFunction() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
}

</script>



</body>
</html>
