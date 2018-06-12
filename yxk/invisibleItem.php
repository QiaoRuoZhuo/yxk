<?php
session_start();
@header("content-type:text/html;charset=utf-8");
include("conn.php");

$id = $_GET["id"];
$sql_update = "UPDATE km_tb SET visible='0' WHERE id='$id'"; 
if ($mysqli->query($sql_update))
{
	echo "<script>alert('操作成功！');</script>";
}
$mysqli->close();
echo "<script>window.location.href='adminMenu.php';</script>"; 
?>