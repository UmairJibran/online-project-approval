<?php
    session_start();
    require_once('../server/connection.php');
    $id = $_SESSION['id'];
    $sql = "SELECT `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record` WHERE `hod_ID` = '${id}'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    $hodNAME = $data['hod_FIRST_NAME'] . " " . $data['hod_LAST_NAME'];
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
            <h2 class="center">
                HOD Dashboard
            </h2>
            <small class="right">Welcome <?php echo $hodNAME?> </small>
        </div>
        <nav class='right'><form action="#" method="post"><input type="submit" value="Log Out" name="logout" class="btn btn-outline-danger"></form></nav>
        <br><br><br>
        <table class="table">
        <caption class='center'>Approve Students</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Approve?</th>
            </tr>

            <?php
                $sql = "SELECT * FROM `student_record` WHERE `status` = 0";
                $result = $conn->query($sql);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $id = $data['student_ID'];
                        $name = $data['student_FIRST_NAME'] . " " . $data['student_LAST_NAME'];
                        $email = $data['student_EMAIL'];
                        echo"
                        <form method='post'>
                            <tr>
                                <td><fieldset disabled><input type='number' name='field$id' value=${id} id='disabledTextInput' class='form-control'></fieldset></td>
                                <td>${name}</td>
                                <td>${email}</td>
                                <td><input type='submit' name='approve${id}' class='btn btn-outline-success' value='Approve This'></td>
                            </tr>
                        </form>
                        ";
                        if(isset($_POST['approve'.$id])){
                            $sql = "UPDATE `student_record` SET `status` = '1' WHERE `student_record`.`student_ID` = '${id}';";
                            $result = $conn->query($sql);
                            header('Location: ?');
                        }
                    }
                }else{
                    echo '<div class="alert alert-success center" role="alert" >No Student Waiting for Approval</div>';
                }
            ?>
        </table>
        <table class="table">
        <caption  class='center'>Approve Projects</caption>
            <tr>
                <th>Project Title</th>
                <th>Project Year</th>
                <th>Project Professor(assigned)</th>
                <th>Project Status</th>
                <th>Project Comment</th>
                <th>Project Course</th>
                <th>Project Batch</th>
                <th>Project FILE</th>
            </tr>
            <?php
                $sql = "SELECT * FROM `project_record` WHERE `hod_ID` = '${id}';";
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
                        $file = $data['project_file'];
                        echo"
                        <tr>
                            <td>${title}</td>
                            <td>${year}</td>";
                        ?>
                        <form action="#" method="post">
                        <?php
                            echo'
                            <td>
                                <input type="text" name="prof" placeholder="Assign Professor" required> 
                            </td>
                            <td><select name="status" class="form-control">
                                <option value="0">LEAVE</option>
                                <option value="1">ACCEPT</option>
                                <option value="2">REJECT</option>
                            </select></td>
                            <td><input type="text" name="comment"  placeholder="Leave Remarks" required></td>
                            ';
                            echo"
                                <td>${course}</td>
                                <td>${batch}</td>
                                <td>${file}</td>
                                <td><input type='submit' name='update' class='btn btn-primary'></td>";
                                ?>
                                </form>
                                <?php
                                if(isset($_POST['update'])){
                                    $prof = $_POST['prof'];
                                    $status = $_POST['status'];
                                    $comment = $_POST['comment'];
                                    $sql = "UPDATE `project_record` SET `project_PROFESSOR` = '${prof}', `project_STATUS` = '${status}' , `project_COMMENT` = '${comment}' WHERE `project_record`.`project_ID` = 1;";
                                    $conn->query($sql);
                                }
                        echo "</tr>";

                    }
                }else{
                    echo '<div class="alert alert-success center" role="alert" >No Project Waiting for Approval</div>';
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
?>