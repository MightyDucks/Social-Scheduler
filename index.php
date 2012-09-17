<?php
	require "facebooksdk/facebook.php";

        require "mysql.php";
        //mysql_connect("localhost", "sdd", "mightyducks") or die(mysql_error());
        //mysql_select_db("sdd") or die(mysql_error());


        $mysql = new mysqlHelper();
        $mysql->connect("localhost", "sdd", "mightyducks");
        $mysql->select_db("sdd");


        $fb = new Facebook(array("appId" => '119211698227030', "secret" => '1e48b57d3cd9edfe80f05944366e791f'));

        echo $fb->getUser();
        echo "<br />";
        echo $fb->getLoginUrl(array("redirect_uri" => "http://sdd.steifel.net"));
        
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
