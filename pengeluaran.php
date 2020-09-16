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
	            <h1 class="page-header">pengeluaran</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <div class="row">
	    	<div class="col-sm-4">
	    		<form method="post" action="tambahpengeluaran.php">
	    			<input type="hidden" name="user" value="<?php echo $_SESSION['id'] ?>">
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Delivery Order</span>
	    				<input class="form-control" type="text" name="no_do" >
	    			</div>

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
	    			<input type="text" name="no_so" placeholder="no_so" class="form-control"><br>
	    			
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Tanggal Pengiriman</span>
	    				<input class="form-control" type="date" name="tgl_pengiriman" placeholder="Tanggal Pengiriman" style="width: 80%;">
	    			</div>

	    			<input class="form-control" type="number" name="stok" placeholder="Stok"><br>
	    			<div class="form-group input-group">
	    				<span class="input-group-addon">Keterangan</span>
	    				<select class="form-control" name="keterangan">
	    					<option value="original">original</option>
	    					<option value="basah">basah</option>
	    					<option value="rusak">rusak</option>
	    					<option value="sweeping">sweeping</option>
	    				</select>
	    			</div>
	    			
	    			<input class="form-control" type="text" name="no_truk" placeholder="No Truk"><br>
	    			<input class="form-control" type="text" name="nama_sopir" placeholder="Nama Sopir"><br>
	    			<input type="submit" name="proses" value="tambah" class="btn btn-info" onclick="javascript:return confirm('Anda Yakin?')" >
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
	    				<th>No Delivery Order</th>
	    				<th>Distributor</th>
	    				<th>user</th>
	    				<th>Tanggal Pengiriman</th>
	    				<th>Stok</th>
	    				<th>keterangan</th>
	    				<th>No Truk</th>
	    				<th>Nama Sopir</th>
	    				<th>Aksi</th>
	    			</thead>
	    			<tbody>
	    				<?php 
	    				$sql="SELECT * FROM `distributor`,pengeluaran, user where distributor.id_distributor=pengeluaran.id_distributor and pengeluaran.id_user=user.id_user";
	    				$do=$dbh->query($sql); //menjalankan sql
	    				$no=1;
	    				$jml=0;
	    				foreach ($do as $v) { 
	    					echo "
	    						<tr>
					    			<td>$no</td>
					    			<td>$v[no_do]</td>
					    			<td>$v[nama_distributor]</td>
					    			<td>$v[nama]</td>
					    			<td>$v[tgl_pengiriman]</td>
					    			<td>$v[stok]</td>
					    			<td>$v[keterangan]</td>
					    			<td>$v[no_truk]</td>
					    			<td>$v[nama_sopir]</td>
					    			<td><a href='tambahpengeluaran.php?id=$v[id_pengeluaran]&no=$v[no_so]&dis=$v[id_distributor]&stok=$v[stok] '";?> onclick="javascript:return confirm('Anda Yakin?')" <?php echo " class='btn btn-danger' name='proses'>Hapus</a> </td>
					    		</tr>
	    					";
	    					$no++;
	    					$jml +=$v['stok']; //perhitungan stok
	    				}
	    				?>
	    			</tbody>
	    			<tr>
	    				<td>Jumlah</td>
	    				<td><?php echo $jml; ?></td>
	    			</tr>
	    		</table>
	    </div>
	</div>

<?php include "footer.php" ?>