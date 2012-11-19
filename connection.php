<?php
        session_start();
        require "mysql.php";

        $mysql = new mysqlHelper();
        $mysql->connect("localhost", "sdd", "mightyducks");
        $mysql->select_db("sdd");

?>
