<?php

require_once "conn/dbase.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $conn->query("
        UPDATE c_tbl set confirm=1 where c_id='$id'
    ");
    echo "success";
}