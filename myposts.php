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
    <title>Posts</title>
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



    <h3>Posts</h3>
    <!-- <button>Delete</button> --> 
    <br><br>


    
    <table>
      <tr>
        <th></th>
        <th>Title</th>
        <th>Subtitle</th>
        <th>Date</th>
      </tr>

    <?php
    $query = "select title,sub_title,Date from Posts where user_id = ?";
    $result = $db->execSql($query, array($user_id), $response);
    
    if(sizeof($response)==0)
    {
      echo '<h2>......................... Sorry no post available !!</h2>';
    }
    for($i = 0; $i < sizeof($response); $i++)
            {
              echo '<tr><td><input type="checkbox" name="usernameSelect"></td>';
              echo '<td>'.$response[$i]['title'].'</td>';
              echo '<td>'.$response[$i]['sub_title'].'</td>';
              echo '<td><br>Published<br><br>'.$response[$i]['Date'].'</td>';

              echo '</tr>';
            }
    ?>

      <!-- <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          Hello World!
        </td>
        <td>Taha</td>
        <td><br>Published<br><br>2017/11/30</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          JavaScript rules!
        </td>
        <td>Tanmay</td>
        <td><br>Published<br><br>2017/11/30</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="usernameSelect"></td>
        <td>
          PICT
        </td>
        <td>Dipak</td>
        <td><br>Published<br><br>2017/11/30</td>
      </tr> -->
    </table>
    <br><br>
    <button style="margin-left:1%">Apply changes</button>
    <p id="left1">Thank you for creating with <em><a href="#">WordPress</a>.<em></p>
    <p id="right1">Version 4.9.1</p>
  </body>
  </body>
