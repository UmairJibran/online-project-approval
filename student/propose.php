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
    <title>Project Proposal</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h3 class="center">
                Propose a Project
            </h3>
        </div>
        <section class="form">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <input type="text" name="title" class="form-control col-5" placeholder="Project Title" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="number" name="batch" class="form-control col-6" placeholder="Project Batch" required >
                </div>
                <div class="form-group row">
                    <input type="text" name="course" class="form-control col-5" placeholder="Project Course" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="text" readonly class="form-control col-6" placeholder="Your Student ID is: <?php echo $stID?>">
                </div>
                <div class="form-group row">
                    <select name="year" class="form-control col-3">
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                    </select>
                    &emsp;&emsp;&emsp;&emsp;&emsp;
                    <div class="input-group mb-3 col-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Professor</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Professor will be assigned by HOD after reading the Project" readonly>
                    </div>  
                </div>
                <div class="form-group row">
                    <label for="hod" class="col-1 col-form-label">HOD</label>
                    <select name="hod" class="col-5 form-control">
                        <?php
                            $sql = "SELECT `hod_ID` , `hod_FIRST_NAME` , `hod_LAST_NAME` FROM `hod_record`;";
                            $result = $conn->query($sql);
                            $rows = $result->num_rows;
                            if($rows >= 1){
                                while($data = $result->fetch_assoc()){
                                    $id = $data['hod_ID'];
                                    $name = $data['hod_FIRST_NAME'] . " " . $data['hod_LAST_NAME'];
                                    echo "<option value='${id}'>${name}</option>";
                                }
                            }
                        ?>  
                    </select>
                    &emsp;&emsp;&emsp;
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <input type="submit" name="propose" value="Propose" class="btn btn-outline-primary right">
            </form>
        </section>
    </div>
</body>
</html>

<?php
        if(isset($_POST['propose'])){
            $title= $_POST['title'];
            $batch= $_POST['batch'];
            $course= $_POST['course'];
            $year= $_POST['year'];
            $hod= $_POST['hod'];
            $document = '';
            $file = $_FILES['fileToUpload'];
            $fileName = $file['name'];
            $fileTempName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.',$fileName);
            $fileActulaExtension = strtolower(end($fileExt));
            $allowed = array('pdf','doc','txt');
            if(in_array($fileActulaExtension,$allowed)){
                if($fileError === 0){
                    if($fileSize < 5000000){
                        $fileNameNew = uniqid('',true) . '.' . $fileActulaExtension;
                        $fileDestination = '../server/uploads/'.$fileNameNew;
                        move_uploaded_file($fileTempName,$fileDestination);
                        $document = $fileDestination;
                        $sql = "INSERT INTO `project_record` (`project_ID`, `student_ID`, `hod_ID`, `project_TITLE`, `project_YEAR`, `project_PROFESSOR`, `project_BATCH`, `project_COURSE`, `project_COMMENT`, `project_STATUS`, `project_file`) VALUES (NULL, '${stID}', '${hod}', '${title}', '${year}', NULL, '${batch}', '${course}', NULL, '0', '${document}')";
                        if($conn->query($sql) === true){                    
                            $last_id = $conn->insert_id;
                            $sql = "INSERT INTO `project_notification` (`notification_id`, `project_id`, `student_id`, `hod_id`)
                            VALUES (NULL, '${last_id}', '${stID}', '${hod}')";
                            if($conn->query($sql) === true){
                                header("Location: ./");
                            }
                        }else{
                            echo '<div class="alert alert-danger center" role="alert" >'. $conn->error .'</div>';
                        }
                    }else
                        echo "Don't upload GIGANTIC FILEs";
                }
            }else
                echo "This type is not accepted, please use either pdf,txt or doc";
        }
?>