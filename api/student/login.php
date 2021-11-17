<?php
    require "headers.php";

    $student = new Student($db);
    
	$loginInputs = json_decode(file_get_contents("php://input"));
    
    $student->details = (array) $loginInputs;


    
    echo($student->login());

?>