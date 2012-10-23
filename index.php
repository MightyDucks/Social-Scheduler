<?php
        require "fbsetup.php";
        require "connection.php";
        require "facebookhelper.php";
        require "function.php";

        if($fb->getUser() != 0){
                //Display main application
                $variables = array();
                $variables['navigation'] = "<a href='classsearch.php'>Class Search</a>";
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
