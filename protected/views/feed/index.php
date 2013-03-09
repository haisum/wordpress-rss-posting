<?php
/** @var $this FeedController 
	@var $link Links
*/
$this->breadcrumbs=array(
	$link->category->sb_catname,
	$link->sb_title
);
Yii::app()->clientScript->registerScript("formSubmit", '
	function submitForm(id){
		$this = $("#form_" + id);
		dataObj = {
			title : $this.find("[name=title]").val(),
			tags : $this.find("[name=tags]").val(),
			description : $this.find("[name=description]").val(),
			categories :  $this.find("[name=category]").val(),
		};
		$this.find("input[type=submit]").prop("disabled", true);
		$.ajax({
			url : "' . Yii::app()->createUrl("/feed/submit") . '",
			data : dataObj,
			type : "post",
			success: function(data){
				if(!isNaN(data)){
					$this.find("input[type=submit]").after("<span class=\'message\'>Success</span>");
				}
				else{
					$this.find("input[type=submit]").after("<span class=\'message\'>" + data + "</span>");
					console.log(data);
				}
				window.setTimeout(function(){
					$(".message").remove();
				},3000);
				$this.find("input[type=submit]").prop("disabled", false);
			}
		})
	}
', CClientScript::POS_HEAD);
?>
<h1>Showing feeds for <?php echo $link->sb_title; ?></h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
