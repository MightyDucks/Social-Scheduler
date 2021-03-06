<?php
        require "schedule.php";
        require "connection.php";
	require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";
        
        if($fb->getUser() !== 0){
                //User allowed access/logged in again
                $user = $mysql->query("SELECT * FROM users WHERE id={$fb->getUser()} LIMIT 1;");
                        
                //Get information on the user who just logged in
                $personInfo = $fb->api("me");

                $username = $personInfo['name'];
                

                if(count($user) == 1){
                        //The user has already been here and is just logging in, check to see if his/her name has updated
                        if($user['name'] != $username){
                                $mysql->query("UPDATE users SET name='{$username}' WHERE id={$fb->getUser()} LIMIT 1;");
                        }
                        $_SESSION['userschedule'] = new schedule();
                        $_SESSION['userschedule']->getSchedule($fb->getUser());
                }else{
                        //User has never visited before but has logged in and is allowing us to use the information
                        $friendslist = facebookhelper::getFriends($fb);

                        $mysql->query("INSERT INTO users (id, name) VALUES ({$fb->getUser()}, '{$username}');");
                        foreach($friendslist as $value){
                                $mysql->query("INSERT INTO friends SELECT {$fb->getUser()}, {$value['id']} FROM users WHERE id={$value['id']} LIMIT 1;");
                        }
                }

        }
        
        header("Location: index.php");
        
        
?>
