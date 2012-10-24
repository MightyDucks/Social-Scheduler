<?php
        require "fbsetup.php";
        require "connection.php";
        require "facebookhelper.php";
        require "function.php";

        
        $variables = array();

        if(@trim($_GET['query']) != ""){
                $_GET['query'] = $mysql->escapeString(trim($_GET['query']));
                $results = $mysql->query("SELECT id, crn, coursenumber, name, credithours FROM classes WHERE name LIKE '%{$_GET['query']}%' OR coursenumber LIKE '%{$_GET['query']}%';");

                for($i = 0; $i < count($results); $i++){
                        if(@$_GET['ajax']==1){
                                //No need to run through templating responding with json
                                $variables[] = array('id' => $results[$i]['id'], 'crn' => $results[$i]['crn'], 'coursenumber' => $results[$i]['coursenumber'], 'name' => $results[$i]['name'], 'credits' => $results[$i]['credithours']);
                        }else{
                                $variables['results'] .= template("searchresult", $results[$i]);
                        }
                }
        }
        

        //Ajax response
        if(@$_GET['ajax']){
                echo "{".json_encode($variables)."}";
                die();
        }
        //Set up and display the page
        echo template("classsearch", $variables);
        
?>
