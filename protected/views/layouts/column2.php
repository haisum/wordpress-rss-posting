<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		if(isset($this->menu) && count($this->menu) > 0){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Feeds',
		));
		$data = array();
		$cats = Categories::model()->findAll();
		foreach($cats as $cat){
			$children = array();
			foreach($cat->links as $link){
				$children[] = array(
					"text" => (($link->sb_id == $_GET["id"]) ? "<strong>" . "<a href='" . Yii::app()->createUrl("feed/index", array("id" => $link->sb_id)) . "'>" . $link->sb_title . "</a>" . "</strong>"  : "<a href='" . Yii::app()->createUrl("feed/index", array("id" => $link->sb_id)) . "'>" . $link->sb_title . "</a>"),
					"expanded" =>true,
					"id" => $link->sb_id,
					"hasChildren" =>false
				);
			}
			$data[] = array(
				"text" => $cat->sb_catname,
				"id" => $cat->sb_id,
				"hasChildren" => true,
				"children" => $children
			);
		}
		$this->widget('CTreeView', array(
			'data'=> $data
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>