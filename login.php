<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Employer</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link href="bootstrap-3.3.5/css/custom.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
</head>
<body>
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
        <li><a href="registerationUser.php"><span class="glyphicon glyphicon-home"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
  </div>
</div>
</nav>

<?php
//define var
$user = $pass = $usernameErr = $passwordErr = $loginErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

     $user = $_POST['username'];
     $pass =$_POST['password'];

      
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

    if($row)
    {
  
      header('Location: http://localhost/webninja7/applicant.html');

    }
    else
    {

      $loginErr = "Login failed! Username password doesn't match";
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
<div class="bs-example">
<div class="panel panel-primary">
  <h1 class="panel-title">Login: </h1>

<form class="form-group" role="form" name = "form" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit = "return validate(this);">
<div class="form-group">
<label for="username" class="sr-only">Username: </label> &nbsp &nbsp &nbsp

<input type="text" name="username" class="form-control" placeholder="Enter a Username" required>
</div>
<div class="form-group">
<label for="password" class="sr-only">Password: </label> &nbsp &nbsp &nbsp

<input type="password" name="password" class="form-control" placeholder="Enter a Password" required>
</div>
<div class="form-group">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
</div>
<p><?php echo $loginErr;?></p>


<div class="form-group">
        <button type="submit" class="btn" value="submit">Login</button>
        <a href="registerationUser.php" > Register here! </a>
    </div>

</form>
  </div>
</div>
</div>



<script>

function validate(form)
{

  //only letter and numbers and min length 3-20 char
  var checkusername = /^[A-Za-z0-9_]{2,20}$/;
  
  //allows numbers, letters, and special char but min length 6 -20
  var checkpassword = /^[A-Za-z0-9!@#$%^&*()_]{5,20}$/;
  //returns false and an alert if username does not pass check
  if(!checkusername.test(form.username.value))
  {
    
    alert("Please enter a valid username.");
    return false;
  }
  
  //returns false and an alert if password does not pass check
  if(!checkpassword.test(form.password.value))
  {
    
      alert("Please enter a valid password. The length must be a minimum of 6 to 18.");
    return false;
  }
  
  //returns true and redirects to thankyou.php window
  if(checkpassword.test(form.password.value) && checkusername.test(form.username.value))
  {
    return true;
    
  }
  
}

</script>
<br><br><br><br><br><br>
<footer>
      <p class="pull-right"><a href="#">Back to top</a></p>
      <p>&copy; 2015 Web Ninja, Inc. </p>
      </footer>
  




</body>
</html>
