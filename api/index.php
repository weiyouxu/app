<?php

// header("Content-Type:application/json;charset=utf-8");
// mysql_query("set names gb2312");

$con = mysql_connect("localhost","root","");
$select_db = mysql_select_db('huolanapp');
if (!$select_db) {
    die("could not connect to the db:\n" .  mysql_error());
}
//查询代码
function selectInfo(){
	$name=$_POST['name'];
	$sql = "SELECT * FROM `info` WHERE `name` LIKE '$name'";
	$res = mysql_query($sql);
	if (!$res) {
		die("could get the res:\n" . mysql_error());
	}
	while ($row = mysql_fetch_assoc($res)) {
		print_r($row);
	}
	
};
//查询代码
// 插入数据
function insertInfo (){
	@header('Content-Type: application/json; charset=UTF-8');
	
	$name=$_POST['name'];
	$password=$_POST['password'];
	$createtime=date("Y-m-d H:i:s");
	$arr = array();
	
	$sql = "SELECT * FROM `info` WHERE `name` LIKE '$name'";
	$res = mysql_query($sql);
	if (!$res) {
		die("could get the res:\n" . mysql_error());
	}
	while ($row = mysql_fetch_assoc($res)) {
		var_dump(  $row);
		// print_r($row);
		$arr = $row;
	}

	$result = count($arr);
	if($result == 0){
		$sqlInsert =  "INSERT INTO `huolanapp`.`info` (`id`, `name`, `password`, `time`) VALUES (NULL,'$name','$password','$createtime')";
		$sql=mysql_query($sqlInsert);
		if($sql){
			echo "注册成功";
		}
	}else{
		echo "你已经注册。";
		return false;
	}
};
insertInfo();
// 插入数据


//关闭数据库连接
mysql_close($con);
?>
