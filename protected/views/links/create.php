<?php
/* @var $this LinksController */
/* @var $model Links */

$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Links', 'url'=>array('index')),
	array('label'=>'Manage Links', 'url'=>array('admin')),
);
?>

<h1>Create Links</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>