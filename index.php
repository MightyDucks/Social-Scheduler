<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";

        if($fb->getUser() != 0){
                //Display main application
                $variables = array();
                $variables['navigation'] = "<a href='index.php'>Home</a> <a href='classsearch.php'>Class Search</a> <a href='logout.php'>Logout</a>";
                $content =  template("index", $variables);

                echo $content;
        }else{
                //Display guest page
                $variables = array();

                $variables['loginurl']= $fb->getLoginUrl(array("redirect_uri" => "http://sdd.steifel.net/login.php"));

                $content = template("guestpage", $variables);
                echo $content;
        }
            
?>
