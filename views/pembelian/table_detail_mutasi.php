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
			<th>Opsi</th>
		</tr>
		<?php if($model != null){
				$no = 1;
				foreach($model->detail as $val){
		?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $val->kode_barang;?></td>
						<td><?php echo $val->barang->nama_barang;?></td>
						<td><?php echo round($val->jumlah_distribusi,0);?></td>
						<td><a href="javascript:void(0)" class="product-title" id="del-item-mut" rel="<?php echo $val->id_detail_distribusi;?>" url="<?php echo Url::to(['pembelian/deleteitemmutasi']);?>"><span class="label label-danger">DELETE</span></a></td>
					</tr>
	<?php 
			$no++;
			} ?>
	<?php } ?>
	</tbody>
</table>