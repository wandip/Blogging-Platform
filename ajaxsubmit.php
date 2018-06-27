<?php
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
// var_dump($db);

$site_title = $_GET['site_title'];
// echo $site_title;

$query = "select * from User where site_title = ?";
$resut = $db->execSql($query, array($site_title), $response);

// var_dump($result);

$user_id = $response[0]['user_id'];

$query = "insert into Contact values (?,?,?,?,?)";
$result = $db->updateSql($query, array($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'], $user_id), $response);
if($result){
    echo "Feedback Submitted";
}
else{
    echo "Unable to Submit feedback";
}

 ?>
