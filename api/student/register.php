<?php

	require 'headers.php';

    // instantiate student class
    $student = new Student($db);
    
    // registeration inputs
    $registerationInputs = json_decode(file_get_contents("php://input"));

    $student->details = (array) $registerationInputs;
    // $student->details = $registerationInputs;

    // print_r(json_encode($student->details));

    // check if user exists (with same email) first before proceeding

    
    // store details in database
    print_r($student->register());
?>