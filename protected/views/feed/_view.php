<div style="float:left;width:550px;overflow:hidden;">
	<a href="<?php echo $data["link"]; ?>" target="_blank"><?php echo $data["title"]; ?></a>
</div>
<div style="float:right;">
	<a href="javascript:;" onclick="$(this).parent().next().slideToggle();">Edit</a>
</div>
<div class="edit" style="display:none;clear:both;float:left;">
	<div style="float:left;">
		<?php echo $data["desc"];?>
	</div>
	<form id="form_<?php echo $index; ?>" action="javascript:;" onsubmit="submitForm(<?php echo $index; ?>)" method="post">
		<div style="float:left;width:550px;">
			<input name="title" type="text" style="width:500px;" placeholder="title"/><br/>
			<input name="tags" type="text" style="width:500px;" placeholder="tags"/><br/>
			<textarea name="description" style="width:500px;height:300px;"><?php echo $data["desc"];?></textarea>
		</div>
		<div style="float:right;">
			<?php echo CHtml::dropDownList("category", "", $this->getWpCategories(), array(
				"multiple" => "multiple",
				"style" => "height:320px;margin-bottom:10px;"
			)); ?>
		</div>
		<div>
			<br/>
			<br/>
			<input type="submit" value="Submit"/>
		</div>
	</form>
</div>
<hr style="clear:both;"/>