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
</style>
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
        <li><a href="registerationUser.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>

</nav>
<?php
            //gets the value from the form
            $pos = $_POST['pos'];
            $fcgorexp = $_POST['fcgorexp'];
            
             
            $deg = $_POST['deg'];
            $cgpa = $_POST['cgpa'];
           
            

           $test = " ";


                

                $servername = "localhost";
                $username = "root";
                $password = "divya";
                $dbname = "mydb";

                try {
                    //database connectivity
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    if((strlen($pos)) > 0)
                    {
                       if($fcgorexp == "fcg")
                        {
                            $query = "SELECT j.firstname,j.lastname,j.email,b.industrytype,b.degree,e.gpa,e.university FROM Jobseeker j,BasicProfile b,Education e WHERE b.industrytype = '$pos' AND e.gpa >= '$cgpa' AND b.degree = '$deg' AND j.username = b.username AND b.username = e.username";
                        }
                        else
                        {
                            $query = "SELECT j.firstname,j.lastname,j.email,b.industrytype,b.degree,x.yearsofexp,x.emplname,x.description FROM Jobseeker j,BasicProfile b,Experience x WHERE b.industrytype = '$pos' AND j.username = b.username AND b.username = x.username";
                        }
                    }
                    $result = $conn->query($query);
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    //No rows found display message
                    
                    if(!$row)
                        {
                            $test = "Sorry No Candidates Matching Your Search Criteria !";
                            
                        }

                    //rows are found
                    else
                        {
                           print "<h2>Candidates Matching your Criteria</h2>\n";
                           print "<table align ='center'>\n";

                            print "        <tr>\n";
                            foreach ($row as $field => $value) {
                                print"       <th>$field</th>\n";
                                
                            }
                            print "     </tr>\n";
                            $data = $conn->query($query);
                            $test = $data->setFetchMode(PDO::FETCH_ASSOC);
                            
                            foreach ($data as $row) {
                            print "       <tr>\n";
                            foreach ($row as $name => $value) {
                              
                                    print "     <td>$value</td>\n";
                                    
                                }
                                print "     </tr>\n";
                                
                            }
                            print "    </table>\n";
                            }
                        }

                        //error exception caught here
                        catch(PDOException $e)
                            {
                            //echo $sql . "<br>" . $e->getMessage();
                            }

                            $conn = null;

           
            
        
 ?>
 </div>
<div class="container" align="center">
    <button class = "back" onclick="history.go(-1);">Back</button>
</div>

 <h2 id="para"><?php if(!$row){ echo $test;} ?></h2> 

<br><br><br><br><br><br><br><br><br><br><br><br>

<footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>&copy; 2015 Web Ninja, Inc. </p>
</footer>

</body>
</html>
