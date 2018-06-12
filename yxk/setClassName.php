<?php
session_start();
include("conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>设置班级数量</title>

</head>

<body>

<?php
if (isset($_POST['submit']) && isset($_POST['classNum']))
{
    $classNum = intval(trim($_POST['classNum']));
	if ($classNum > 0)
	{
		$sql_truncate = "TRUNCATE TABLE className_tb"; //清空数据表
		$mysqli->query($sql_truncate);
		for ($i=1; $i<=$classNum; $i++)
		{
			$sql_insert = "INSERT INTO className_tb" . " (className) VALUES ('$i')"; 
			$mysqli->query($sql_insert); //存储班级信息
		}
		
		echo '<form id="form2" name="form2" method="post" action="saveClassName.php">
		      <input type="hidden" name="totalNum" id="totalNum" value="' . $classNum . '"/>
			  <table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:20px">
	           <tr>
			     <th align="center" width="50%" height="30">序号</th>
      			 <th align="center">班级</th>
			   </tr>';
		for ($num=1; $num<=$classNum; $num++)
		{
			echo '<tr>';
			echo '<td align="center">' . $num . '</td>';
			echo '<td align="center">' . '<input name="className' . $num . '" type="text" id="className' . $num . '" value="' . $num. '" size="10"/>' . '</td>';
			echo '</tr>';
		}
		echo '<tr>
				 <th height="30" colspan="2" ><input type="submit" name="submit2" id="submit2" value="提交" /></th>
			 </tr>
		   </table>
         </form>';
	}
	else
	{
		echo "<script>alert('请输入正确的数字!');</script>";
		echo "<script>window.location.href='setClassName.php';</script>"; 
	} 
}
else
{
?>
<div align="center">
  <form id="form1" name="form1" method="post" action="">
    <table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);border:solid 8px #dddddd;font-size:30px;height:160px">
      <tr>
          <th width="100%" align="center" height="30%" style="font-size: 30px"> 请输入班级数量</th>
      </tr>
      <tr>
          <th align = "center" height="40%"><input name="classNum" type="text" id="classNum" size="5" /></th>
      </tr>
      <tr>
         <th height="30%"><div align="center">
                <input type="submit" name="submit" id="submit" value="提交" />
            </div></th>
      </tr>
    </table>
  </form>
</div>
<?php } ?>
  
</body>
</html>