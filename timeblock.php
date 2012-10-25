<?php

        class timeblock{
                public $classtype;
                public $days;
                public $starttime;
                public $endtime;
                public $instructor;
                

                public function compare($compareTo){
                        for($i = 0; $i < strlen($this->days); $i++){
                                for($q = $i; $q < strlen($compareTo->days); $q++){
                                        if($this->days[$i] == $compareTo ->days[$q]){
                                                //Share a day check for time conflict


                                        }
                                }
                        }
                        return true;
                }
        }
?>
