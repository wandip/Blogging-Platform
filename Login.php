<?php
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
?>

<!DOCTYPE html>
 <html>
  <head>
    <title>Welcome!</title>
    <html lang = "en-us">
    <meta charset = "utf-8">
    <link rel="stylesheet" href="css/Login.css">
    <script type="text/javascript" src="js/Login.js"></script>
  </head>
  <body>

    <h1>Welcome to WordPress!</h1>
    <div class="log">
      <div class="login">
      <form method="post">
        <h3>Login</h3>
        <input type="email" name="email" placeholder = "Email" required>
        <br><br>
        <input type="password" name="password" placeholder="Password" minlength="8" maxlength="15" required>
        <br><br>
        <input type="submit" name="login_submit" value="Login">
      </form>
      <a href="ForgotPassword.html">Lost your password?</a>
      </div>
    </div>

    <div class="reg">
      <div class="register">
      <form name="register_form" onsubmit="return myFunction()" method="post">
        <h3>Register</h3>
        <input type="text" name="fname" placeholder = "First Name" required>
        <br><br>
        <input type="text" name="lname" placeholder = "Last Name" required>
        <br><br>
        <input type="email" name="email2" placeholder = "Email" required>
        <br><br>
        <input type="password" name="password2" minlength="8" maxlength="15" placeholder="Password" required>
        <br><br>
        <input type="password" name="password3" minlength="8" maxlength="15" placeholder="Confirm Password" required>
        <br><br>
        <input type="submit" name="reg_submit" value="Register">
      </form>
    </div>
  </div>
<?php
  if (isset($_POST['reg_submit'])) {
    $query = "insert into User(fname,lname,email,password,site_title,tagline,username) values (?,?,?,?,?,?,?)";
    $first = $_POST['fname'];
    $lastname = $_POST['lname'];
  
$result = $db->updateSql($query, array($_POST['fname'], $_POST['lname'],$_POST['email2'], $_POST['password2'],$first."sBLog","Give your site an attractive tagline !", $first.$lastname), $response);
if($result){
    echo "User Registered";
}
else{
    echo "Unable to Register";
}

} else if (isset($_POST['login_submit'])) {
  
    $query = "select user_id,password from User where email = ?";
    $emm = $_POST['email'];
    
  $resut1 = $db->execSql($query, array($emm), $response);
  
  $passwordfromserver = $response[0]['password'];
  if($passwordfromserver==$_POST['password'])
  {
    $user_id = $response[0]['user_id'];
    header("Location:http://localhost/Blog/Settings.php?user_id=".$user_id);
    exit();
  } 
  else
  {
    echo "<script>
alert('Incorrect Password');
</script>";
  }
  // var_dump($result);

  

} else {
    //no button pressed
}
?>
  </body>
 </html>
