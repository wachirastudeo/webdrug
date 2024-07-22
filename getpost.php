<?php

use LDAP\Result;

$data = file_get_contents("php://input");




$result=urldecode($data);
// echo(json_decode($data));
// echo(gettype($data));  


$result1=str_replace("re=","",$result);
$data1 = mb_detect_encoding($result1);
$json = json_decode($result1, true );

print_r($json);

?>