<?php include "header.php" ?>
	<div id="page-wrapper">
	    <div class="row">
	        <div class="col-lg-12">
	            <h1 class="page-header">Laporan Penerimaan</h1>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
	    <button onclick="printDiv('printlaporan')" class="btn btn-info">print</button>
	    <div class="row">
	    	
	    	<div class="col-sm-8" id="printlaporan">
	    		<table class="table table-hover">
	    			<thead>
	    				<th>No</th>
	    				<th>Distributor</th>
	    				<th>NOSO</th>
	    				<th>Tanggal Order</th>
	    				<th>Tanggal Pengiriman</th>
	    				<th>Tonage</th>
	    				<th>Sisa</th>
	    			</thead>
	    			<tbody>
	    				<?php 
	    				$sql="SELECT * FROM `distributor`,penerimaan, gudang where distributor.id_distributor=penerimaan.id_distributor and penerimaan.id_distributor=gudang.id_distributor";
	    				$do=$dbh->query($sql); //menjalankan sql
	    				$no=1;
	    				foreach ($do as $v) { 
	    					echo "
	    						<tr>
					    			<td>$no</td>
					    			<td>$v[nama_distributor]</td>
					    			<td>$v[no_so]</td>
					    			<td>$v[tgl_order]</td>
					    			<td>$v[tgl_pengiriman]</td>
					    			<td>$v[stok]</td>
					    			<td>$v[jmlparty]</td>
					    		</tr>
	    					";
	    					$no++;
	    				}
	    				 ?>
	    			</tbody>

	    		</table>
	    	</div>
	    </div>
	</div>
	<script type="text/javascript">
		function printDiv(divName){
		    var printContents = document.getElementById(divName).innerHTML;
		       var originalContents = document.body.innerHTML;

		       document.body.innerHTML = printContents;

		       window.print();

		       document.body.innerHTML = originalContents;
		  }
	</script>
<?php include "footer.php" ?>