<?php

/* Class to handle logging errors and automatically fetching all results */

class mysqlHelper {
        private $mysqli;
        public function connect($server, $user, $pass){
                //Connect should be the only call that dies instead of logs the error
                $this->mysqli = new mysqli($server, $user, $pass);
                if($this->mysqli->connnect_errno){
                        die("Failed to connect to MySQL server!");
                }
                return 0;
        }

        public function select_db($db){
                if(!($this->mysqli->select_db($db))){
                        $this->log_error($this->mysqli->error);
                        return 1;
                }
                return 0;
        }
        
        /*Perform a mysql query and return an array with the results if requested
        @param: queryString - String that contains a query
        @return: returns an array containing all elements if a mysql statement would return rows
        */

        public function query($queryString){
                $result = $this->mysqli->query($queryString);

                if($result instanceof mysqli_result){
                        $returnValue;
                        //Automatically fetch all rows and return
                        for($i = 0; $i < $result->num_rows; $i++){
                                $returnValue[] = $result->fetch_assoc();
                        }

                        return $returnValue;
                }else{
                        if($result === false){
                                $this->log_error($this->mysqli->error);
                        }

                        return $result;
                }
        }


        /*Log all mysql errors that occur and log them to a file
        @param: $errString - string containing text about the error
        */
        private function log_error($errString){
                $errorFile = fopen("mysqlerrors.log","a+");
                fwrite($errorFile, date("[Y-m-d H:i:s] ").$errString."\n");
                fclose($errorFile);
        }
}


?>
