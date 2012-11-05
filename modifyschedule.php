<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";
        

        if(@is_numeric($_GET['add'])){

                $_SESSION['userschedule']->addClass($_GET['add']);
                header("Location: index.php");
        }elseif(@is_numeric($_GET['remove'])){

                $_SESSION['userschedule']->removeClass($_GET['remove']);
                header("Location: index.php");
        }


?>
