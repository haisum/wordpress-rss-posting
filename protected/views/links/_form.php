<?php
/* @var $this LinksController */
/* @var $model Links */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'links-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sb_link'); ?>
		<?php echo $form->textField($model,'sb_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sb_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sb_title'); ?>
		<?php echo $form->textField($model,'sb_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'sb_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sb_catid'); ?>
		<?php echo $form->dropDownList($model, 'sb_catid', CHtml::listData(Categories::model()->findAll(), "sb_id", "sb_catname")); ?>
		<?php echo $form->error($model,'sb_catid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->