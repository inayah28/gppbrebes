<?php
 include 'config.php';

  	$nama=$_POST['nama'];
  	$user=$_POST['username'];
  	$pass=$_POST['password'];
  			$sql="INSERT INTO user (nama,user,passsword) VALUES ('$nama','$user','$pass')";
 		$dbh->query($sql); 
  	header('location:vendor.php');

?>