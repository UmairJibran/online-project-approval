<?php
    session_start();
    require_once('../server/connection.php');
    $stID = $_SESSION['id'];
    $sql = "SELECT `student_FIRST_NAME` , `student_LAST_NAME` FROM `student_record` WHERE `student_ID` = '${stID}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $studentName = $data['student_FIRST_NAME'] . " " . $data['student_LAST_NAME'] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron">
            <h3 class='center'>All Projects</h3>
            <small class="right"><?php echo "Welcome " . $studentName ?></small>
        </div>
        <nav class="right">
            <form action="#" method="post">
                <input type="submit" value="Add New Project" class="btn btn-outline-success" name="add">
                &nbsp
                <input type="submit" value="Log Out" class="btn btn-outline-danger" name="logout">
            </form><br><br><br>
        </nav>
        <table class="table">
            <tr>
                <th>Project Title</th>
                <th>Project Year</th>
                <th>Project HOD</th>
                <th>Project Professor(assigned)</th>
                <th>Project Status</th>
                <th>Project Comment</th>
                <th>Project Course</th>
                <th>Project Batch</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `project_record`";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $title = $data['project_TITLE'];
                        $year = $data['project_YEAR'];
                        $hodID = $data['hod_ID'];
                        $professor = $data['project_PROFESSOR'];
                        $status = $data['project_STATUS'];
                        $comment = $data['project_COMMENT'];
                        $course = $data['project_COURSE'];
                        $batch = $data['project_BATCH'];
                        echo"
                        <tr>
                            <td>${title}</td>
                            <td>${year}</td>
                        ";
                        $hodNAME = '';
                        $sql1 = "SELECT `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record` WHERE `hod_ID` = '${hodID}'";
                        $result1 = $conn->query($sql1);
                        $data1 = $result1->fetch_assoc();
                        $hodNAME = $data1['hod_FIRST_NAME'] . ' ' . $data1['hod_LAST_NAME'];
                        echo"
                            <td>${hodNAME}</td>
                            <td>${professor}</td>
                        ";
                        if($status == 0){
                            echo "<td><font color='blue'><strong>PENDING</strong></font></td>";
                        }elseif($status == 1){
                            echo "<td><font color='green'><strong>ACCEPTED</strong></font></td>";
                        }else{
                            echo "<td><font color='red'><strong>REJECTED</strong></font></td>";
                        }
                        echo"
                            <td>${comment}</td>
                            <td>${course}</td>
                            <td>${batch}</td>
                        </tr>
                        ";
                    }
                }else{
                    echo '<br><br><br><br><div class="alert alert-danger center" role="alert" >You Have No Project</div>';
                }
            ?>
        </table>
    </div>
</body>
</html>
<?php
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: ../");
    }
    if(isset($_POST['add'])){
        header("Location: ./propose.php");
    }
?>