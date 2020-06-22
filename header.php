<?php
    if(isset($_SESSION['role'])){
        echo "session set";
        switch($_SESSION['role']){
            case 'student':{
                header("Location: ../student/");
                break;
            }
            case 'hod':{
                header("Location: ../hod/");
                break;
            }
        }
    }
?>