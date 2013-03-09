<?php

/**
 * This is the model class for table "links".
 *
 * The followings are the available columns in table 'links':
 * @property integer $sb_id
 * @property string $sb_link
 * @property string $sb_title
 * @property integer $sb_catid
 *
 * The followings are the available model relations:
 * @property Categories $categories
 */
class Links extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Links the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sb_link, sb_title, sb_catid', 'required'),
			array('sb_catid', 'numerical', 'integerOnly'=>true),
			array('sb_link, sb_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sb_id, sb_link, sb_title, sb_catid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'category' => array(self::BELONGS_TO, 'Categories', 'sb_catid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sb_id' => 'Id',
			'sb_link' => 'Feed URL',
			'sb_title' => 'Title',
			'sb_catid' => 'Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array("category");
		$criteria->compare('t.sb_id',$this->sb_id);
		$criteria->compare('sb_link',$this->sb_link,true);
		$criteria->compare('sb_title',$this->sb_title,true);
		$criteria->compare('sb_catid',$this->sb_catid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}