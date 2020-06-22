<?php
    session_start();
    require_once('../server/connection.php');
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
            <h1 class="center">HOD Register</h1>
        </div>
        <nav>
            <span class="right">Student? <a href="./student_login.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="hodFName" class="left">HOD First Name</label>
                    <input type="text" name="hodFName" class="form-control" id="hodFName" required>
                </div>
                <div class="form-group">
                    <label for="hodLName" class="left">HOD Last Name</label>
                    <input type="text" name="hodLName" class="form-control" id="hodLName" required>
                </div>
                <div class="form-group">
                    <label for="hodEmail" class="left">HOD Email</label>
                    <input type="email" name="hodEmail" class="form-control" id="hodEmail" required>
                </div>
                <div class="form-group">
                    <label for="pwd" class="left">Password</label>
                    <input type="password" name="pwd" class="form-control" id="pwd" required>
                </div>
                <div class="left">
                    <a href="./hod_login.php" class="btn btn-outline-secondary">Sign In</a>
                </div>
                <div class="right">
                    <input type="submit" name='register' value="Sign Up" class="btn btn-outline-primary">
                </div>
            </form>
        </div>
        <br><br><br>
        <?php
            if(isset($_POST['register'])){
                $fName = $_POST['hodFName'];
                $lName = $_POST['hodLName'];
                $email = $_POST['hodEmail'];
                $pwd = $_POST['pwd'];
                $sql = "INSERT INTO `hod_record` (`hod_ID`, `hod_EMAIL`, `hod_FIRST_NAME`, `hod_LAST_NAME`, `hod_PASSWORD`) VALUES (NULL, '${email}', '${fName}', '${lName}', '${pwd}')";
                if ($conn->query($sql) === TRUE) {
                    $last_id = $conn->insert_id;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'hod';
                    $_SESSION['fname'] = $fName;
                    $_SESSION['lname'] = $lName;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $last_id;
                    echo '<div class="alert alert-success center" role="alert">Account Created Successfully, Your ID is: '.$_SESSION['id'].'</div>';
                    header("Location: ./../hod/");
                } else {
                    echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>
