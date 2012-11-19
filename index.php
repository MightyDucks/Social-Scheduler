<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";

        if($fb->getUser() != 0){
                //Display main application
                $variables = array();

                
                //Go through all the courses and display them
                foreach($_SESSION['userschedule']->classList as $course){
                        $course = $course['data'];
                        $variables['maincontent'] .= "{$course->school}-{$course->coursenumber} Section {$course->section} --- {$course->name} <br /><a href='modifyschedule.php?remove={$course->id}'>Remove from schedule</a><br />";
                        

                        //Display times
                        foreach($course->times as $timeblock){
                                $variables['maincontent'] .= "{$timeblock->classtype} {$timeblock->days} "
                                .(($timeblock->starttime - $timeblock->starttime%60)/60).":".(sprintf("%02d",$timeblock->starttime%60))." - "
                                .(($timeblock->endtime-$timeblock->endtime%60)/60).":".(sprintf("%02d",$timeblock->endtime%60))." with {$timeblock->instructor}<br />";
                        }


                        //Get who else is in the class and display it
                        $friendsInClass = $mysql->query("SELECT name FROM users, (SELECT userid FROM schedules WHERE classid={$course->id} AND (userid IN (SELECT friendid FROM friends WHERE facebookid=".$fb->getUser()." ) OR userid IN (SELECT facebookid FROM friends WHERE friendid=".$fb->getUser()."))) sub WHERE sub.userid=id;");
                        

                        if($friendsInClass !== null){
                                $variables['maincontent'] .= "People also in this class:<br />";
                                foreach($friendsInClass as $friend){
                                        $variables['maincontent'] .= $friend['name']."<br />";
                                }
                        }
                        $variables['maincontent'] .= "<br />";
                }
                

                $variables['navigation'] = "<div><a href='index.php'>Home</a></div> <div><a href='classsearch.php'>Class Search</a></div> <div><a href='logout.php'>Logout</a></div>";
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
