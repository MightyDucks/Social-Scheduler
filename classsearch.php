<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";

   

        if($fb->getUser() == 0){
                header("Location: index.php");
        }


        $variables = array();

        if(@trim($_GET['query']) != ""){
                //Sanitize input
                $_GET['query'] = str_replace(" ", "%", $mysql->escapeString(trim($_GET['query'])));


                $results = $mysql->query("SELECT id, crn, school, coursenumber, section, name, credithours FROM classes WHERE name LIKE '%{$_GET['query']}%' OR coursemeta LIKE '%{$_GET['query']}%' OR CONCAT('', crn) LIKE '%{$_GET['query']}%';");



                


                for($i = 0; $i < count($results); $i++){
                        

                        //Get list of friends taking this class
                        $friends = $mysql->query("SELECT name FROM users, schedules WHERE users.id=userid AND NOT users.id={$fb->getUser()} AND classid={$results[$i]['id']};");
                        
                        if($friends != null){
                                foreach($friends as $friend){
                                        $results[$i]['friends'] .= $friend['name']."<br />";
                                }
                        }

//~~~~~~~~~~~~~~~~~~~~~~~~ADD IN CONVERTING TO A COURSE AND DISPLAYING TIMES INSTEAD OF JUST DUMPING STRINGS~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


                        if(@$_GET['ajax']==1){
                                //No need to run through templating responding with json
                                $variables[] = array('id' => $results[$i]['id'], 'crn' => $results[$i]['crn'], 'school' => $results[$i]['school'], 'coursenumber' => $results[$i]['coursenumber'], 'section' => $results[$i]['section'], 'name' => $results[$i]['name'], 'credits' => $results[$i]['credithours'], "friends" => $results[$i]['freinds']);
                        }else{
                                $variables['results'] .= template("searchresult", $results[$i]);
                        }
                }
        }
        

        //Ajax response
        if(@$_GET['ajax']){
                echo "{\"data\":".json_encode($variables)."}";
                die();
        }
        //Set up and display the page
        $content = template("classsearch", $variables);
        echo template("index", array('maincontent' => $content, 'navigation' =>"<a href='index.php'>Home</a> <a href='classsearch.php'>Class Search</a> <a href='logout.php'>Logout</a>" ));
?>
