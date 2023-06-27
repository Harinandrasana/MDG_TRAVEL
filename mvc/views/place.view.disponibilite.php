<?php

$jsonString = json_encode($disponibiliteData);

header('Content-Type: application/json');

echo $jsonString;

?>