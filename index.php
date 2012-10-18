<?php
        require "fbsetup.php";
        require "connection.php";
        require "facebookhelper.php";

        if($fb->getUser() != 0){
                //Display main application
                echo "<pre>";
                var_dump(facebookhelper::getFriends($fb));
                echo "</pre>";
        }else{
                //Display log in page
                echo $fb->getLoginUrl(array("redirect_uri" => "http://sdd.steifel.net/login.php"));
        }

     
?>
