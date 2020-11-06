<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\Url;
use app\components\Utility;

$this->title = '';
$this->registerJs(<<<JS
	$(document).on("keyup", "#atkdetailpembelian-jumlah", function () {
		var jum = $(this).val();
		var harga = $('#atkdetailpembelian-harga').val();

		var total = parseInt(jum) * parseInt(harga);
		$('#atkdetailpembelian-total').val(total);
	});

	$(document).on("keyup", "#atkdetailpembelian-harga", function () {
		var harga = $(this).val();
		var jum = $('#atkdetailpembelian-jumlah').val();

		var total = parseInt(jum) * parseInt(harga);
		$('#atkdetailpembelian-total').val(total);
	});

	$(document).on("click", "#submit-pembelian", function () {
		var url = $(this).attr('url');


		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
			'beforeSend':function(json)
			{ 
				SimpleLoading.start('gears'); 
			},
			data: $('#form-pembelian').serialize(),
			success: function(v){
				SimpleLoading.stop();
				if(v.error == 1){
					$('#modal').modal('show').find('#modalContent').html(v.msg);
				}else{
					$('#atkheaderpembelian-no_pembelian').val(v.notrans);
					$('#table-data').html(v.table);
					$('#atkdetailpembelian-nama_barang').val('');
					$('#atkdetailpembelian-kode_barang').val('');
					$('#atkdetailpembelian-satuan').val('');
					$('#atkdetailpembelian-jumlah').val('');
					$('#atkdetailpembelian-harga').val('');
					$('#atkdetailpembelian-total').val('');
					$('#atkdetailpembelian-nama_barang').focus();
				}
			},
			/*'complete':function(json)
			{
				SimpleLoading.stop();
			},*/
		});
	});
	

	$(document).on("click", "#del-item", function () {
		var id = $(this).attr('rel');
		var url = $(this).attr('url');

		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
			data: {'id':id},
			success: function(v){
				if(v.success == 1){
					$('#table-data').html(v.table);
				}else{
					$('#modal').modal('show').find('#modalContent').html("GAGAL HAPUS !!!");
				}
			},
		});
	});
	
JS
);
/* @var $this yii\web\View */
/* @var $model app\models\FileBarangAtk */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
	<div class="col-md-12">
		<?php $form = ActiveForm::begin([
			'options'=>['id'=>'form-pembelian'],
			'enableClientValidation'=>false
		]); ?>
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pembelian</h3>
				</div>
					<div class="box-body">
				        <div class="row" style="padding-bottom: 10px;">
				        	<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($model, 'no_pembelian')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
								</div>
							</div>
				        	<div class="col-lg-3">
								<div class="input-group">
									<?= $form->field($model, 'kode_termin')->dropDownList(
						                $listTermin,
						                ['prompt'=>'Pilih Salah Satu']
						            ) ?>
								</div>
							</div>
							<div class="col-lg-4" style="display:none;">
								<div class="input-group">
									<?= $form->field($model, 'kode_lokasi')->dropDownList(
						                $listData,
						                ['prompt'=>'Pilih Salah Satu']
						            ) ?>
								</div>
							</div>	
							
							<div class="col-lg-3">
								<div class="input-group">
									<?= $form->field($model, 'no_referensi')->textInput(['maxlength' => true]) ?>
								</div>
							</div>	
				        </div>
				        <div class="row" style="padding-bottom: 10px;">
				        	<div class="col-lg-3">
								<div class="input-group">
									<?= $form->field($model, 'kode_supplier')->dropDownList(
						                $listSupplier,
						                ['prompt'=>'Pilih Salah Satu']
						            ) ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									
									<?= $form->field($model, 'tanggal_pembelian')->widget(\yii\jui\DatePicker::class, [
									    //'language' => 'ru',
									    //'dateFormat' => 'yyyy-MM-dd',
									    'options'=>['class'=>'form-control'],
									]) ?>
								</div>
							</div>
				 			<div class="col-lg-4">
								<div class="input-group">
									<?= $form->field($model, 'tanggal_jatuh_tempo')->widget(\yii\jui\DatePicker::class, [
									    //'language' => 'ru',
									    //'dateFormat' => 'yyyy-MM-dd',
									    'options'=>['class'=>'form-control']
									]) ?>
								</div>
							</div>	
				        </div>
				        <div class="row">	
							<div class="col-lg-4">
								<div class="input-group">
									
									<?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
				 			
				        </div>
					</div>
			</div>
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Detail</h3>
				</div>
				
					<div class="box-body">
						<div class="row" style="padding-bottom: 10px;">
							<div class="col-lg-4">
								<div class="input-group">
									<?= $form->field($modelDetail, 'nama_barang')->widget(\yii\jui\AutoComplete::class, [
									    'options'=>['class'=>'form-control'],
									    'clientOptions' => [
									        'source' => $data,
									        'minLength'=>'2', 
											'autoFill'=>true,
											'select' => new JsExpression("function( event, ui ) {
										        $('#atkdetailpembelian-kode_barang').val(ui.item.id);
										        $('#atkdetailpembelian-satuan').val(ui.item.sat);
										        $('#atkdetailpembelian-harga').val(ui.item.harga);
										        $('#atkdetailpembelian-jumlah').val(1);
										        $('#atkdetailpembelian-total').val(0);
										        //$('#atkdetailpembelian-discount').val(0);
										     }")
									    ],
									]) ?>
									
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($modelDetail, 'kode_barang')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($modelDetail, 'satuan')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($modelDetail, 'jumlah')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
				        </div>
				       <div class="row" style="padding-bottom: 10px;">
							
							
							<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($modelDetail, 'harga')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
							<div class="col-lg-2">
								<div class="input-group">
									<?= $form->field($modelDetail, 'total')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
				        </div>
				       

					</div>
					<div class="box-footer">
						<button url="<?php echo Url::to(['pembelian/prosestransaksi']);?>" id="submit-pembelian" type="button" class="btn btn-primary pull-right">TAMBAH</button>
					</div>
				
			</div>
			<div class="box box-success box-solid">
				<div class="box-header">
					<h3 class="box-title"></h3>
				</div>	
				<div id="table-data" class="box-body no-padding">

					<table class="table table-striped">
						<tbody>
							<tr>
								<th>No</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Total</th>
							</tr>
							<?php if(!$model->isNewRecord){
								if($model->detail != null){
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
							<?php	}
							}else{ ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>
