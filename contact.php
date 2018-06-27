<?php
require_once('php/Database.php');
require_once('php/Credentials.php');

$db = new Db(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

$site_title = $_GET['site_title'];

$query = "select * from User where site_title = ?";
$result = $db->execSql($query, array($site_title), $response);

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
    <header class="headimage" style="background-image: url('images/contact-bg.jpg')">
        <!-- <img src="home-bg.jpg" /> -->
        <div class="overlay"></div>
        <div class="container">
            <!-- <h1 color="white">My Blog</h1> -->
            <div class="site-heading">
                <h1>Contact Me</h1>
                <span class="subheading">Have questions? I have answers.</span>
        </div>

    </header>

    <div class="container">
        <div class="post">

            <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>

            <p style='color:green' id='response'><p>
            <form>
                <!-- <div class="form-group floating-label-form-group controls">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" id="name" required pattern="[A-Za-z ]{1,20}" title="Should contain only letters and spaces(upto 20 characters)">
                  <p class="help-block text-danger"></p>
                </div> -->
                <div class="form-group floating-label-form-group controls">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" id="name" onblur="validateName(name)">
                  <span id="nameError" style="display: none; color: red; padding-top: 10px; padding-bottom: 10px;">You can only use alphabetic characters, hyphens and apostrophes</span>
                </div>

                <div class="form-group floating-label-form-group controls">
                  <label>Email Address</label>
                  <input type="email" name="email" class="form-control" required placeholder="Email Address" id="email" onblur="validateEmail(value)">
                  <span id="emailError" style="display: none; color: red; padding-top: 10px; padding-bottom: 10px;">You must enter a valid email address</span>
                </div>

                <div class="form-group floating-label-form-group controls">
                  <label>Phone Number</label>
                  <input type="text" name="phone" class="form-control" required placeholder="Phone Number" id="phone" onblur="validatePhone(value)">
                  <span id="phoneError" style="display: none; color: red; padding-top: 10px; padding-bottom: 10px;">You must enter a valid phone number of 10 digits only</span>
                </div>

                <div class="form-group floating-label-form-group controls">
                  <label>Message</label>
                  <textarea rows="5" class="form-control" placeholder="Message" required id="message" required data-validation-required-message="Please enter a message."></textarea>
                </div>
                <br />
                <input type="button" class="btn" align="left" value="Send" id='submit' onclick="validateForm()">
                <br />

            </form>

            <!-- <hr /> -->
            <!-- <br />
            <a class="btn" align="left">Send</a>
            <br /> -->
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
    <script>
    function validateName(x){
      // Validation rule
      var re = /^[a-zA-Z ]{2,30}$/;
      // Check input
      if(re.test(document.getElementById(x).value)){
        // Style green
        //document.getElementById(x).style.background ='#ccffcc';
        // Hide error prompt
        document.getElementById(x + 'Error').style.display = "none";
        return true;
      }else{
        // Style red
        //document.getElementById(x).style.background ='#e35152';
        // Show error prompt
        document.getElementById(x + 'Error').style.display = "block";
        return false;
      }
    }

    function validateEmail(email){
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if(re.test(email)){
        //document.getElementById('email').style.background ='#ccffcc';
        document.getElementById('emailError').style.display = "none";
        return true;
      }else{
        //document.getElementById('email').style.background ='#e35152';
        document.getElementById('emailError').style.display = "block";
        return false;
      }
    }

    function validatePhone(phone){
      var re = /^[789]\d{9}$/;
      if(re.test(phone)){
        //document.getElementById('email').style.background ='#ccffcc';
        document.getElementById('phoneError').style.display = "none";
        return true;
      }else{
        //document.getElementById('email').style.background ='#e35152';
        document.getElementById('phoneError').style.display = "block";
        return false;
      }
    }

    function validateForm(){
        var error = 0;
        // Check name
        if(!validateName('name')){
          error++;
        }
        // Validate email
        if(!validateEmail(document.getElementById('email').value)){
          error++;
        }

        if(!validatePhone(document.getElementById('phone').value)){
          error++;
        }

        if(error > 0){
            return false;
        }else{
            console.log("hi");
            var name = $("#name").val();
            var email = $("#email").val();
            var message = $("#message").val();
            var phone = $("#phone").val();
// Returns successful data submission message when the entered information is stored in database.
            var dataString = 'name='+ name + '&email='+ email + '&message='+ message + '&phone='+ phone;
            console.log("hi");
// AJAX Code To Submit Form.
            $.ajax({
                type: "POST",
                url: "ajaxsubmit.php?site_title=<?=$site_title?>",
                data: dataString,
                cache: false,
                success: function(result){
                    $('#response').text(result);
                    // alert(result);
                }
            });
            // return false;
            return true;
        }
    }


    </script>
</body>
</html>
