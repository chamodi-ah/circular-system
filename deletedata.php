<?php


require_once "conn/dbase.php";


function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $cid = $_POST["id"];

    if ($type == "del") {
        $conn->query("delete from c_tbl where c_id='$cid'");
    }

    echo "success";
    die();
}