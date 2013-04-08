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
					if(!isNaN(data)){
						$this.parent().slideUp();
						$("#title_" + id).css("textDecoration", "line-through");
					}
				},3000);
				$this.find("input[type=submit]").prop("disabled", false);
			}
		})
	}
	function submitAll(){
		if($("#submitAll>option:selected").length == 0){
			$("#submitAllMessage").html("No category selected");
		}
		else{
			$("#submitAllMessage").html("Submitting, successfully submitted feeds\' title will be strike throughed");
			var newCats = $("#submitAll").val();
			$(".feedCheck:checked").each(function(){
				var id = $(this).val();
				$("#cat_"+id).val(newCats);
				submitForm(id);
			});
		}
	}
', CClientScript::POS_HEAD);
?>
<h1>Showing feeds for <?php echo $link->sb_title; ?></h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
<h1 style="clear:both;">Submit All</h1>
<div style="float:left;">
	<?php echo CHtml::dropDownList("category", "", $this->getWpCategories(), array(
		"multiple" => "multiple",
		"style" => "height:320px;margin-bottom:10px;width:150px;",
		"id" => "submitAll"
	)); ?>
</div>
<div style="float:left;margin-left:20px;">
	<button onclick="submitAll();">Submit</button>
	<span id="submitAllMessage"></span>
</div>