<?php
/* @var $this LinksController */
/* @var $data Links */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sb_id), array('view', 'id'=>$data->sb_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_link')); ?>:</b>
	<?php echo CHtml::encode($data->sb_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_title')); ?>:</b>
	<?php echo CHtml::encode($data->sb_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sb_catid')); ?>:</b>
	<?php echo CHtml::encode($data->category->sb_catname); ?>
	<br />


</div>