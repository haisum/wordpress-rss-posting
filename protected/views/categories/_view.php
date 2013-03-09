<?php
/* @var $this CategoriesController */
/* @var $data Categories */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sb_id), array('view', 'id'=>$data->sb_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_catname')); ?>:</b>
	<?php echo CHtml::encode($data->sb_catname); ?>
	<br />


</div>