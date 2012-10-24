<?php
        include_once "course.php";

        class schedule{
                public $userid = 0;
                public $classList = array(); //In the format of array(array('id'=>id, 'class'=>class));

                public function checkfit($courseObj){
                        //Check against other classes that are added for timing conflict
                        return true;
                }

                public function saveSchedule(){
                        global $mysql;
                        if($this->userid == 0){
                                return false;
                        }

                        //Save schedule for the specific user id that was supplied when setting up
                        $noDeleteIds = "";
                        foreach($this->classList as $value){
                                $this->mysql->query("INSERT IGNORE INTO schedules VALUES ({$this->userid}, {$value['id']});");
                                $noDeleteIds .= "{$value['id']},";
                        }
                        $noDeleteIds = substr($noDeleteIds, 0, strlen($noDeleteIds) - 1);
                        $this->mysql->query("DELETE FROM schedules WHERE userid={$this->userid} AND classid NOT IN ($noDeleteIds);");

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
                        $getClass = $this->mysql->query("SELECT crn, name, school, coursenumber, section FROM classes WHERE id=$id LIMIT 1;");
                        if(count($getClass) == 1){

                                $newCourse = new course($id, $getClass[0]['crn'], $getClass[0]['name'], $getClass[0]['school'], $getClass[0]['coursenumber'], $getClass[0]['section']);

                                $times = $this->mysql->query("SELECT type, starttime, endtime, instructor, days FROM classtimerelation ctr, classtimes ct WHERE ctr.classid=$id AND ctr.timeid=ct.id;");
                                foreach($times as $timeblock){
                                        $newCourse->addTime($timeblock['type'], $timeblock['days'], $timeblock['starttime'], $timeblock['endtime'], $timeblock['instructor']);
                                }
                                

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
                        
                        for($i = 0; $i < count($classList); $i++){
                                if($classList[$i]['id'] == $id){
                                        unset($classList[$i]);
                                }
                        }

                        if(saveSchedule()){
                                return true;
                        }
                        return false;
                }

                public function getSchedule($userid){
                        global $mysql;
                        $this->userid = $userid;
                }
        }


?>