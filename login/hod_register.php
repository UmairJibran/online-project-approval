<?php
    require_once("../server/connection.php");
    if(isset($_COOKIE["logged_in"])){
        header("location:./student/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <h1 class="center">STUDENT Register</h1>
        </div>
        <nav>
            <span class="right">HOD? <a href="hod.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="studentFName" class="left">Student First Name</label>
                    <input type="text" name="studentFName" class="form-control" id="studentFName" required>
                </div>
                <div class="form-group">
                    <label for="studentLName" class="left">Student Last Name</label>
                    <input type="text" name="studentLName" class="form-control" id="studentLName" required>
                </div>
                <div class="form-group">
                    <label for="studentEmail" class="left">Student Email</label>
                    <input type="email" name="studentEmail" class="form-control" id="studentEmail" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left">Password</label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="left">
                    <a href="./login.php" class="btn btn-outline-secondary">Sign In</a>
                </div>
                <div class="right">
                    <input type="submit" name='register' value="Sign Up" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <br><br><br>
        <?php
            if(isset($_POST['register'])){
                $fName = $_POST['studentFName'];
                $lName = $_POST['studentLName'];
                $studentEmail = $_POST['studentEmail'];
                $pwd = $_POST['pwd'];
                $query = "INSERT INTO `student_table` (`student_ID`, `student_FIRST_NAME`, `student_LAST_NAME`, `student_EMAIL`, `student_PASSWORD`) VALUES (NULL, '${fName}', '${lName}', '${studentEmail}' , '${pwd}')";
                if ($conn->query($query) === TRUE) {
                    echo '
                    <div class="alert alert-success" role="alert">
                        Student Registered
                    </div>
                    ';
                    setcookie("student_email","${studentEmail}",time()+3600);
                    setcookie("logged_in",true,time()+3600);
                    print $_COOKIE["student_email"];
                    print $_COOKIE['logged_in'];
                  } 
                else {
                    $error = $conn->error;
                    echo "
                    <div class='alert alert-danger center' role='alert'>
                        ".$error. "
                    </div>                    
                    ";
                }
            }
        ?>
    </div>
</body>
</html>
