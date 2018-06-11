<?php
session_start();
include("conn.php");

$course = array(); 
$sexArray = array('m'=>'男', 'f'=>'女'); 
$courseArray = array("无名","物理","化学","生物","政治","历史","地理","技术");  //记录科目
$courseArray2 = array("无","物","化","生","政","史","地","技");  //记录科目

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
<title>管理用户</title>

</head>

<body>
<table width="80%" height="30" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
     <td><?php include("head.php"); ?></td>
    </tr>
</table>

<?php
if (isset($_SESSION['SuserType']) && $_SESSION['SuserType'] == 'g')//系统管理员登陆
{
?>
<form id="form0" name="form0" method="post" action="updateStudent">
<table width="80%" height="40" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <th colspan="2" align="center" height="40"><a href="printEnroll.php" target="_blank">打印3门课组合</a> </th>
    <th colspan="2" align="center" height="40"><a href="printEnroll2.php" target="_blank">打印2门课组合</a> </th>
    <th align="center"><a href="setClassName.php" target="_blank">设置班级</a></th>
    <th align="center"><a href="truncateTable.php" target="_blank">清空数据库</a></th>
    <th height="40" align="center">班 级
    <select name="className" id="className">
    <option value="">请选择</option>
    <?php
      for ($i=1; $i<=count($classNameArray); $i++)
      {
          echo '<option value="'. $classNameArray[$i] . '">' . $classNameArray[$i] . '</option>';
      }
    ?>
    </select></th>
    <th align="center">姓名
    <input name="studentName" type="text" id="studentName" size="5" /></th>
    <th align="center"><input type="submit" name="btn0" id="btn0" value="设置单个学生信息" /></th>
  </tr>
</table>
</form>

<form id="form2" name="form2" method="post" action="invisible.php">
<table width="80%" height="30" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th height="40" align="right">人数下限:&nbsp; </th>
    <th align = "left" > &nbsp;<input name="limitNum2" type="text" id="limitNum2" size="6"/></th>
    <?php 
      for ($num=1; $num<=7; $num++)
      {
          echo '<th align="center">' . $courseArray[$num] .'<input type="checkbox" name="course2[]" value="' . $num. '"  id="course2[]"' . '" />' . '</th>';
      }
    ?>
    <th align="center"><input type="submit" name="btn2" id="btn2" value="隐藏" /></th>
  </tr>
</table>
</form>

<form id="form3" name="form3" method="post" action="visible.php">
<table width="80%" height="30" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th height="40" align="right">人数下限:&nbsp; </th>
    <th align = "left" > &nbsp;<input name="limitNum3" type="text" id="limitNum3" size="6"/></th>
    <?php 
      for ($num=1; $num<=7; $num++)
      {
          echo '<th align="center">' . $courseArray[$num] .'<input type="checkbox" name="course3[]" value="' . $num. '"  id="course3[]"' . '" />' . '</th>';
      }
    ?>
    <th align="center"><input type="submit" name="btn3" id="btn3" value="显示" /></th>
  </tr>
</table>
</form>

<table width="80%" height="30" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="<?php echo count($classNameArray)+1; ?>" height="30" align="center">已交人数统计 </th>
  </tr>
  <tr>
    <th align="center" width="9%"> 班级</th>
    <?php
	  for ($i=1; $i<=count($classNameArray); $i++)
      {
		  echo '<th align="center" width="6.5%">' . $classNameArray[$i] . '</th>';
      }
    ?>
  </tr>
  <tr>
    <th align="center" > 人数</th>
    <?php
      for ($i=1; $i<=count($classNameArray); $i++)
      {
		  $queryString = "SELECT id FROM km_tb WHERE className='$classNameArray[$i]'";   
		  $resultSearch = $mysqli->query($queryString);
		  echo '<th align="center">' . $resultSearch->num_rows . '</th>';
      }
    ?>
  </tr>
</table>

<form id="form1" name="form1" method="post" action="">
<table width="80%" height="50" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th height="40" align="center">班 级
    <select name="className" id="className">
    <option value="">请选择</option>
    <?php
	  for ($i=1; $i<=count($classNameArray); $i++)
      {
          echo '<option value="'. $classNameArray[$i] . '">' . $classNameArray[$i] . '</option>';
      }
    ?>
    </select></th>
    <th align="center">性别
      <select name="sex" id="sex">
        <option value="">请选择</option>
        <option value="m">男</option>
        <option value="f">女</option>
    </select></th>
    <?php 
      for ($num=1; $num<=7; $num++)
      {
          echo '<th align="center">' . $courseArray[$num] .'<input type="checkbox" name="course[]" value="' . $num. '"  id="course[]"' . '" />' . '</th>';
      }
    ?>
    <th align="center"><input type="submit" name="btn" id="btn" value="查询" /></th>
  </tr>
</table>
</form>
        
<?php
$searchItem = array();

if (isset($_POST['btn']))
{
    foreach($_POST as $k=>$v) //获取查询条件
    {
        if ($k != 'btn' && $v != NULL)
        {
            $searchItem[$k] = $v;
        }
    }
}
else if(isset($_SESSION['sItem']))
{
    foreach($_SESSION['sItem'] as $k=>$v) //获取查询条件
    {
        if ($k != 'btn' && $v != NULL)
        {
            $searchItem[$k] = $v;
        }
    }
}
echo ' <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" style="background:url(images/bj1.jpg);font-size: 12px; border:solid 10px #dddddd">'; 
echo '<tr>';
echo '<th> 编号</th>';
echo '<th> 班级</th>';
echo '<th> 学号</th>';
echo '<th> 姓名</th>';
echo '<th> 性别</th>';
echo '<th> 组合</th>';
echo '<th> 课程1</th>';
echo '<th> 课程2</th>';
echo '<th> 课程3</th>';
echo '<th colspan="2"> 操作</th>';
echo '</tr>';

$queryString = "SELECT * FROM km_tb WHERE visible='1' AND "; 
if (count($searchItem) != 0)
{
    foreach($searchItem as $k=>$v) //获取查询条件
    {
		if ($k != 'course')
		{
			$queryString .= " $k = '" . $v . "' AND";
		}
        else
		{
			foreach($v as $item) //把数据插入到数据库表中
			{
				$courseName = "course" . $item;
				$queryString .= " $courseName = '1' AND";
			}
		}
    }
} 
$len = strlen($queryString);   
$queryString = substr($queryString, 0, $len-4); 

$resultSearch = $mysqli->query($queryString);
$total = $resultSearch->num_rows;

$num = 1;
if ($total==0)
{
   echo '<tr>';
   echo '<th align="center" colspan="11" height="40">' . '暂无数据！' . '</th>';
   echo '</tr>';
   echo '</table>';
}
else
{
    $result = $mysqli->query($queryString);
    while($row = $result->fetch_array()) 
    {
		$courseNum = 1;
		for ($i=1; $i<=7; $i++)
		{
			$courseName = "course" . $i;
			if ($row[$courseName] == 1)
			{
				$course[$courseNum++] = $i;
			}
		}
        echo '<tr>';
        echo '<td align="center">' . $num . '</td>';
        echo '<td align="center">' . $row['className'] . '</td>';
        echo '<td align="center">' . $row['studentNum'] . '</td>';
        echo '<td align="center">' . $row['studentName'] . '</td>';
        echo '<td align="center">' . $sexArray[$row['sex']] . '</td>';
		echo '<td align="center">' . $courseArray2[$course[1]].$courseArray2[$course[2]].$courseArray2[$course[3]] . '</td>';
        echo '<td align="center">' . $courseArray[$course[1]] . '</td>';
        echo '<td align="center">' . $courseArray[$course[2]] . '</td>';
        echo '<td align="center">' . $courseArray[$course[3]] . '</td>';
		echo '<td align="center">' .'<a href="javascript:if(confirm(' . "'确定隐藏该学生吗?'))location='invisibleItem.php?id=" . $row['id'] ."'" .'">隐藏</a>' . '</td>';
		echo '<td align="center">' . '<a href="javascript:if(confirm(' . "'确定删除该学生吗?'))location='deleteItem.php?id=" . $row['id'] ."'" .'">删除</a>' . '</td>';
        echo '</tr>';
        $num += 1;
    }  
    echo '</table>'; 
    $mysqli->close();
}
?>

<?php
}
else
{
	echo "<h1>系统管理员尚未登录！请登录系统管理员账号！</h1>";
}
?>
</body>
</html>
<?php include("bottom.php"); ?>