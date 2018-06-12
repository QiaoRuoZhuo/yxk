<?php
$db_host="localhost";                                           //连接的服务器地址
$db_user="root";                                                  //连接数据库的用户名
$db_psw="lzy";                                                  //连接数据库的密码
$db_name="yxk_db";                                           //连接的数据库名称
$mysqli = new mysqli($db_host,$db_user,$db_psw,$db_name);
if (mysqli_connect_error())
{
	printf("连接失败：%s\n", mysqli_connect_error());
	exit();
}

$mysqli->query("set names utf8");  //确定编码

date_default_timezone_set("Asia/Shanghai");//设置默认时区
?>