<?php 
	use app\components\Utility;
	use yii\helpers\Url;
?>
<table class="table table-striped">
	<tbody>
		<tr>
			<th>No</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Total</th>
			<th>Opsi</th>
		</tr>
		<?php if($model != null){
				$no = 1;
				$allTotal = 0;
				foreach($model->detail as $val){
					$total = $val->jumlah*$val->harga;
					$allTotal = $allTotal + $total;
		?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $val->kode_barang;?></td>
						<td><?php echo $val->barang->nama_barang;?></td>
						<td><?php echo round($val->jumlah,0);?></td>
						<td><?php echo Utility::rupiah($val->harga);?></td>
						<td><?php echo Utility::rupiah($total);?></td>
						<td><a href="javascript:void(0)" class="product-title" id="del-item" rel="<?php echo $val->id;?>" url="<?php echo Url::to(['pembelian/deleteitem']);?>"><span class="label label-danger">DELETE</span></a></td>
					</tr>
	<?php 
			$no++;
			} ?>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><strong>TOTAL</strong></td>
						<td><strong><?php echo Utility::rupiah($allTotal);?></strong></td>
						<td></td>
					</tr>
	<?php } ?>
	</tbody>
</table>