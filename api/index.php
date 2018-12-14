<?php

error_reporting(0);
header("Content-Type:application/json;charset=utf-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

// mysql_query("set names gb2312");

$con = mysql_connect("localhost","root","");
$select_db = mysql_select_db('huolanapp');
if (!$select_db) {
    die("could not connect to the db:\n" .  mysql_error());
}

$type = $_POST['type'];

if($type == "forgetPassword"){
	// 忘记密码
	forgetPassword();
}else if($type == "insertInfo") {
	// 注册插入数据
	insertInfo();
}else{
	// 登录
	login();
}
// 插入数据
function insertInfo (){
	// @header('Content-Type: application/json; charset=UTF-8');
	$name=$_POST['name'];
	$password=$_POST['password'];
	$email=$_POST['email'];
	$createtime=date("Y-m-d H:i:s");
	$arr = array();
	
	$sql = "SELECT * FROM `info` WHERE `name` LIKE '$name'";
	
	$res = mysql_query($sql);

	if (!$res) {
		die("could get the res:\n" . mysql_error());
	}
	while ($row = mysql_fetch_assoc($res)) {
		// var_dump(  $row);
		// print_r($row);
		$arr = $row;
	}

	$result = count($arr);
	if($result == 0){
		$sqlInsert =  "INSERT INTO `huolanapp`.`info` (`id`, `name`, `password`,`email`,`time`) VALUES (NULL,'$name','$password','$email','$createtime')";
		$sql=mysql_query($sqlInsert);
		if($sql){
			echo "注册成功";
		}
	}else{
		echo "你已经注册。";
		return false;
	}
};
// insertInfo();
// 插入数据
// 找回密码
function forgetPassword(){
	$email= $_POST['email'];
	$json_string = json_encode($email, JSON_FORCE_OBJECT);
	echo $json_string;
	$sql = "SELECT * FROM `info` WHERE `email` LIKE '$json_string'";
	$res = mysql_query($sql);
	echo $res;
	if (!$res) {
		die("could get the res:\n" . mysql_error());
	}
	while ($row = mysql_fetch_assoc($res)) {
		// var_dump(  $row);
		// print_r($row);
		print_r($arr);
	}

	// return json_encode($arr);
}
// 找回密码

// 登录
function login(){
	echo "000";
}

//关闭数据库连接
mysql_close($con);

?>
