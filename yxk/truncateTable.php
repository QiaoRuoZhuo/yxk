<?php
    @session_start();
	@header("content-type:text/html;charset=utf-8");
	include("conn.php");
	
	$sql_truncate = "TRUNCATE TABLE km_tb"; //清空数据表
	$mysqli->query($sql_truncate);
	$mysqli->close(); 
	echo "<script>alert('清除选课信息成功！');</script>";
	echo "<script>window.location.href='adminMenu.php';</script>"; 
?>
  