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
        <div class="jumbotron mb-5">
            <h2 class='center'>Notifications</h2>
        </div>
        <a href="./" class="btn btn-primary mb-3">Go Back</a>
        <?php
            $sql = "SELECT * FROM `project_notification` WHERE `student_id` = '${stdID}' AND `seen` = 0";
            $result = $conn->query($sql);
            $rows = $result->num_rows;
            if($rows>=1){
                echo "
                    <table class='table'>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                ";
                $count = 0;
                while($data = $result->fetch_assoc()){
                    $count+=1;
                    $prID = $data['project_id'];
                    $notID = $data['notification_id'];
                    $sql1 = "SELECT `project_STATUS`,`project_TITLE`  FROM `project_record` WHERE `project_ID` = '${prID}'";
                    $result1 = $conn->query($sql1);
                    $data1 = $result1->fetch_assoc();
                    $title = $data1['project_TITLE'];
                    echo "
                        <td>${count}</td>
                        <td><span class='mt-5 alert alert-warning center' role='alert'>`Project ${title}`
                    ";
                    if($data1['project_STATUS'] === true){
                        echo " ACCEPTED";
                    }else{
                        echo " REJECTED";
                    }
                    echo"
                        </span></td>
                        <td><form method='POST'><input type='submit' value='Dissmiss' class='btn btn-info' name='seen${notID}'></form></td>
                        </tr>
                    ";
                    if(isset($_POST['seen'.$notID])){
                        $sql2 = "UPDATE `project_notification` SET `seen` = '0' WHERE `project_notification`.`notification_id` = ${notID};";
                        $conn->query($sql2);
                        header('location:./notification_screen.php');
                    }
                }
                echo "
                    </table>
                ";
            }else{
                echo '<div class="mt-5 alert alert-success center" role="alert">No New Notification</div>';
            }
        ?>
    </div>
</body>
</html>