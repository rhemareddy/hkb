<?php
/* @var $this GatewayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gateways',
);

$this->menu=array(
	array('label'=>'Create Gateway', 'url'=>array('create')),
	array('label'=>'Manage Gateway', 'url'=>array('admin')),
);
?>

<h1>Gateways</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
