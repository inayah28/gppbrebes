<?php include "header.php" ?>
<style type="text/css">
	 .btn{

            position: absolute;
            right: 30px;
            }
            .yth{
            display: grid;
            grid-template-columns: 50% 50%;
            }
            .ttd{
                display: grid;
                grid-template-columns: 50% 50%;
            }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Penerimaan</h1>
        </div>
        <!-- /.col-lg-12 -->
   	</div>
    <div class="row">
    	<div class="col-sm-4">
    		<form method="post" action="tambahpenerimaan.php">
    			<input type="hidden" name="user" value="<?php echo $_SESSION['id'] ?>">
    			<select class="form-control" name="distributor">
    			<?php
    				$sql="select * from distributor";
    				$do=$dbh->query($sql);
    				foreach ($do as $a) {
    					# code...
    					echo "<option value='$a[id_distributor]'>$a[nama_distributor]</option>";
    				}
    			 ?>


    			</select> <br>
    			<div class="form-group input-group">
    				<span class="input-group-addon">Tanggal Order</span>
    				<input class="form-control" type="date" name="tgl_order" placeholder="Tanggal Order Distributor">
    			</div>
    			<div class="form-group input-group">
    				<span class="input-group-addon">Tanggal Pengiriman</span>
    				<input class="form-control" type="date" name="tgl_pengiriman" style="width: 80%">
    			</div>

    			<input class="form-control" type="text" name="no_so" placeholder="Nomor SO"><br>
    			<input class="form-control" type="number" name="stok" placeholder="Stok"><br>
    			<input type="submit" name="proses" value="tambah" onclick="tampil()" class="btn btn-info">
    		</form>
    	</div>

    	<div class="col-sm-8">

            <h3 align="center"><b>Surat Keterangan Penerimaan Pupuk</b></h3>
            <p class="text-center" id="noso1">No. </p><br><br>
            <div class="yth" >
                <div>
                    <p>Kepada Yth,</p>
                    <p id="penyalur1"></p>
                    <p id="alamat">Alamat</p>
                    <p>Jawa Tengah -Indonesia</p><br>
                    <br>
                </div>
                <div align="right">
                    <p>Disiapkan oleh : </p>
                    <p>GPP BREBES</p>
                    <p>Stasiun Prupuk, Kec. Margasari Kab Tegal</p>
                    <p>Jawa Tengah-Indonesia</p>
                </div>
            </div>
            <br>
            <p> Dengan surat ini, dinyatakan bahwa GPP BREBES telah menerima pupuk dengan data sebagai berikut : </p>
            <div align="left-center" style="padding: 20px;">
                <table style="width: 50% ">

                    <tr>
                        <th><p>Tanggal</p></th>
                        <td>  : </td>
                        <td id="tanggal1"></td>
                    </tr>
                    <tr>
                        <th><p>Tanggal</p></th>
                        <td>  : </td>
                        <td id="tanggal2"></td>
                    </tr>
                    <tr>
                        <th><p>Tonage </p></th>
                        <td>: </td>
                        <td id="jmlparty1"></td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <br>
            <div class="ttd" align="center">
                <div>
                    <p>Diserakankan oleh</p> <br><br><br>
                    <label id="nm_sopir1"><p>Nama Sopir</p></label>
                </div>
                <div>
                    <p>Diterima oleh </p><br><br><br>
                    <p><b>AMJAD</b></p>
                    <p>Kepala Gudang Prupuk </p>
                </div>
            </div>

        </div>

    	<table class="table table-hover">
			<thead>
				<th>No</th>
				<th>Distributor</th>

				<th>Tanggal Order</th>
				<th>Tanggal Pengiriman</th>
				<th>Nomot SO</th>
				<th>Stok</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				<?php
    				$sql="SELECT * FROM `distributor`,penerimaan where distributor.id_distributor=penerimaan.id_distributor ";
    				$do=$dbh->query($sql); //menjalankan sql
    				$no=1;
    				foreach ($do as $v) {
    					echo "
    						<tr>
				    			<td>$no</td>
				    			<td>$v[nama_distributor]</td>
				    			
				    			<td>$v[tgl_order]</td>
				    			<td>$v[tgl_pengiriman]</td>
				    			<td>$v[no_so]</td>
				    			<td>$v[stok]</td>
				    			<td><a href='tambahpenerimaan.php?id=$v[id_penerimaan]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok] '";?> onclick="javascript:return confirm('Anda Yakin?')" <?php echo " class='btn btn-danger' name='proses'>Hapus</a> </td>
				    		</tr>
    					";
    					$no++;
    				}
				?>
			</tbody>
		</table>
    </div>
</div>
<script>
function tampil(){
	document.getElementById("nodo1").innerHTML=$("[name='no_so']").val();
	document.getElementById("penyalur1").innerHTML=$("[name='distributor']").val();
	document.getElementById("notruk1").innerHTML=$("[name='notruk']").val();

	document.getElementById("tanggal2").innerHTML=$("[name='tgl_order']").val();
	document.getElementById("tanggal1").innerHTML=$("[name='tgl_pengiriman']").val();

	document.getElementById("jmlparty1").innerHTML=$("[name='stok']").val();

	var distributor=document.getElementById("distributor");
		if (distributor.value=="CV. BREBES PUTRA") {
			document.getElementById("alamat").innerHTML="Jl. Raya Kluwut No.76 Bulakamba Brebes";
		}else if(distributor.value=="CV. TANI MAKMUR"){
			document.getElementById("alamat").innerHTML="Jl.Raya Kalierang No. 163 Bumiayu";
		} else if(distributor.value=="CV. KARTIKA TANI"){
			document.getElementById("alamat").innerHTML="Jl. Merdeka No. 199 Banjarharjo";
		} else if(distributor.value=="CV. LARANGAN TETAP JAYA"){
			document.getElementById("alamat").innerHTML="Jl. Pramuka Ds. Larangan RT.08/06 Kab. Brebes ";
		} else if(distributor.value=="CV. MITRA TANI JAYA"){
			document.getElementById("alamat").innerHTML="JL. Soekarno Hatta Desa Bangbayang Kab. Brebes";
		} else if(distributor.value=="CV. PRAKOSO TANI"){
			document.getElementById("alamat").innerHTML="Jl. KH. Munadi No. 56 Jatibarang Ki Kab. Brebes ";
		} else if(distributor.value=="CV. SARTIKA TANI"){
			document.getElementById("alamat").innerHTML="Jl. Raya Gumayun No. 1 Kec. Dukuhwa Kab. Tegal ";
		} else if(distributor.value=="CV. SUMBER HASIL"){
			document.getElementById("alamat").innerHTML="Jl. Stasiun - Cigedog, Kersana, Brebes Kab. Brebes";
		} else{
			console.log("Pilih Distributor");
		}
}
</script>
<?php include "footer.php" ?>
