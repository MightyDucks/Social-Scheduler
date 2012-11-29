<?php
        require "timeblock.php";

        class course{
                public $id;
                public $crn;
                public $name;
                public $school;
                public $coursenumber;
                public $section;
                public $times;
 
                public function __construct($id, $crn, $name, $school, $coursenumber, $section){
                        global $mysql;
                        $this->id = $id;
                        $this->crn= $crn;
                        $this->name= $name;
                        $this->school = $school;
                        $this->coursenumber = $coursenumber;
                        $this->section= $section;

                        //get the course times
                        $gettimes = $mysql->query("SELECT type, HOUR(starttime)*60+MINUTE(starttime) as starttime, HOUR(endtime)*60+MINUTE(endtime) as endtime, instructor, days FROM classtimerelation ctr, classtimes ct WHERE ctr.classid={$this->id} AND ctr.timeid=ct.id;");
                        foreach($gettimes as $timeblock){
                                $this->addTime($timeblock['type'], $timeblock['days'], $timeblock['starttime'], $timeblock['endtime'], $timeblock['instructor']);
                        }

                }

                public function addTime($classtype, $days, $starttime, $endtime, $instructor){
                        //Simply adding in times to the times array
                        $insertAt = count($this->times);
                        $this->times[$insertAt] = new timeblock();
                        
                        
                        $this->times[$insertAt]->classtype = $classtype;
                        $this->times[$insertAt]->days = $days;
                        $this->times[$insertAt]->starttime = $starttime;
                        $this->times[$insertAt]->endtime = $endtime;
                        $this->times[$insertAt]->instructor = $instructor;
                }
                

                public function getTimes(){
                        return $this->times;
                }


                public function checktimeconflict($course){
                        for($i = 0; $i < count($this->times); $i++){
                                for($q = $i; $q < count($course->times); $q++){
                                        //Compare every time to the other courses time
                                        if(!$this->times[$i]->compare($course->times[$q])){
                                                return false;
                                        }

                                }
                        }

                        return true;
                }
                
        }
?>
