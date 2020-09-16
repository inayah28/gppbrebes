<?php
 include 'config.php';

  	$nama=$_POST['nama'];
  	$alamat=$_POST['alamat'];
  	$nohp=$_POST['hp'];
  	$tombol=$_POST['proses'];
  	$id=$_POST['id'];
  	if ($tombol=="Tambah") { //jika yang di klik tombol tambah
  		# code...
  		$sql="INSERT INTO distributor (nama_distributor,alamat,no_hp) VALUES ('$nama','$alamat','$nohp')";
 		$dbh->query($sql); //variabel dbh akan menjalankan query variabel sql, variabel dbh adalah pdo pada config
  	}else if ($tombol=="Edit") { //jikn yang diklik tombol edit
  		# code...
  		$sql="UPDATE distributor SET
  					 `nama_distributor`='$nama',
  					 `no_hp`='$nohp',
  					 `alamat`='$alamat'
  					 WHERE `distributor`.`id_distributor`=$id";
  		$dbh->query($sql);
  	}

  	else{
  		$id=$_GET['id'];
  		$sql= "DELETE FROM `distributor` WHERE `distributor`.`id_distributor` = $id";
  		$dbh->query($sql);
  	}

  	header('location:vendor.php');

?>
