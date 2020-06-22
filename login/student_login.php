<?php
    session_start();
    require_once('../server/connection.php');
    require_once("../header.php");
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
            <span class="right">HOD? <a href="./hod_login.php">Login</a></span>
        </nav>
        <br><br>
        <div class="center-half">
            <form method="POST" action="#">
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
        <br><br><br>
        <?php
            if(isset($_POST['login'])){
                $id = $_POST['studentID'];
                $pwd = $_POST['pwd'];
                $sql = "SELECT *  FROM `student_record` WHERE `student_ID` = ${id} AND `student_PASSWORD` = '${pwd}'";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows == 1){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'student';
                    $_SESSION['id'] = $id;
                    $id = $_SESSION['id'];
                    $sql = "SELECT `status` FROM `student_record` WHERE `student_ID` = ${id}";
                    $result = $conn->query($sql);
                    $data = $result->fetch_assoc();
                    $status = $data['status'];
                    if($status){
                        header("Location: ./../student/");
                    }
                    else
                        echo '<div class="alert alert-danger center" role="alert" >Account Not YET VERIFIED BY HOD</div>';
                } else {
                    echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                }
                $conn->close();
            }
        ?>
    </div>
</body>
</html>