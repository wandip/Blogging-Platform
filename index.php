<?php
require_once('php/Database.php');
require_once('php/Credentials.php');
// below line helps establish connection with database
$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
//var_dump($db);

$site_title = $_GET['site_title'];
//echo $site_title;

$query = "select * from User where site_title = ?";
$resut = $db->execSql($query, array($site_title), $response);

 //var_dump($result);

$user_id = $response[0]['user_id'];

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
    <header class="headimage" style="background-image: url('images/home-bg.jpg')">
        <!-- <img src="home-bg.jpg" /> -->
        <div class="overlay"></div>
        <div class="container">
            <!-- <h1 color="white">My Blog</h1> -->
            <div class="site-heading">
                <h1><?= $response[0]['site_title']?></h1>
                <span class="subheading"><?= $response[0]['tagline']?></span>
            </div>

    </header>

    <div class="container">
        <div class="post">
            <?php
            $query = 'select title, sub_title, post_id, Date from Posts where user_id = ?';
            $db->execSql($query, array($user_id), $posts);
            // var_dump($posts);
            for($i = 0; $i < sizeof($posts); $i++){
            ?>
            <div class="post-preview">
                <a href="post.php?site_title=<?=$site_title?>&post_id=<?= $posts[$i]['post_id']?>">
                    <h2 class="post-title"><?=$posts[$i]['title']?>
                </h2>
                    <h3 class="post-subtitle"><?=$posts[$i]['sub_title']?>
                </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#"><?php echo $response[0]['fname']." ".$response[0]['lname'];?></a> on <?=$posts[$i]['Date']?></p>
            </div>
            <?php if($i+1 != sizeof($posts)) {?>
            <hr />
            <?php }
                } ?>

            <!-- <a class="btn" align="right">Older Posts →</a> -->
            <!-- <br /> -->
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
