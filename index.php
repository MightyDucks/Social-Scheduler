<?php
        require "fbsetup.php";
        require "connection.php";

        //Use mysqlHelper class

        echo $fb->getUser();
        echo "<br />";
        echo $fb->getLoginUrl(array("redirect_uri" => "http://sdd.steifel.net/login.php"));
        


        

        


        $lol = "";

        if($fb->getUser() !== 0){
                $lol = $fb->api('me/friends?limit=500');
                echo "<br /><pre>";
//                var_dump($lol['data']);
                echo "</pre>";


                foreach($lol['data'] as $value){
                        echo $value['name'].":".$value['id']."<br />";
                }
        }
        
?>
