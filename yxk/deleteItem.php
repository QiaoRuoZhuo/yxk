<?php
session_start();
@header("content-type:text/html;charset=utf-8");
include("conn.php");

$id = $_GET["id"];
$sql_delete = "DELETE FROM km_tb WHERE id='$id'"; 
if ($mysqli->query($sql_delete))
{
	echo "<script>alert('操作成功！');</script>";
}
$mysqli->close();
echo "<script>window.location.href='adminMenu.php';</script>"; 
?>