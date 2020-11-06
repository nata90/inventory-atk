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
	$(document).on("click", "#submit-mutasi", function () {
		var url = $(this).attr('url');

		$.ajax({
			type: 'post',
			url: url,
			dataType: 'json',
			'beforeSend':function(json)
			{ 
				SimpleLoading.start('gears'); 
			},
			data: $('#form-mutasi').serialize(),
			success: function(v){
				SimpleLoading.stop();
				if(v.error == 1){
					$('#modal').modal('show').find('#modalContent').html(v.msg);
				}else{
					$('#atkheaderdistribusi-no_distribusi').val(v.notrans);
					$('#table-data').html(v.table);
					$('#atkdetaildistribusi-nama_barang').val('');
					$('#atkdetaildistribusi-kode_barang').val('');
					$('#atkdetaildistribusi-satuan').val('');
					$('#atkdetaildistribusi-jumlah_distribusi').val('');
					$('#atkdetaildistribusi-nama_barang').focus();
				}
			},
		});
	});

	$(document).on("click", "#del-item-mut", function () {
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
	<div class="col-md-8">
		<?php $form = ActiveForm::begin([
			'options'=>['id'=>'form-mutasi'],
			'enableClientValidation'=>false
		]); ?>
			<div class="box box-success box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Mutasi</h3>
				</div>
				<div class="box-body">
			        <div class="row" style="padding-bottom: 10px;">
			        	<div class="col-lg-2">
							<div class="input-group">
								<?= $form->field($model, 'no_distribusi')->textInput(['maxlength' => true, 'readonly' => 'true']) ?>
							</div>
						</div>
			        	<div class="col-lg-3">
							<div class="input-group">
								<?= $form->field($model, 'tgl_distribusi')->widget(\yii\jui\DatePicker::class, [
								    //'language' => 'ru',
								    //'dateFormat' => 'yyyy-MM-dd',
								    'options'=>['class'=>'form-control'],
								]) ?>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="input-group">
								<?= $form->field($model, 'lokasi_asal')->dropDownList(
					                $listLokasi,
					                ['prompt'=>'Pilih Salah Satu']
					            ) ?>
							</div>
						</div>	
						
						<div class="col-lg-3">
							<div class="input-group">
								<?= $form->field($model, 'lokasi_distribusi')->dropDownList(
					                $listLokasi,
					                ['prompt'=>'Pilih Salah Satu']
					            ) ?>
							</div>
						</div>
							
			 
			        </div>
			        <div class="row">
			        	<div class="col-lg-3">
							<div class="input-group">
								<?= $form->field($model, 'no_referensi')->textInput(['maxlength' => true]) ?>
							</div>
						</div>
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
					<h3 class="box-title"> Detail Mutasi</h3>
				</div>
				
					<div class="box-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group">
									<?= $form->field($modelDetail, 'nama_barang')->widget(\yii\jui\AutoComplete::class, [
									    'options'=>['class'=>'form-control'],
									    'clientOptions' => [
									        'source' => $data,
									        'minLength'=>'2', 
											'autoFill'=>true,
											'select' => new JsExpression("function( event, ui ) {
										        $('#atkdetaildistribusi-kode_barang').val(ui.item.id);
										        $('#atkdetaildistribusi-satuan').val(ui.item.sat);
										        $('#atkdetaildistribusi-jumlah_distribusi').val(1);
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
									<?= $form->field($modelDetail, 'jumlah_distribusi')->textInput(['maxlength' => true]) ?>
								</div>
							</div>
				        </div>
				       
				       

					</div>
					<div class="box-footer">
						<button url="<?php echo Url::to(['pembelian/prosesmutasi']);?>" id="submit-mutasi" type="button" class="btn btn-primary pull-right">TAMBAH</button>
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
								<th>Satuan</th>
								<th>Opsi</th>
							</tr>
							<?php if(!$model->isNewRecord){
								$no = 1;
								if($model->detail != null){
										foreach($model->detail as $val){
									?>
											<tr>
												<td><?php echo $no;?></td>
												<td><?php echo $val->kode_barang;?></td>
												<td><?php echo $val->barang->nama_barang;?></td>
												<td><?php echo $val->jumlah_distribusi;?></td>
												<td><?php echo $val->barang->satuan;?></td>
												<td><a href="javascript:void(0)" class="product-title" id="del-item-mut" rel="<?php echo $val->id_detail_distribusi;?>" url="<?php echo Url::to(['pembelian/deleteitemmutasi']);?>"><span class="label label-danger">DELETE</span></a></td>
											</tr>
						
									<?php 
										$no++;
										} ?>
									
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
