<?php
        require "connection.php";

        $doc = new DOMDocument();
        @$doc->loadHTMLFile("spring.html");

        $trs = $doc->getElementsByTagName("tr");

        $lastClassId;

        foreach($trs as $row){
                if(strpos($row->nodeValue, "NOTE:") !== false){
                        continue;
                }
                $tds = $row->getElementsByTagName("td");
                if($tds->length > 2){
                        if(trim($tds->item(0)->nodeValue) == "" && trim($tds->item(1)->nodeValue) == ""){
                                //Appending time information for a class

                                $type = $mysql->escapeString(trim($tds->item(2)->nodeValue));
                                $days = $mysql->escapeString(trim($tds->item(5)->nodeValue));
                                $days = ($days == "") ? "NULL" : str_replace(" ", "", $days);
                                $starttime = $mysql->escapeString(trim($tds->item(6)->nodeValue));
                                $starttime = (strpos($starttime, "TBA") !== false) ? "NULL" : $starttime ;
                                $endtime = $mysql->escapeString(trim($tds->item(7)->nodeValue));
                                $endtime = ($endtime == "") ? "NULL" : $endtime;
                                $instructor = $mysql->escapeString(trim($tds->item(8)->nodeValue));
                                
                                
                                if(stripos($endtime, "PM") !== false){
                                        $preformat = intval($endtime);
                                        $endtime = str_ireplace("PM", "", $endtime);
                                        $endtime = (intval($endtime) + 12) . ":" . substr($endtime, strpos($endtime, ":")+1);

                                        if(intval($starttime) > $preformat){
                                               //Start time is AM end time is PM 
                                        }else{
                                                //Start and end time are both PM
                                                $starttime = (intval($starttime) + 12) . ":" . substr($starttime, strpos($starttime, ":")+1);
                                        }

                                }else{
                                        $endtime = str_ireplace("AM", "", $endtime);
                                }

                                if($starttime !== "NULL"){
                                        $starttime = "'".$starttime."'";
                                        $endtime = "'".$endtime."'";
                                }


                                //Insert time information
                                $mysql->query("INSERT INTO classtimes (type, starttime, endtime, instructor, days) VALUES ('$type', $starttime , $endtime,'$instructor', '$days');");
                                $timeId = $mysql->getLastId();

                                //Conect the class to time information 
                                $mysql->query("INSERT INTO classtimerelation VALUES($lastClassId, $timeId);");
                        }else{
                                //New class to insert into the database
                                $subject = trim($tds->item(0)->nodeValue);


                                $crn = substr($subject, 0, strpos($subject, " "));
                                $coursenumber = substr($subject, strpos($subject, " ") + 1);
                                                                

                                $coursename = $mysql->escapeString(trim($tds->item(1)->nodeValue));
                                $credithours = $mysql->escapeString(trim($tds->item(3)->nodeValue));
                                $maxseats = $mysql->escapeString(trim($tds->item(9)->nodeValue));
                                $takenseats = $mysql->escapeString(trim($tds->item(10)->nodeValue));
                                //Insert class
                                $mysql->query("INSERT INTO classes (crn, coursenumber, name, credithours, maxseats, takenseats) VALUES($crn, '$coursenumber', '$coursename', $credithours, $maxseats, $takenseats);");
                                $lastClassId = $mysql->getLastId();

                                //Get time information
                                $type = $mysql->escapeString(trim($tds->item(2)->nodeValue));
                                $days = $mysql->escapeString(trim($tds->item(5)->nodeValue));
                                $days = ($days == "") ? "NULL" : str_replace(" ", "", $days) ;
                                $starttime = $mysql->escapeString(trim($tds->item(6)->nodeValue));
                                $starttime = (strpos($starttime, "TBA") !== false) ? "NULL" : $starttime ;
                                $endtime = $mysql->escapeString(trim($tds->item(7)->nodeValue));
                                $endtime = ($endtime == "") ? "NULL" : $endtime;
                                $instructor = $mysql->escapeString(trim($tds->item(8)->nodeValue));

                                if(stripos($endtime, "PM") !== false){
                                        $preformat = intval($endtime);
                                        $endtime = str_ireplace("PM", "", $endtime);
                                        $endtime = (intval($endtime) + 12) . ":" . substr($endtime, strpos($endtime, ":")+1);

                                        if(intval($starttime) > $preformat){
                                               //Start time is AM end time is PM 
                                        }else{
                                                //Start and end time are both PM
                                                $starttime = (intval($starttime) + 12) . ":" . substr($starttime, strpos($starttime, ":")+1);
                                        }

                                }else{
                                        $endtime = str_ireplace("AM", "", $endtime);
                                }

                                if($starttime != "NULL"){
                                        $starttime = "'".$starttime."'";
                                        $endtime = "'".$endtime."'";
                                }



                                //Insert time information
                                $mysql->query("INSERT INTO classtimes (type, starttime, endtime, instructor, days) VALUES ('$type', $starttime, $endtime,'$instructor', '$days');");
                                $timeId = $mysql->getLastId();
                                
                                //Connect the class to time information
                                $mysql->query("INSERT INTO classtimerelation VALUES($lastClassId, $timeId);");


                        }
                }
        }

        echo "done";

?>
