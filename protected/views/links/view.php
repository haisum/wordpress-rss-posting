<?php
/* @var $this LinksController */
/* @var $model Links */

$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->sb_id,
);

$this->menu=array(
	array('label'=>'List Links', 'url'=>array('index')),
	array('label'=>'Create Links', 'url'=>array('create')),
	array('label'=>'Update Links', 'url'=>array('update', 'id'=>$model->sb_id)),
	array('label'=>'Delete Links', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sb_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Links', 'url'=>array('admin')),
);
?>

<h1>View Links #<?php echo $model->sb_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sb_id',
		'sb_link',
		'sb_title',
		'category.sb_catname',
	),
)); ?>
