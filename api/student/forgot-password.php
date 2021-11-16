<?php
    require "headers.php";


    // instantiate student class
    $student = new Student($db);
    echo $student->forgotPassword();


?>