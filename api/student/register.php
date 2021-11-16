<?php

	require 'headers.php';

    // instantiate student class
    $student = new Student($db);
    
    // registeration inputs
    $registerationInputs = json_decode(file_get_contents("php://input"));

    // print_r($registerationInputs);
    
    // store registeration data in student object
    $student->details = $registerationInputs;

    // check if user exists (with same email) first before proceeding

    
    // store details in database
    print_r($student->register());
?>