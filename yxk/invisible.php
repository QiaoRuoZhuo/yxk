<?php
session_start();
@header("content-type:text/html;charset=utf-8");
include("conn.php");

if (isset($_POST['btn2']) && (isset($_POST["limitNum2"]) || isset($_POST["course2"])))
{ 
	if (isset($_POST["course2"]))
	{
		$sql_update = "UPDATE km_tb SET visible='0' WHERE "; 
		foreach($_POST["course2"] as $item)  
		{
			$courseName = "course" . $item;
			$sql_update .= $courseName . " = '1' AND "; 
		}  
		$len = strlen($sql_update);   
		$sql_update = substr($sql_update, 0, $len-4); 
		if ($mysqli->query($sql_update))
		{
			echo "<script>alert('操作成功！');</script>";
		}
	}
	else if (isset($_POST["limitNum2"]))
	{
		$numArray = array();
		for ($i=1; $i<=5; $i++)
		{
			for ($j=$i+1; $j<=6; $j++)
			{
				for ($k=$j+1; $k<=7; $k++)
				{
					$courseName1 = "course" . $i;
					$courseName2 = "course" . $j;
					$courseName3 = "course" . $k;
					$numKey = 100 * $i + 10 * $j + $k; 
					
					$queryString = "SELECT id FROM km_tb WHERE visible='1' AND " . $courseName1 . "='1' AND " . $courseName2 . "='1' AND " . $courseName3 . "='1'";   
					$resultSearch = $mysqli->query($queryString);
					$numArray[$numKey] = $resultSearch->num_rows;
				}
			}
		}
		
		foreach($numArray as $x=>$v)
		{ 
			$i = intval($x / 100);
			$j = intval($x / 10) % 10;
			$k = $x % 10;
			$courseName1 = "course" . $i;
			$courseName2 = "course" . $j;
			$courseName3 = "course" . $k;
			if ($v >= $_POST["limitNum2"])
			{ 
				$sql_update = "UPDATE km_tb SET visible='0' WHERE " . $courseName1 . "='1' AND " . $courseName2 . "='1' AND " . $courseName3 . "='1'";  
				if (!$mysqli->query($sql_update))
				{
					echo "<script>alert('操作失败！');</script>";
				}
			}
		}
	}
	
	$mysqli->close();
	echo "<script>window.location.href='adminMenu.php';</script>"; 
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
</html>