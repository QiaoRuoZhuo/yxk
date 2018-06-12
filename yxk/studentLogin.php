<?php
session_start();
include("conn.php");

$classNameArray = array();  //记录班级名称
$sql = "SELECT id, className FROM className_tb ORDER BY id";
$result = $mysqli->query($sql);
while ($row = $result->fetch_array()) 
{
	$classNameArray[$row['id']] = $row['className'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>预选课系统学生登陆页面</title>
	<script language="javascript">
			 
	function chkinput(form)
	{
		if (form.className.value=="")
		{
			alert('请选择班级');
			form.className.focus();
			return false;
		}
		
		if (form.studentNum.value=="")
		{
			alert('请输入学号');
			form.studentNum.focus();
			return false;
		}
		
		if (form.studentName.value=="")
		{
			alert('请输入姓名');
			form.studentName.focus();
			return false;
		}
		
		if(form.sex.value=="")
		{
		   alert("请选择性别！");
		   form.sex.focus();
		   return false;
		} 
		
		if (form.password.value=="")
		{
			alert('请输入密码');
			form.password.focus();
			return false;
		}

		return true;
	}
	</script>
</head>

<body>
<form id="form1" name="form1" method="post" action="updateEnroll.php" onsubmit="return chkinput(this)">
  <table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:12px;height:260px">
    <tr>
      <th height="40" align="right">班 级:&nbsp;</th>
      <th align="left" > &nbsp;<select name="className" id="className">
      <option value="">请选择</option>
      <?php
		for ($i=1; $i<=count($classNameArray); $i++)
		{
			echo '<option value="'. $classNameArray[$i] . '">' . $classNameArray[$i] . '</option>';
		}
      ?>
      </select></th>
    </tr>
    <tr>
      <th align="right">学 号:&nbsp;</th>
      <th align="left"> &nbsp;<input name="studentNum" type="text" id="studentNum" size="10"/></th>
    </tr>
    <tr>
      <th height="40" align="right">姓 名:&nbsp; </th>
      <th align = "left" > &nbsp;<input name="studentName" type="text" id="studentName" size="10"/></th>
    </tr>
    <tr>
      <th align="right">性 别:&nbsp; </th>
      <th align = "left"> &nbsp;<select name="sex" id="sex">
      <option value="">请选择</option>
      <option value="m">男</option>
      <option value="f">女</option>
      </select></th>
    </tr>
    <tr>
      <th height="40" align="right">密 码:&nbsp; </th>
      <th align = "left" > &nbsp;<input name="password" type="password" id="password" size="10"/></th>
    </tr>
    <tr>
      <th colspan="2" height="40" align="center"><input type="submit" name="submit" id="submit" value="登陆" /></th>
    </tr>
  </table>
 
</form>
</body>
</html>