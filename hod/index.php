<?php
    session_start();
    require_once('../server/connection.php');
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
            <h2 class="center">HOD Dashboard</h2>
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