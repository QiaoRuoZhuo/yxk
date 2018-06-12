<?php
session_start();
include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登陆</title>

</head>

<body>

<?php
if (isset($_POST['submit']) && isset($_POST['password']))
{
	if ($_POST['password'] == 'jwc') //此处可以设置任意密码
	{
		$_SESSION['SuserType'] = 'g';
        echo "<script>window.location.href='adminMenu.php';</script>"; 
	}
	else
	{
		session_destroy();
		echo "<script>alert('密码错误!');</script>";
		echo "<script>window.location.href='login.php';</script>"; 
	} 
}
else
{
?>
<div align="center">
  <form id="form1" name="form1" method="post" action="">
    <table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:30px;height:160px">
      <tr>
          <th width="100%" align="center" height="30%" style="font-size: 30px"> 请输入登陆密码</th>
      </tr>
      <tr>
          <th align = "center" height="40%"><input name="password" type="password" id="password" size="10"/></th>
      </tr>
      <tr>
         <th height="30%"><div align="center">
                <input type="submit" name="submit" id="submit" value="登陆" />
            </div></th>
      </tr>
    </table>
  </form>
</div>
<?php } ?>
  
</body>
</html>