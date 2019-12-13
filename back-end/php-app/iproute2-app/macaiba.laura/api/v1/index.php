<?php

require 'util.php';

$op = $_GET['a'] ?? 'links';

if ( $op == 'links'){
    $result = shell_exec("ip addr show");
    $ip = ps_encode($result);
}
else if($op == 'link'){
    $facetoface = $_GET['link'] ?? '';
    $result = shell_exec("ip -s link show $facetoface");
    $ip = encode_ps($result,$facetoface);
}

header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
echo json_encode($ip);
?>