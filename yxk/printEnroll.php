<?php
session_start();
include("conn.php"); 

$sexArray = array('m'=>'男', 'f'=>'女'); 
$courseArray = array("无名","物理","化学","生物","政治","历史","地理","技术");  //记录科目
$courseArray2 = array("无","物","化","生","政","史","地","技");  //记录科目
$numArray = array()
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打印3门课组合信息</title>
</head>

<body>
<?php  
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

arsort($numArray); //按照人数排序

echo '<table width="40%" border="1" align="center" cellpadding="0" cellspacing="0">'; 
echo '<tr>';
echo '<th> 编号</th>';
echo '<th> 组合</th>';
echo '<th> 人数</th>';
echo '</tr>';

$num = 1;
foreach($numArray as $x=>$v)
{ 
	$i = intval($x / 100);
	$j = intval($x / 10) % 10;
	$k = $x % 10;
    echo '<tr>';
	echo '<td align="center">' . $num . '</td>';
	echo '<td align="center">' . $courseArray2[$i].$courseArray2[$j].$courseArray2[$k] . '</td>';
	echo '<td align="center">' . $v . '</td>';
	echo '</tr>';
	$num += 1;
}
echo '</table>'; 

echo '<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">'; 
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
echo '</tr>';

foreach($numArray as $x=>$v)
{ 
	$i = intval($x / 100);
	$j = intval($x / 10) % 10;
	$k = $x % 10;
	$courseName1 = "course" . $i;
	$courseName2 = "course" . $j;
	$courseName3 = "course" . $k;
	
    $queryString = "SELECT * FROM km_tb WHERE visible='1' AND " . $courseName1 . "='1' AND " . $courseName2 . "='1' AND " . $courseName3 . "='1'";   
	$resultSearch = $mysqli->query($queryString);
	$total = $resultSearch->num_rows;
	
	$num = 1;
	if ($total > 0)
	{
		$result = $mysqli->query($queryString);
		while($row = $result->fetch_array()) 
		{
			echo '<tr>';
			echo '<td align="center">' . $num . '</td>';
			echo '<td align="center">' . $row['className'] . '</td>';
			echo '<td align="center">' . $row['studentNum'] . '</td>';
			echo '<td align="center">' . $row['studentName'] . '</td>';
			echo '<td align="center">' . $sexArray[$row['sex']] . '</td>';
			echo '<td align="center">' . $courseArray2[$i].$courseArray2[$j].$courseArray2[$k] . '</td>';
			echo '<td align="center">' . $courseArray[$i] . '</td>';
			echo '<td align="center">' . $courseArray[$j] . '</td>';
			echo '<td align="center">' . $courseArray[$k] . '</td>';
			echo '</tr>';
			$num += 1;
		}   
	}
}
echo '</table>'; 
$mysqli->close();
?>

</body>
</html>