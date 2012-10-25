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
                        $this->id = $id;
                        $this->crn= $crn;
                        $this->name= $name;
                        $this->school = $school;
                        $this->coursenumber = $coursenumber;
                        $this->section= $section;
                }

                public function addTime($classtype, $days, $starttime, $endtime, $instructor){

                        echo "adding time";
                        $insertAt = count($times);
                        $this->times[$insertAt] = new timeblock();


                        $this->times[$insertAt]->classtype = $classtype;
                        $this->times[$insertAt]->days = $days;
                        $this->times[$insertAt]->starttime = $starttime;
                        $this->times[$insertAt]->endtime = $endtime;
                        $this->times[$insertAt]->instructor = $instructor;
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
