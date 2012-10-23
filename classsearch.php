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
                        $variables['results'] .= template("searchresult", $results[$i]);
                }
        }
        

        //Set up and display the page
        echo template("classsearch", $variables);
        
?>
