<?php
include 'db.php';


$status = $_GET['status'];
$id = $_GET['id'];
mysql_query("UPDATE tbl_mock SET fk_status='$status' WHERE id=$id");
echo "Record updated successfully";
?>