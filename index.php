<?php 
    
    include "incs/autoloader.inc.php";

    $database = new Database();
    $database->connect();


    $json = array('name'=>'Faddal Ibrahim', 'school'=>'Ashesi Univesity');

    echo json_encode($json);

?>