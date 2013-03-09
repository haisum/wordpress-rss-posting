<?php
/* @var $this LinksController */
/* @var $model Links */

$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->sb_id=>array('view','id'=>$model->sb_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Links', 'url'=>array('index')),
	array('label'=>'Create Links', 'url'=>array('create')),
	array('label'=>'View Links', 'url'=>array('view', 'id'=>$model->sb_id)),
	array('label'=>'Manage Links', 'url'=>array('admin')),
);
?>

<h1>Update Links <?php echo $model->sb_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>