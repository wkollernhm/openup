<?php

/**
 * This is the model class for table "tbl_common_names_cache".
 *
 * The followings are the available columns in table 'tbl_common_names_cache':
 * @property integer $id
 * @property string $name_id
 * @property string $name
 * @property string $language
 * @property string $geography
 * @property string $period
 * @property string $reference
 * @property integer $scientific_name_id
 *
 * The followings are the available model relations:
 * @property ScientificName $scientificName
 */
class CommonNamesCache extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CommonNamesCache the static model class
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
		return 'tbl_common_names_cache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, scientific_name_id', 'required'),
			array('id, scientific_name_id', 'numerical', 'integerOnly'=>true),
			array('name_id', 'length', 'max'=>20),
			array('language', 'length', 'max'=>15),
			array('geography, period', 'length', 'max'=>45),
			array('name, reference', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name_id, name, language, geography, period, reference, scientific_name_id', 'safe', 'on'=>'search'),
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
			'scientificName' => array(self::BELONGS_TO, 'ScientificName', 'scientific_name_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name_id' => 'Name',
			'name' => 'Name',
			'language' => 'Language',
			'geography' => 'Geography',
			'period' => 'Period',
			'reference' => 'Reference',
			'scientific_name_id' => 'Scientific Name',
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
		$criteria->compare('name_id',$this->name_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('geography',$this->geography,true);
		$criteria->compare('period',$this->period,true);
		$criteria->compare('reference',$this->reference,true);
		$criteria->compare('scientific_name_id',$this->scientific_name_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}