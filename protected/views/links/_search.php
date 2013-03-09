<?php
/* @var $this LinksController */
/* @var $model Links */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sb_id'); ?>
		<?php echo $form->textField($model,'sb_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_link'); ?>
		<?php echo $form->textField($model,'sb_link',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_title'); ?>
		<?php echo $form->textField($model,'sb_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sb_catid'); ?>
		<?php echo $form->dropDownList($model, 'sb_catid', CHtml::listData(Categories::model()->findAll(), "sb_id", "sb_catname")); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->