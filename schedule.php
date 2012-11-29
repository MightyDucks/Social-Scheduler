<?php
        require "course.php";

        class schedule{
                public $userid = 0;
                public $classList = array(); //In the format of array(array('id'=>id, 'class'=>class));

                public function checkfit($courseObj){
                        //Check against other classes that are added for timing conflict
                        
                        foreach($this->classList as $course){
                                if(!$course['data']->checktimeconflict($courseObj)){
                                        return false;
                                }
                        }

                        return true;
                }

                public function saveSchedule(){
                        global $mysql;
                        if($this->userid == 0){
                                return false;
                        }
                        //Save schedule for the specific user id that was supplied when setting up
                        $noDeleteIds = "-1,"; //Need -1 for fix including removal of the last class
                        foreach($this->classList as $value){
                                $mysql->query("INSERT IGNORE INTO schedules VALUES ({$this->userid}, {$value['id']});");
                                $noDeleteIds .= "{$value['id']},";
                        }
                        $noDeleteIds = substr($noDeleteIds, 0, strlen($noDeleteIds) - 1);
                        $mysql->query("DELETE FROM schedules WHERE userid={$this->userid} AND classid NOT IN ($noDeleteIds);");

                        return true;
                }

                public function addClass($id){
                        global $mysql;
                        //Because add class is going to be used when other classes aren't loaded yet we have to use the id of the class and pull the information
                        
                        if($this->userid == 0){
                                return false;
                        }

                        foreach($this->classList as $course){
                                if($course['id'] == $id){
                                        return false;
                                }
                        }

                        $getClass = $mysql->query("SELECT crn, name, school, coursenumber, section FROM classes WHERE id=$id LIMIT 1;");

                        //Create new course object if the class exists
                        if(count($getClass) == 1){
                                $newCourse = new course($id, $getClass[0]['crn'], $getClass[0]['name'], $getClass[0]['school'], $getClass[0]['coursenumber'], $getClass[0]['section']);

                                $this->classList[] = array('id' => $id, 'data' => $newCourse);
                        }

                        if($this->saveSchedule()){
                                return true;
                        }
                        return false;
                }

                public function removeClass($id){
                        if($this->userid == 0){
                                return false;
                        }

                        //Check to make sure there is a class that has that id in our class list

                        for($i = 0; $i < count($this->classList); $i++){
                                if($this->classList[$i]['id'] == $id){
                                        unset($this->classList[$i]);
                                        $this->classList=array_values($this->classList);
                                        break;
                                }
                        }

                        if($this->saveSchedule()){
                                return true;
                        }
                        return false;
                }
                
                public function getSchedule($userid){
                        global $mysql;
                        $this->userid = $userid;
                        $classes = $mysql->query("SELECT classid FROM schedules WHERE userid={$userid};");

                        //Get all classes and set them up
                        if($classes != null){
                                foreach($classes as $course){
                                        $this->addClass($course['classid']);
                                }
                        }
                }
        }


?>
