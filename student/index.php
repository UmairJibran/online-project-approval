<?php
    session_start();
    require_once('../server/connection.php');
    $stID = $_SESSION['id'];
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
            <h3 class='center'>Student Dashboard</h3>
        </div>
        <nav class="right">
            <form action="#" method="post"><input type="submit" value="Add New Project" class="btn btn-outline-success" name="add">&nbsp<input type="submit" value="Log Out" class="btn btn-outline-danger" name="logout"></form><br><br><br>
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
                $sql = "SELECT * FROM `project_record` WHERE `student_ID` = '${stID}';";
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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