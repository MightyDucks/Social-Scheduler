<?php
        include_once "timeblock.php";

        class course{
                public $id;
                public $crn;
                public $name;
                public $school;
                public $coursenumber;
                public $section;
                public $times;

                public function __construct($id, $crn, $name, $school, $coursenumber, $section){

                }

                public function addTime($classtype, $days, $starttime, $endtime, $instructor){
                        $insertAt = count($times)-1;
                        $times[$insertAt] = new timeblock();


                        $times[$insertAt]->clastype = $type;
                        $times[$insertAt]->days = $days;
                        $times[$insertAt]->starttime = $starttime;
                        $times[$insertAt]->endtime = $endtime;
                        $times[$insertAt]->instructor = $instructor;
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
