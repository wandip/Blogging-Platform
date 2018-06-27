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
    <title>Users</title>
    <meta charset="utf-8">
    <html lang="en-us">
    <link rel="stylesheet" href="css/Users.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>
  <body>
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
    <h3>Users</h3>
    <button>Add new</button>
    <button>Delete</button>
    <br><br>
    <table>
      <tr>
        <th></th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Posts</th>
      </tr>
      <?php
      $query = "select username,fname,lname,email from User where user_id = ?";
    $result = $db->execSql($query, array($user_id), $response);
    
    $query1 = "select count(post_id) as nop from Posts where user_id = ?";
    $result2 = $db->execSql($query1, array($user_id), $response3);
    
    //var_dump($response[1]['title']);

    if(sizeof($response)==0)
    {
      echo '<h2>......................... Sorry Wrong User Bad Request!!</h2>';
    }
    for($i = 0; $i < sizeof($response); $i++)
            {
              echo '<tr><td><input type="checkbox" name="usernameSelect"></td>';
              echo '<td>'.$response[$i]['username'].'</td>';
              echo '<td>'.$response[$i]['fname'].' '.$response[$i]['lname'].'</td>';
              echo '<td>'.$response[$i]['email'].'</td>';
               echo '<td>'.$response3[0]['nop'].'</td>';
              echo '</tr>';
            }
    ?>

      <!-- <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          tahakothawala
        </td>
        <td>Taha</td>
        <td>tahakothawala5253@gmail.com</td>
        <td>Administrator</td>
        <td>2</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          tanmay98
        </td>
        <td>Tanmay</td>
        <td>tanmaysinghal98@gmail.com</td>
        <td>Administrator</td>
        <td>1</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          dipak_202
        </td>
        <td>Dipak</td>
        <td>dipakwani201@gmail.com</td>
        <td>Administrator</td>
        <td>3</td>
      </tr> -->
    </table>
    <br><br>
    <button style="margin-left:1%">Apply changes</button>
    <p id="left1">Thank you for creating with <em><a href="#">WordPress</a>.<em></p>
  </body>
</html>
