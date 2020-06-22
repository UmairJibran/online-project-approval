<?php
    echo"student";
    if(!isset($_COOKIE["logged_in"])){
        header("location:../");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
    <form action="#" method="post"><input type="submit" value="log out" name="logout"></form>
</body>
</html>

<?php
    if(isset($_POST["logout"])){setcookie("logged_in",false,time()-3600);}
?>