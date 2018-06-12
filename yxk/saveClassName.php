<?php
session_start();
@header("content-type:text/html;charset=utf-8");
include("conn.php");

if (isset($_POST['submit2']))
{ 
	for ($num = 1; $num<= $_POST["totalNum"]; $num++) //依次处理每一个班级
	{ 
		$classNameid = 'className' . $num; 
		$className = trim($_POST["$classNameid"]);//存储班级名称
		$sql_update = "UPDATE className_tb SET className= '$className' WHERE id = '$num'"; 
		if (!$mysqli->query($sql_update))
		{
			echo "<script>alert('设置班级名称失败！');</script>";
		}
	}
	
	$mysqli->close(); 
	echo "<script>alert('设置班级名称成功！');</script>";
	echo "<script>window.location.href='adminMenu.php';</script>";  
}
?>