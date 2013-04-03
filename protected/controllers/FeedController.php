<?php

class FeedController extends Controller
{	
	public $layout='//layouts/column2';
	private $wpCats;
	public function actionIndex()
	{
		$link = null;
		$dbCriteria = new CDbCriteria(array(
			"with" => array("category")
		));
		if(!isset($_GET["id"])){
			$dbCriteria->limit = 1; 
			$link = Links::model()->findAll($dbCriteria);
		}
		else{
			$dbCriteria->condition = "t.sb_id = :sb_id";
			$dbCriteria->params = array(":sb_id" => intval($_GET["id"]));
			$link = Links::model()->findAll($dbCriteria);
		}
		if(count($link) == 0){
			throw new CHttpException("404", "Requested feed not found or no feeds available");
		}
		$feed = Yii::app()->cache->get("feed_" . $link[0]->sb_id);
		if($feed === false){
			$file= $link[0]->sb_link;
			$rssParser = new RSS_feed();
			$rssParser->Set_URL($file);
			$rssParser->Set_Limit(Yii::app()->params["feedLimit"]); // 0 = Default = All
			$rssParser->Show_Description(true); // Default = false
			$result = $rssParser->Get_Results();
			$feed = $result;
			Yii::app()->cache->set("feed_" . $link[0]->sb_id, $result, 60 * Yii::app()->params["feedCacheTime"]);
		}
		$dataProvider = new CArrayDataProvider($feed);
		$this->render('index', array(
			"link" => $link[0],
			"dataProvider" => $dataProvider
		));
	}
	public function getWpCategories(){
		if(!$wpCats){
			$taxonomy = TermTaxonomy::model()->findAll("taxonomy='category'");
			$ids = array();
			foreach($taxonomy as $item){
				$ids[] = $item->term_id;
			}
			if($ids){
				return ($wpCats = CHtml::listData(Terms::model()->findAll("term_id IN(" . implode(",",$ids) . ")"), "term_id", "name"));
			}
			else
				return ($wpCats = array());
		}
		else{
			return $wpCats;
		}
	}
	public function actionSubmit(){
		$post = new Posts;
		$data = $_POST;
		if($data["categories"] == "null"){
			echo "no category selected";
			exit;
		}
		if(trim($data["title"]) == ""){
			echo "no title";
			exit;
		}
		if(trim($data["description"]) == ""){
			echo "no description";
			exit;
		}
		$post->post_author = 1;
		$post->post_date = date("Y-m-d H:i:s");
		$post->post_date_gmt = $post->post_date;
		$post->post_content = $data["description"];
		$post->post_title = CHtml::encode($data["title"]);
		$post->post_status = "publish";
		$post->comment_status = "open";
		$post->ping_status = "open";
		$post->post_name= preg_replace('/[\s\W]+/','-', $data["title"]); 
		$post->post_name = preg_replace("/^\-/", "",$post->post_name); 
		$post->post_name = preg_replace("/\-$/", "",$post->post_name);
		$post->post_name = preg_replace("/\-+/", "-",$post->post_name);
		$post->post_title = $data["title"];
		$post->post_modified = $post->post_date;
		$post->post_modified_gmt= $post->post_date;
		$post->post_type = "post";
		$post->post_parent = $data["categories"][count($data["categories"])-1];
		$post->menu_order = 0;
		$success = $post->save(false);
		if($success){
			$post->guid = Yii::app()->params["blogUrl"] . "?p=" . $post->ID;
			$post->save(false);
			foreach($data["categories"] as $cat){
				$taxonomy = TermTaxonomy::model()->findAll("term_id=" . $cat . " and taxonomy='category'");
				$id = $taxonomy[0]->term_taxonomy_id;
				$postCat = new TermRelationships;
				$postCat->term_taxonomy_id = $id;
				$postCat->object_id = $post->ID;
				$taxonomy[0]->count = $taxonomy[0]->count+1;
				$taxonomy[0]->save(false);
				$postCat->save(false);
			}
			$tags = explode("," ,$data["tags"]);
			foreach($tags as $tag){
				$id = 0;
				$term = Terms::model()->findAll("name='" . $tag . "'");
				if(count($term) > 0){
					$term = $term[0];
					$taxonomy = TermTaxonomy::model()->findAll("term_id=" . $term->term_id . " and taxonomy='post_tag'");
					$taxonomy[0]->count = $taxonomy[0]->count+1;
					$taxonomy[0]->save(false);
					$id = $taxonomy[0]->term_taxonomy_id;
				}
				else{
					$term = new Terms;
					$term->name = $tag;
					$term->slug = preg_replace('/[\s\W]+/','-', $tag); 
					$term->slug = preg_replace("/^\-/", "",$term->slug); 
					$term->slug = preg_replace("/\-$/", "",$term->slug);
					$term->slug = preg_replace("/\-+/", "-",$term->slug);
					$term->term_group = 0;
					$term->save(false);
					$taxonomy = new TermTaxonomy;
					$taxonomy->term_id = $term->term_id;
					$taxonomy->taxonomy = "post_tag";
					$taxonomy->count = 1;
					$taxonomy->save(false);
					$id = $taxonomy->term_taxonomy_id;
				}
				$postTag = new TermRelationships;
				$postTag->term_taxonomy_id = $id;
				$postTag->object_id = $post->ID;
				$postTag->save(false);
			}
			echo $post->ID;
		}
		else{
			echo 0;
		}
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('submit','index'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + submit', // we only allow deletion via POST request
		);
	}
}