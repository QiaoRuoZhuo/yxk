<?php
session_start();
include("conn.php");

$sexArray = array('m'=>'男', 'f'=>'女'); 
$courseArray = array("无名","物理","化学","生物","政治","历史","地理","技术");  //记录科目

if (isset($_POST['submit']) && isset($_POST['className']) && isset($_POST['studentNum']) && isset($_POST['studentName']) && isset($_POST['sex']) && isset($_POST['password']))
{
	$className = $_POST['className'];
	$sex = $_POST['sex'];
	$studentNum = trim($_POST['studentNum']);
	$studentName = trim($_POST['studentName']);
	$password = trim($_POST['password']);
	
	$sql_select = "SELECT * FROM km_tb WHERE className='$className' AND studentName='$studentName' AND sex='$sex' AND studentNum='$studentNum' AND password='$password'"; 
	$result = $mysqli->query($sql_select);
	$total = $result->num_rows;
	
	if ($total == 0)//该学生不存在
	{ 
		echo "<script>alert('该学生不存在或密码错误!');</script>";
		echo "<script>window.location.href='studentLogin.php';</script>"; 
	}
	else //更新学生信息
	{
		$row = $result->fetch_array();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改选课信息页面</title>
</head>
	
<script language="javascript">
			 
function chkinput(form)
{
	if (form.password.value=="")
	{
		alert('请输入密码');
		form.password.focus();
		return false;
	}
	
	var sum = 0;
    var courses = document.getElementsByName("course[]");  
    for (var i=0; i<courses.length; i++)
	{  
        if (courses[i].checked)
		{  
            sum += 1;  
        }  
    }  
	
	if (sum != 3)
	{
		alert('勾选3门学科');
		return false;
	}
	
	return true;
}
			  
 </script>

<body>
<table width="80%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
     <td><?php include("head.php"); ?></td>
    </tr>
</table>
<form id="form1" name="form1" method="post" action="saveUpdateEnroll.php" onsubmit="return chkinput(this)">
  <input type="hidden" name="studentID" id="studentID" value="<?php echo $row['id']; ?>"/>
  <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:12px;height:80px">
    <tr>
      <th height="40" align="right" width="10%">班 级:&nbsp;</th>
      <th align="left" width="10%"> &nbsp;<?php if ($row)  echo $row['className']; ?></th>
      <th align="right" width="10%">学 号:&nbsp;</th>
      <th align="left" width="10%"> &nbsp;<?php if ($row)  echo $row['studentNum']; ?></th>
      <th height="40" align="right" width="10%">姓 名:&nbsp; </th>
      <th align = "left" > &nbsp;<?php if ($row)  echo $row['studentName']; ?></th>
      <th align="right">性 别:&nbsp; </th>
      <th align = "left"> &nbsp;<?php if ($row)  echo $sexArray[$row['sex']]; ?></th>
    </tr>
    <tr>
      <th align="center" height="40" width="10%">勾选3门学科</th>
      <?php 
	  	for ($num=1; $num<=7; $num++)
		{
			echo '<th align="center" width="10%">' . $courseArray[$num] .'<input type="checkbox" name="course[]" value="' . $num. '"  id="course[]"';
			$courseName = "course" . $num;
			if ($row[$courseName] == '1')
			{
				echo ' checked="true"';
			}
			echo '/>'. '</th>';
		}
	  ?>
    </tr>
    <tr>
      <th height="40" align="right">密 码:&nbsp; </th>
      <th align = "left" > &nbsp;<input name="password" type="text" id="password" size="10" value=" <?php if ($row)  echo $row['password']; ?> " /></th>
      <th colspan="3" align="center" height="40"><a href="index.php">不做修改，直接返回</a></th>
      <th colspan="3" height="40" align="center"><input type="submit" name="submit" id="submit" value="提交选课信息" /></th>
    </tr>
  </table>
 
</form>

</body>
</html>
<?php include("bottom.php"); ?>