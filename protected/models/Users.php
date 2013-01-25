<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $auth_id
 * @property string $given_name
 * @property string $family_name
 * @property string $gender
 * @property string $locale
 * @property string $service_name
 * @property integer $last_seen
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('auth_id, given_name, family_name, gender, locale, service_name, last_seen', 'required'),
			array('auth_id, last_seen', 'numerical', 'integerOnly'=>true),
			array('given_name, family_name, service_name', 'length', 'max'=>128),
			array('gender, locale', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, auth_id, given_name, family_name, gender, locale, service_name, last_seen', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'auth_id' => 'Auth',
			'given_name' => 'Given Name',
			'family_name' => 'Family Name',
			'gender' => 'Gender',
			'locale' => 'Locale',
			'service_name' => 'Service Name',
			'last_seen' => 'Last Seen',
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
		$criteria->compare('auth_id',$this->auth_id);
		$criteria->compare('given_name',$this->given_name,true);
		$criteria->compare('family_name',$this->family_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('locale',$this->locale,true);
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('last_seen',$this->last_seen);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}