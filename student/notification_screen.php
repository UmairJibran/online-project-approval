<?php
    session_start();
    require_once('../server/connection.php');
    $stdID = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container container-fluid">
        <div class="jumbotron mb-5">Notifications</div>
        <a href="./" class="btn btn-primary mb-3">Go Back</a>
        <?php
            $sql = "SELECT * FROM `project_notification` WHERE `student_id` = '${stdID}'";
            $result = $conn->query($sql);
            $rows = $result->num_rows;
            if($rows>=1){
                while($data = $result->fetch_assoc()){
                    $prID = $data['project_id'];
                    $notID = $data['notification_id'];
                    echo '<div class="mt-5 alert alert-warning center" role="alert">Project ';
                    $sql1 = "SELECT `project_STATUS`  FROM `project_record` WHERE `project_ID` = `${prID}`";
                    $result1 = $conn->query($sql1);
                    $data1 = $result1->fetch_assoc();
                    if($data1 === true){
                        echo "ACCEPTED";
                    }else{
                        echo "REJECTED";
                    }
                    echo'</div>';
                }
            }else{
                echo '<div class="mt-5 alert alert-success center" role="alert">No Notification</div>';
            }
        ?>
    </div>
</body>
</html>