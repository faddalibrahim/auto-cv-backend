<?php

    header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    // require classes
    require_once "../../class/student/Student.class.php";
    require_once "../../config/database.config.php";

     // instantiate database class
    $database = new Database();
    $db = $database->connect();

?>