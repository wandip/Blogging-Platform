<?php
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

$site_title = $_GET['site_title'];

$query = "select * from User where site_title = ?";
$result = $db->execSql($query, array($site_title), $response);

$user_id = $response[0]['user_id'];

$query = "select * from About_Me where user_id = ?";
$result = $db->execSql($query, array($user_id), $about);

$about = $about[0];

$array = explode("\n", $about['content']);

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Blog</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700,300" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    <nav>
        <div class="container">
            <a class="navbar-brand" href="index.php?site_title=<?= $response[0]['site_title']?>"><?= $response[0]['site_title']?></a>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="index.php?site_title=<?= $response[0]['site_title']?>">Home</a></li>
                <li class="nav-item"><a href="about.php?site_title=<?= $response[0]['site_title']?>">About</a></li>
                <li class="nav-item"><a href="contact.php?site_title=<?= $response[0]['site_title']?>">Contact</a></li>
            </ul>
        </div>

    </nav>
    <header class="headimage" style="background-image: url('images/<?=$about['image']?>.jpg')">
        <!-- <img src="home-bg.jpg" /> -->
        <div class="overlay"></div>
        <div class="container">
            <!-- <h1 color="white">My Blog</h1> -->
            <div class="site-heading">
                <h1><?=$about['title']?></h1>
                <span class="subheading"><?=$about['sub_title']?></span>
        </div>

    </header>

    <div class="container">
        <div class="post">
            <?php for($i = 0; $i < sizeof($array); $i++){
                if(substr($array[$i], 0, 3) === "[h]"){
                    $array[$i] = substr($array[$i], 3);
                    $array[$i] = substr($array[$i], 0, -4);
                    echo "<h2 class='section-heading'>".$array[$i]."</h2>";
                }
                else if(substr($array[$i], 0, 3) === "[q]"){
                    $array[$i] = substr($array[$i], 3);
                    $array[$i] = substr($array[$i], 0, -4);
                    echo "<blockquote class='blockquote'>".$array[$i]."</blockquote>";
                }
                else if(substr($array[$i], 0, 3) === "[i]"){
                    $array[$i] = substr($array[$i], 3);
                    $array[$i] = substr($array[$i], 0, -4);
                    // echo "<blockquote class='blockquote'>".$array[$i]."</blockquote>";
                    echo "<img class='img-fluid' src='images/".$array[$i].".jpg' alt=''>";
                }
                else if(substr($array[$i], 0, 3) === "[c]"){
                    $array[$i] = substr($array[$i], 3);
                    $array[$i] = substr($array[$i], 0, -4);
                    echo "<span class='caption text-muted'>".$array[$i]."</span>";
                }
                else if(strpos($array[$i], '[/l]') !== false){
                    // echo "hi";
                    $array[$i] = str_replace("[/l]","</a>",$array[$i]);
                    $array[$i] = str_replace("]","' style='color:black;'>",$array[$i]);
                    $array[$i] = str_replace("[l","<a href='",$array[$i]);
                    echo "<p>".$array[$i]."</p>";
                }
                else{
                    echo "<p>".$array[$i]."</p>";
                }
            }
             ?>
        </div>
    </div>
    <hr />




    <footer>
        <div class="container">
            <div class="post">
                <p class="copyright">Copyright &copy; <?= $response[0]['site_title']?> 2018</p>
            </div>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/scroll.js"></script>
</body>
</html>
