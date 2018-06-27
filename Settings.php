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
    <title>General Settings</title>
    <meta charset="utf-8">
    <html lang="en-us">
    <link rel="stylesheet" href="css/Settings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" src="js/Login.js"></script>
  </head>
  <body>
    <h3>General Settings</h3>
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
    <p style="margin-left:180px;font-size:12px;color:gray;font-family:Arial">Manage your account here.</p>
    <form name="newform" onsubmit="return func1()" method="post">
    <table>
      <tr>
        <th>Site Title</th>
        <td><input type="text" name="title" value= "<?php echo $site_title?>" ></td>
      </tr>
      <tr>
        <th>Tagline</th>
        <td>
          <input type="text" name="tagline" value= "<?php echo $tagline?>"><br>
          <em>In a few words, explain what this site is about.</em>
        </td>
      </tr>
      <tr>
        <th>Email Address</th>
        <td>
          <input type="email" name="email" value= "<?php echo $email?>"><br>
          <em>This address is used for admin purposes.</em>
        </td>
      </tr>
      <tr>
        <th>Site Language</th>
        <td>
          <select>
            <option value = "english">English(United-States)</option>
          </select>
        </td>
      </tr>
      <tr>
        <th>Login Name</th>
        <td>
          <input type="text" name="name" value= "<?php echo $username?>">
        </td>
      </tr>
      <tr>
        <th>Password</th>
        <td>
          <input type="password" name="passwd1" minlength="8" maxlength="16" required>
        </td>
      </tr>
			<tr>
        <th>Confirm Password</th>
        <td>
          <input type="password" name="passwd2" minlength="8" maxlength="16" required>
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" name="submit" minlength="8" maxlength="16">
        </td>
      </tr>
    </table>
    </form>

    <?php
  if (isset($_POST['submit'])) {
    $query = "replace into User(user_id,fname,lname,email,password,site_title,tagline,username) values (?,?,?,?,?,?,?,?)";
  
$result = $db->updateSql($query, array($user_id,$fname, $lname,$_POST['email'], $_POST['passwd2'],$_POST['title'],$_POST['tagline'], $_POST['name']), $response);
if($result){
    echo "<script>
alert('Settings Updated');
</script>";
  
}
else{
    echo "<script>
alert('Could not Update Settings');
</script>";
  }
}

?>


  </body>
</html>
