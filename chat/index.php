<?php
    session_start();
    require_once("../server/connection.php");
    $myID = $_SESSION['id'];
    $stdID = $_GET['hodID'];
    $hodID = $_GET['stdID'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <h2>Chat Messages</h2>
    <div class="left"><a href="../" class='btn btn-primary'>Go Back</a></div><br><br>
    <?php
        $sql = "SELECT * FROM `student_hod_chat` WHERE `student_id` = '${stdID}' AND `hod_id` = '${hodID}' ORDER BY `student_hod_chat`.`message_id` ASC";
        $result = $conn->query($sql);
        $rows = $result->num_rows;
        if($rows>=1){
            while($data = $result->fetch_assoc()){
                $messageBody = $data['message_body'];
                $messageSender = $data['message_sender'];
                $currentRole;
                if($_SESSION['role'] === 'hod'){
                    $currentRole = 'h';
                }else{
                    $currentRole = 's';
                }
                if($currentRole === $messageSender)
                    echo "<div class='container'>";
                else
                    echo"<div class='container darker'>";
                echo "${messageBody}</div>";
            }
        }
    ?>
    <form action="./index.php?hodID=<?php echo $hodID?>&stdID=<?php echo$stdID?>" method="post">
        <div class="form-group">
            <input type="text" name="message" class="form-control form-control-lg" required>
            <input type="submit" name='send' value="Send" class="btn btn-primary btn-lg right mt-3">
        </div>
    </form>
</body>
</html>

<?php
    if(isset($_POST['send'])){
        $role;
        if($_SESSION['role'] === 'hod'){
            $role = 'h';
        }else{
            $role = 's';
        }
        $messageBody = $_POST['message'];
        $sql = "INSERT INTO `student_hod_chat` (`message_id`, `student_id`, `hod_id`, `message_body`,`message_sender`) VALUES (NULL, '${stdID}', '${hodID}', '${messageBody}','${role}')";
        if($conn->query($sql) === false){
            echo '<div class="alert alert-danger" role="alert">
                Message wasn\'t sent
            </div>';
        }
    }
?>


