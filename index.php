<?php 
    
    header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: *');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


    $json = array('hi'=>'there','whatsup'=>'whats cooking');

    echo __DIR__;

    print_r(json_encode($json));

?>