<?php

/**
 * This is the model class for table "scripts".
 *
 * The followings are the available columns in table 'scripts':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $language
 * @property string $tags
 * @property string $path
 * @property string $usage
 * @property integer $accuirance
 * @property integer $tabSize
 * @property string $isAlertNeeded
 * @property string $alertEmail
 * @property string $isPublic
 * @property string $isDeleted
 * @property string $isFinished
 * @property string $isCopyable
 * @property integer $isLineNumberVisible
 * @property integer $rateScore
 * @property integer $rateCount
 * @property integer $rateTotal
 * @property string $scriptSource
 * @property integer $lastUpdate
 * @property integer $createdAt
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Script extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Script the static model class
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
		return 'scripts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, title, isAlertNeeded, isPublic, isDeleted, isFinished, isCopyable, isLineNumberVisible, scriptSource, lastUpdate, createdAt', 'required'),
			array('user_id, accuirance, tabSize, isAlertNeeded, isPublic, isDeleted, isFinished, isCopyable, isLineNumberVisible, rateScore, rateCount, rateTotal, lastUpdate, createdAt', 'numerical', 'integerOnly'=>true),
			array('title, tags, path, usage', 'length', 'max'=>258),
            array('language', 'length', 'max'=>10),
			array('isAlertNeeded, isPublic, isDeleted, isFinished, isCopyable, isLineNumberVisible', 'length', 'max'=>1),
			array('alertEmail', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, description, language, tags, path, usage, tabSize, accuirance, isAlertNeeded, alertEmail, isPublic, isDeleted, isFinished, isCopyable, isLineNumberVisible, rateScore, rateCount, rateTotal, scriptSource, lastUpdate, createdAt', 'safe', 'on'=>'search'),
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
            'rates' => array(self::HAS_MANY, 'Rates', 'script_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'title' => 'Title',
			'description' => 'Description',
            'language' => 'Language',
			'tags' => 'Tags',
			'path' => 'Path',
			'usage' => 'Usage',
			'accuirance' => 'Accuirance',
            'tabSize' => 'Tab Size',
			'isAlertNeeded' => 'Is Alert Needed',
			'alertEmail' => 'Alert Email',
			'isPublic' => 'Is Public',
			'isDeleted' => 'Is Deleted',
			'isFinished' => 'Is Finished',
			'isCopyable' => 'Is Copyable',
            'isLineNumberVisible' => 'Is Line Number Visible',
            'rateScore' => 'Rate Score',
            'rateCount' => 'Rate Count',
            'rateTotal' => 'Rate Total',
			'scriptSource' => 'Script Source',
			'lastUpdate' => 'Last Update',
			'createdAt' => 'Created At',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
        $criteria->compare('language',$this->language,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('usage',$this->usage,true);
		$criteria->compare('accuirance',$this->accuirance);
        $criteria->compare('tabSize',$this->tabSize);
		$criteria->compare('isAlertNeeded',$this->isAlertNeeded,true);
		$criteria->compare('alertEmail',$this->alertEmail,true);
		$criteria->compare('isPublic',$this->isPublic,true);
		$criteria->compare('isDeleted',$this->isDeleted,true);
		$criteria->compare('isFinished',$this->isFinished,true);
		$criteria->compare('isCopyable',$this->isCopyable,true);
        $criteria->compare('isLineNumberVisible',$this->isLineNumberVisible);
        $criteria->compare('rateScore',$this->rateScore);
        $criteria->compare('rateCount',$this->rateCount);
        $criteria->compare('rateTotal',$this->rateTotal);
		$criteria->compare('scriptSource',$this->scriptSource,true);
		$criteria->compare('lastUpdate',$this->lastUpdate);
		$criteria->compare('createdAt',$this->createdAt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}