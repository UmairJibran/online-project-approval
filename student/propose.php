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
            <form action="./" method="post">
            <div class="form-group row">
                    <input type="text" name="title" class="form-control col-5" placeholder="Project Title" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="number" name="batch" class="form-control col-6" placeholder="Project Batch" required>
                </div>
                <div class="form-group row">
                    <input type="text" name="course" class="form-control col-5" placeholder="Project Course" required>
                    &emsp;&emsp;&emsp;&emsp;
                    <input type="text" name="prof" class="form-control col-6" placeholder="Project Professor" required>
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
            </form>
        </section>
    </div>
</body>
</html>