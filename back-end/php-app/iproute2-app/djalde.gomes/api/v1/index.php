<?php

require "util.php";

$action = $_GET['a'] ?? 'links';

if ($action == 'links') {
    $result = shell_exec("ip add");
    $array = top_encode($result);
    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");
    echo json_encode($array);
} else if ($action == 'link') {
    $link = $_GET['link'];
    $result = shell_exec("ip -s link show $link");
    $array=encode_1($result);
    header("Content-type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");
    echo json_encode($array);
}

?>

