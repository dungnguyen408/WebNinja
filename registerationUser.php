<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>registeruser</title>
<meta name="description" content="JobNinja">
<meta name="keywords" content="JobNinja, jobs, employment, bay area, silicon valley, online job search, career">
<meta name="author" content="WebNinja">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link href="bootstrap-3.3.5/css/custom.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 

</head>

<nav id="navbar" class="navbar navbar-default navbar-inverse navbr-fixed-top" role="navigation">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="sr-only">Toggle nav </span>
      <span class="icon-bar"> </span>
      <span class="icon-bar"> </span>
      <span class="icon-bar"> </span>
    </button>
    <a class="navbar-brand" href="home.html"> WebNinja </a>
  </div>
  <!-- Nav bar -->
  <div class="collapse navbar-collapse" id="navbarCollapse">
  <ul class="nav navbar-nav">
      <li><a href="home.html"><span class="glyphicon glyphicon-home"></span> Home </a></li>
      
      <li><a href="employer.html">Employer</a></li>
      <li><a href="info.html">Learning Portal</a></li>
        <li><a href="resume/index.html">Interactive Resume</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="contact.html">Contact</a></li>
    </ul>
    
    
    <!--Create a signup/login on top nav-->
    <ul class="nav navbar-nav navbar-right">
        <li><a href="registerationUser.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
  </div>
</div>
</nav>

  <?php
// define variables and set to empty values

$fname = $email = $lname = $user = $pass = $repass = $test = $confirm = $jobseeker ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
   
    
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $user = $_POST['username'];
      $pass =$_POST['password'];
        $jobseeker="JobSeeker";
      

try {

    require_once 'connection.php';
    $conn = new PDO("mysql:host=".servername.";dbname=".dbname, username, password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = "SELECT * FROM user WHERE username = :user AND password = :pass";
    $ps = $conn->prepare($query);
    $ps->bindParam(':user',$user);
    $ps->bindParam(':pass',$pass);
    $ps->execute();
    $row = $ps->fetchAll(PDO::FETCH_ASSOC);

  if(!$row)
    {
      


    $sql1 = "INSERT INTO jobseeker (username, usertype, firstname, lastname, email, password)
      VALUES ('$user', '$jobseeker', '$fname', '$lname', '$email', '$pass')";
  
  

    $sql2 = "INSERT INTO user (username, password, email, usertype, confirmcode)
      VALUES ('$user', '$pass', '$email', '$jobseeker', '$confirm')";
     
    
    // use exec() because no results are returned
    
    $conn->exec($sql1);
    $conn->exec($sql2);
   
   
    header('Location: http://localhost/webninja7/applicant.html');
    exit();

    }
    else
    {

    $test ="User already Exsits!";
    }

  }


    
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

}
?>


<div class="container" align="center">
<div class="panel panel-primary">
  <h1 class="panel-title">Register</h1>
  <form id ="form" align="center" method="post" class="form-group" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onSubmit="return validate(this);" > 
 
      <p><span class="error"><?php echo $test;?></span></p>
    
   <div class="form-group">
      <label for="fname" class="sr-only">FirstName</label>
      <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
    </div>
    <div class="form-group">
      <label for="lname" class="sr-only">LastName</label>
      <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
    </div>
    <div class="form-group">
      <label for="username" class="sr-only">UserName</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="UserName" required>
    </div>
    <div class="form-group">
      <label for="email" class="sr-only">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
    </div>
    <div class="form-group">
      <label for="password" class="sr-only">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
      <label for="password" class="sr-only">Retype Password</label>
        <input type="password" class="form-control" id="repass" name="repass" placeholder="Retype Password" required>
    </div>
    <div class="form-group">
        <button type="submit" value="submit" class="btn">Register</button>
    </div>

  
</form>
</div>
</div>
<script type = "text/javascript">
  
function validate(form)
{
  var checkfname = /^[a-zA-Z]*$/;
  var checklname = /^[a-zA-Z]*$/;
  var checkemail = /^.+@.+\..{2,4}$/;

  var checkuser = /^[A-Za-z0-9_]{2,20}$/;
  var checkpass = /^[A-Za-z0-9!@#$%^&*()_]{5,20}$/;
  
  if(!checkfname.test(form.fname.value))
  {
    
    alert("Invalid first name.\n");
    return false;
  }

    if(!checklname.test(form.lname.value))
  {
    
    alert("Invalid last name.\n");
    return false;
  }

   if(!checkemail.test(form.email.value))
  {
    
    alert("Invalid email address. Example: xxxxx@xxxxx.xxx\n");
    return false;
  }
  
  if(!checkuser.test(form.username.value))
  {
    
    alert("Please enter a valid username.");
    return false;
  }
  
  //returns false and an alert if password does not pass check
  if(!checkpass.test(form.password.value))
  {
    
    alert("Please enter a valid password. The length must be a minimum of 5 to 18.");
    return false;
  }
  if(!checkpass.test(form.repass.value))
  {
    
    alert("Please enter a valid re password. The length must be a minimum of 5 to 18.");
    return false;
  }
  if(form.password.value != form.repass.value)
  {
     alert("Passwords don't match");
     return false;
  }

    return true;
  
}

</script>

<br><br><br>
      <footer>
      <p class="pull-right"><a href="#">Back to top</a></p>
      <p>&copy; 2015 Web Ninja, Inc. </p>
      </footer>


</body>
</html>