<?php

	require 'headers.php';

    // instantiate student class
    $student = new Student($db);
    
    // registeration inputs
    $registerationInputs = json_decode(file_get_contents("php://input"));

    $student->details = (array) $registerationInputs;

    print_r($student->register());
?>