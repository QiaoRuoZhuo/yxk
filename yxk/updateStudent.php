<?php
session_start();
include("conn.php");

$sexArray = array('m'=>'男', 'f'=>'女'); 
$courseArray = array("无名","物理","化学","生物","政治","历史","地理","技术");  //记录科目

if (isset($_POST['btn0']) && isset($_POST['className']) && isset($_POST['studentName']))
{
	$className = $_POST['className'];
	$studentName = trim($_POST['studentName']);
	
	$sql_select = "SELECT * FROM km_tb WHERE className='$className' AND studentName='$studentName'"; 
	$result = $mysqli->query($sql_select);
	$total = $result->num_rows;
	
	if ($total == 0)//该学生不存在
	{ 
		echo "<script>alert('该学生不存在!');</script>";
		echo "<script>window.location.href='adminMenu.php';</script>"; 
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
<title>修改学生选课信息页面</title>
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
<form id="form1" name="form1" method="post" action="saveStudent.php" onsubmit="return chkinput(this)">
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
      <th align="right">隐 藏:&nbsp; </th>
      <?php
      if ($row['visible'] == '0')  
	  {
		  echo '<th align = "left"> &nbsp;<select name="visible" id="visible">
			  <option value="0" selected="selected">是</option>
			  <option value="1">否</option>
			  </select></th>';
	  }
	  else
	  {
		  echo '<th align = "left"> &nbsp;<select name="visible" id="visible">
			  <option value="0">是</option>
			  <option value="1" selected="selected">否</option>
			  </select></th>';
	  }
	  ?>
      <th colspan="4" height="40" align="center"><input type="submit" name="submit" id="submit" value="提交选课信息" /></th>
    </tr>
  </table>
 
</form>

</body>
</html>
<?php include("bottom.php"); ?>