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
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <h1 class="center">STUDENT Login</h1>
        </div>
        <nav>
            <span class="right">HOD? <a href="hod.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form>
                <div class="form-group">
                    <label for="studentID" class="left">Student ID</label>
                    <input type="number" name="studentID" class="form-control" id="studentID" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left">Password</label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="left">
                    <a href="./student_register.php" class="btn btn-outline-secondary">Sign Up</a>
                </div>
                <div class="right">
                    <input type="submit" name="login" value="Login" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    if(isset($_POST["login"])){
        $sid = $_POST["studentID"];
        $pwd = $_POST["pwd"];
        $query = "SELECT * WHERE `student_ID` = '${sid}' AND `student_PASSWORD` = '${pwd}'";
        if ($conn->query($query) === TRUE) {
            $studentEmail = "";
            setcookie("student_email","${studentEmail}",time()+3600);
            setcookie("logged_in",true,time()+3600);
            print $_COOKIE["student_email"];
            print $_COOKIE['logged_in'];
        }else{
            $error = $conn->error;
            echo "
            <div class='alert alert-danger center' role='alert'>
                ".$error. "
            </div>                    
            ";
        }
    }
?>