<?php
        require "schedule.php";
        require "connection.php";
        require "fbsetup.php";
        require "facebookhelper.php";
        require "function.php";

        

        $variables = array();
        if(@$_GET['process'] == 1){
                foreach($_POST['crninput'] as $value){
                        if(trim($value) == ""){
                                continue;
                        }
                        if(!is_numeric($value)){
                                $variables['confirmation'] = "$value invalid.<br />";
                        }
                        $result = $mysql->query("SELECT id FROM classes WHERE crn=$value;");
                        if(count($result) == 1){
                                $_SESSION['userschedule']->addClass($result[0]['id']);
                                $variables['confirmation'] = "Added CRN ".$value." to your schedule.<br />";
                        }else{
                                $variables['confirmation'] = "$value invalid.<br />";
                        }
                }
        }
        $content = template("crninput", $variables);
        echo template("index", array('maincontent' => $content, 'navigation' => "<div onclick=\"location.href='index.php'\">Home</div> <div onclick=\"location.href='classsearch.php'\">Class Search</div> <div onclick=\"location.href='inputschedule.php'\">Input CRNs</div> <div onclick=\"location.href='logout.php'\">Logout</div>"));


?>
