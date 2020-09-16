<?php
	include "config.php";
	$user=$_POST['username'];
	$pass=$_POST['password'];

	$sql="select * from user where username='$user' and password='$pass'";
	$do=$dbh->query($sql);
	$field=$do->fetch();

	if ($field) {
		session_start();
		//menyimpan sementara
		$_SESSION['id']=$field['id_user'];
		$_SESSION['nama']=$field['nama'];
		$_SESSION['username']=$field['username'];
		$_SESSION['password']=$field['password'];

		header('location:home.php');
	}else{
		header('location:index.php');
	}

 ?>
