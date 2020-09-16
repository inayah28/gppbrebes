<?php
 include 'config.php';

  $no_do=$_POST['no_do'];
 	$no_so=$_POST['no_so'];
	$distributor=$_POST['distributor'];
	$user=$_POST['user']; 
	$tgl_pengiriman=$_POST['tgl_pengiriman'];
	$stok=$_POST['stok'];
	$keterangan=$_POST['keterangan'];
	$no_truk=$_POST['no_truk'];
	$nama_sopir=$_POST['nama_sopir'];

	$tombol=$_POST['proses'];
  $id=$_POST['id']; // dari parameter di pengeluaran.php pada bagian hapus

	//jika tombol di klik maka 
  if ($tombol=="tambah") {
      # code...
    
// mengurangi jmlparty pada tabel gudang berdasarkan no_so
  	$sql="select * from gudang where no_so='$no_so' and id_distributor='$distributor'"; //select tabel berdasarkan distributor dan noso
  	$cek=$dbh->query($sql)->fetch(); //disimpan dalam variabel cek 
  	if ($cek) { //jika nilai variabel cek itu ada 
  		$id=$cek['id_gudang']; //maka variable id berisi id gudang pada database gudang
  		$jml=$cek['jmlparty']-$stok; // dan variabel jml berisi jmlparty dikurangi stok yang diinput oleh user

      if($cek['jmlparty'] < $stok){ //jika jmlparty lebih kecil dari stok yang input 
        echo "mohon maaf stok tidak sesuai dengan permintaan"; //maka akan muncul pesan dan tidak akan melakukan instruksi lain 
        die(); // selesai pada instruksi ini 
      }
      //dbh  menjalankan query insert ke tabel pengeluaran 
      $dbh->query("INSERT INTO pengeluaran (id_pengeluaran,id_distributor, id_user,no_do,no_so,tgl_pengiriman,stok,keterangan,no_truk,nama_sopir) VALUES (NULL,'$distributor','$user','$no_do','$no_so','$tgl_pengiriman','$stok','$keterangan','$no_truk','$nama_sopir')");
      //dan setalah insert dbh mengupdate jmlpart dengan nilai variabel jml yaitu selisih dari jmlparty dengan stok di tabel gudang dengan konidsi idgudang sama dengan id.
  		$dbh->query("UPDATE gudang set jmlparty='$jml' where  id_gudang='$id'");
    }else{ //nilai cek tidak ada pada database 
      echo "nama distributor tidak ditemukan"; //maka akan muncul pesan
      die();
    }
  }else 
   {  //ngambil dari parameter di pengeluaran.php
      $id=$_GET['id'];
      $no_so=$_GET['no'];
      $dis=$_GET['dis'];
      $stok=$_GET['stok'];

      //
      $sql1="select * from gudang where no_so=$no_so and id_distributor=$dis";
      $a=$dbh->query($sql1)->fetch();
      $jml=$a['jmlparty'];
      $jml=$jml+$stok;//jml pada database gudang yaitu jmlpary di tambah stok yang dipilih user yang akan dihapus

      // update terlebih dahulu jmlpary dengan hasil perhitungan line 50
      $ubah="update gudang set jmlparty='$jml' where id_distributor=$dis and no_so=$no_so";
      $dbh->query($ubah); // dbh menjalankan query ubah
      //baru melakukan query delete sesuai id
      $sql=  "DELETE FROM `pengeluaran` WHERE `pengeluaran`.`id_pengeluaran` = $id";
      $dbh->query($sql); 
    }
  	header('location:pengeluaran.php'); //mengarah ke pengeluaran.php
?>