<?php
$db = mysqli_connect("localhost","root","","coba");
if(!$db){
    echo "Database connect error";
}

// $mqtt = $_POST['topicid'];

$list = array();
$result = $db->query("select value from mqtt_history WHERE topicid = 1 ORDER BY id DESC LIMIT 1;");
//$result['value'] = json_decode($result->value,true);
if($result){
    while ($row = $result->fetch_assoc()){
        $list[] = json_decode($result, true);
    }
    //$php_array= json_decode($json_data, true);

    return response()->json($list);
    //echo json_encode($list);
}
// $row = mysqli_fetch_assoc($result);
// $row = json_decode($row,true);
return response()->json($row);