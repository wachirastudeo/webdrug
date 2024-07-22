<?php

$pathservdrug = "/api/drug/read.php";
$pathservother = "/api/otherdrug/read.php";


$post_data = array(
  'item1' =>array(
    'item_type_id' => 1,
    'string_key' => 'AA',
    'string_value' => 'Hello',
    'string_extra' => 'App'

  ),  'item2' =>array(
    'item_type_id' => 2,
    'string_key' => 'AA',
    'string_value' => 'Hello',
    'string_extra' => 'App'

  )
);

echo json_encode($post_data);
?>