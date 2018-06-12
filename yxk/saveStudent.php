<?php
session_start();
@header("content-type:text/html;charset=utf-8");
include("conn.php");

if (isset($_POST['submit']))
{ 
	if (count($_POST["course"]) != 3)
	{
		echo "<script>alert('勾选3门学科!');</script>";
		echo "<script>window.location.href='updateStudent.php';</script>"; 
	}
			
	$password = trim($_POST['password']);
	$visible = $_POST['visible'];
	$studentID = $_POST['studentID'];
	
	$sql_update = "UPDATE km_tb SET password = '$password', visible = '$visible' WHERE id = '$studentID'"; 
	if (!$mysqli->query($sql_update))
	{
		echo "<script>alert('修改学生信息失败！');</script>";
	}
		
	for ($i=1; $i<=7; $i++) //先假设所有科目都未选
	{
		$courseName = "course" . $i;
		$sql_update = "UPDATE km_tb SET " . $courseName . " = '0' WHERE id = '$studentID'"; 
		if (!$mysqli->query($sql_update))
		{
			echo "<script>alert('修改选课信息失败！');</script>";
		}
	}
	
	foreach($_POST["course"] as $item) //把数据插入到数据库表中
	{
		$courseName = "course" . $item;
		$sql_update = "UPDATE km_tb SET " . $courseName . " = '1' WHERE id = '$studentID'"; 
		if (!$mysqli->query($sql_update))
		{
			echo "<script>alert('修改选课信息失败！');</script>";
		}
	}
	$mysqli->close();
	echo "<script>alert('修改学生信息成功！');</script>";
		
	echo "<script>window.location.href='adminMenu.php';</script>"; 
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>保存学生信息</title>
</head>

<body>
</body>
</html>