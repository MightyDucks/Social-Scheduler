<?php
        require "fbsetup.php";
        require "connection.php";
        require "facebookhelper.php";

        if($fb->getUser() != 0){
                //Display main application
                $variables = array();
                template("mainpage", $variables);

        }else{
                //Display guest page
                $variables = array();

                $variables['loginurl']= $fb->getLoginUrl(array("redirect_uri" => "http://sdd.steifel.net/login.php"));

                $content = template("guestpage", $variables);
//                $guestpage = file_get_contents("./template/guestpage.tpl");
 //               eval("\$content = \"".$guestpage."\";");
  //              unset($guestpage);
                echo $content;
        }
     
?>
