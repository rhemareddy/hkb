<?php 
$this->breadcrumbs=array(
		'Customers'
);
?>
<div class="row noMargin">
	<div class="col-md-12">
		<?php  $this->renderPartial('_search',array('model'=>$model)); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-1">
			<div class="form-group">
				<?php echo CHtml::link(Yii::t('translation','Add').' <i class="fa fa-plus"></i>', '/admin/'.  get_class($model) .'/create/type/active', array("class"=>"btn  green margin-right-20")); ?>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$dataProvider,
	'enableSorting'=>'true',
	'ajaxUpdate'=>true,
	'summaryText'=>'Showing {start} to {end} of {count} entries',
	'template'=>'{items} {summary} {pager}',
	'itemsCssClass'=>'table table-striped table-bordered table-hover table-full-width',
	'pager'=>array(
		'header'=>false,
		'firstPageLabel' => "<<",
		'prevPageLabel' => "<",
		'nextPageLabel' => ">",
		'lastPageLabel' => ">>",
	),	
	'columns'=>array(
		//'idJob',
		array(
			'name'=>'first_name',
			'header'=>'<span style="white-space: nowrap;">Name &nbsp; &nbsp; &nbsp;</span>',
			'value'=>'$data->first_name',
		),
                array(
			'name'=>Yii::t('translation', 'Status'),
			'value'=>'($data->status == 1) ? Yii::t(\'translation\', \'Active\') : Yii::t(\'translation\', \'Inactive\')',
		),
		array(
			'name' =>'telephone' , 
			'value'=>array($this,'gridDataColumn'),
		),
		'email_address',
		array(
			'name'=>'updated_at',
			//'value'=>'date("d/m/Y H:i", $data->updated_at)',
		),
		array( 
			'class'=>'CButtonColumn',
			'template'=>'{Edit}{Delete}',
			'htmlOptions'=>array('width'=>'23%'),
			'buttons'=>array(
				'Edit' => array(
					'label'=>'Edit',
					'options'=>array('class'=>'btn purple fa fa-edit margin-right15'),
					'url'=>'Yii::app()->createUrl("admin/customer/update/type/active", array("id"=>$data->id))',
				),
				'Delete' => array(
					'label'=>Yii::t('translation', 'Change Status'),
					'options'=>array('class'=>'fa fa-success btn default black delete'),
					'url'=>'Yii::app()->createUrl("admin/customer/status", array("id"=>$data->id))',
				),
			),
		),
	),
)); ?>
			</div>
			</div>