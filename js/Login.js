function myFunction()
{
  var first = document.forms["register_form"]["fname"].value;
  var last = document.forms["register_form"]["lname"].value;
  var pass = document.forms["register_form"]["password2"].value;
  var cpass = document.forms["register_form"]["password3"].value;

  if(first.includes("1") || first.includes("2") || first.includes("3") || first.includes("4") ||
  first.includes("5") || first.includes("7") || first.includes("9") || first.includes("0") ||
  first.includes("6") || first.includes("8")) {
    alert("Number is not allowed in first name!");
  }
  if(last.includes("1") || last.includes("2") || last.includes("3") || last.includes("4") ||
  last.includes("5") || last.includes("7") || last.includes("9") || last.includes("0") ||
  last.includes("6") || last.includes("8")) {
    alert("Number is not allowed in last name!");
  }
  if(pass!=cpass)
  {
    alert("Passwords don't match!");
  }
}

function fun()
{
    alert("A new password has been sent to your Email-ID");
}


function func()
{
  var pass = document.forms["forgot_pass1"]["pass1"].value;
  var cpass = document.forms["forgot_pass1"]["pass2"].value;
  if(pass==cpass)
  {
    alert("Password has been changed. Kindly log in with your new password!");
  }
  else {
    {
      alert("Passwords don't match!");
    }
  }
}

function func1()
{
  var pass = document.forms["newform"]["passwd1"].value;
  var cpass = document.forms["newform"]["passwd2"].value;
  if(pass==cpass)
  {
    alert("Password has been changed. Kindly log in with your new password!");
  }
  else {
    {
      alert("Passwords don't match!");
    }
  }
}
