<?php
 include 'config.php';

  	$distributor=$_POST['distributor'];
  	#$user=$_POST['user'];
  	$tgl_order=$_POST['tgl_order'];
  	$tgl_pengiriman=$_POST['tgl_pengiriman'];
  	$no_so=$_POST['no_so'];
  	$stok=$_POST['stok'];

  	$dbh->query("INSERT INTO penerimaan (id_penerimaan,id_distributor, tgl_order,tgl_pengiriman,no_so,stok) VALUES (NULL,'$distributor','$tgl_order','$tgl_pengiriman','$no_so','$stok')");
    //jika noso sama maka akan update jmlparty, jika noso berbeda akan bertambah record baru.
  	$sql="select * from gudang where no_so='$no_so' and id_distributor='$distributor'";
  	$cek=$dbh->query($sql)->fetch();
  	if ($cek) {
  		$id=$cek['id_gudang'];
  		$stok=$stok+$cek['jmlparty'];
  		$dbh->query("UPDATE gudang set jmlparty='$stok' where  id_gudang='$id'");
  	}else{
  		$dbh->query("INSERT INTO gudang (id_distributor,no_so,jmlparty) VALUES ('$distributor','$no_so','$stok')");
  	}

  	header('location:penerimaan.php');

?>
