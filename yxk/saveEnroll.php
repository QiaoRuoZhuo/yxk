<?php
session_start();
include("conn.php");

$sexArray = array('m'=>'男', 'f'=>'女'); 
$courseArray = array("无名","物理","化学","生物","政治","历史","地理","技术");  //记录科目

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选课成功页面</title>
</head>

<body>
<table width="80%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
     <td><?php include("head.php"); ?></td>
    </tr>
</table>
<?php
if (isset($_POST['submit']))
{ 
	if (count($_POST["course"]) != 3)
	{
		echo "<script>alert('勾选3门学科!');</script>";
		echo "<script>window.location.href='index.php';</script>"; 
	}
					 
	$className = $_POST['className'];
	$sex = $_POST['sex'];
	$studentNum = trim($_POST['studentNum']);
	$studentName = trim($_POST['studentName']);
	$password = trim($_POST['password']);
	
	$sql_select = "SELECT id FROM km_tb WHERE className='$className' AND studentNum='$studentNum' AND studentName='$studentName' AND sex='$sex'"; 
	$result = $mysqli->query($sql_select);
	$total = $result->num_rows;
	
	if ($total > 0)//该学生已经报名过
	{ 
		echo "<script>alert('你已经选过课了，请登陆修改选课页面!');</script>";
		echo "<script>window.location.href='studentLogin.php';</script>"; 
	}
	else //插入新学生信息
	{
		$sql_insert = "INSERT INTO km_tb" . 
					" (className, studentNum, studentName, sex, password) 
					   VALUES ('$className', '$studentNum', '$studentName', '$sex', '$password')"; 
		$mysqli->query($sql_insert); //存储学生基本信息
		$studentID = $mysqli->insert_id;//记录学生的id
		for ($i=1; $i<=7; $i++) //先假设所有科目都未选
		{
			$courseName = "course" . $i;
			$sql_update = "UPDATE km_tb SET " . $courseName . " = '0' WHERE id = '$studentID'"; 
			if (!$mysqli->query($sql_update))
			{
				echo "<script>alert('插入选课信息失败！');</script>";
			}
		}
		
		foreach($_POST["course"] as $item) //把数据插入到数据库表中
		{
			$courseName = "course" . $item;
			$sql_update = "UPDATE km_tb SET " . $courseName . " = '1' WHERE id = '$studentID'"; 
			if (!$mysqli->query($sql_update))
			{
				echo "<script>alert('插入选课信息失败！');</script>";
			}
		}  
	}
	$mysqli->close();
	echo "<script>alert('选课成功！');</script>";
	echo '<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:12px;height:80px">
    <tr>
      <th height="40" align="right"">班 级:&nbsp;</th>
      <th align="left"> &nbsp;' . $className . '</th>
      <th align="right">学 号:&nbsp;</th>
      <th align="left"> &nbsp;' . $studentNum . '</th>
      <th align="right" >姓 名:&nbsp; </th>
      <th align = "left" > &nbsp;' . $studentName . '</th>
      <th align="right">性 别:&nbsp; </th>
      <th align = "left"> &nbsp;' . $sexArray[$sex] . '</th>
	  <th align="right">选 课 组 合:&nbsp; </th>
	  <th align = "left"> &nbsp;';
	  
	  foreach($_POST["course"] as $item) //把数据插入到数据库表中
	  {
		  echo $courseArray[$item] . '&nbsp;';
	  }  
	  
     echo '</th>
    </tr>
	<tr>
	<th colspan="10" align="center" height="40"><a href="index.php">安 全 退 出</a></th>
	</tr>
	</table>';
}
?>
</body>
</html>