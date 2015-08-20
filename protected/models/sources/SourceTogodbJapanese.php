<?php

/**
 * This is the model class for table "tbl_source_togodb_japanese".
 *
 * The followings are the available columns in table 'tbl_source_togodb_japanese':
 * @property string $scientific_name
 * @property string $japanese_name
 * @property string $information_source_distributor
 * @property string $information_source_name
 * @property string $information_source_edition
 * @property string $ID
 */
class SourceTogodbJapanese extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceTogodbJapanese the static model class
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
		return 'tbl_source_togodb_japanese';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('scientific_name, japanese_name', 'required'),
			array('scientific_name, japanese_name', 'length', 'max'=>150),
			array('information_source_distributor, information_source_name, information_source_edition', 'length', 'max'=>255),
			array('ID', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('scientific_name, japanese_name, information_source_distributor, information_source_name, information_source_edition, ID', 'safe', 'on'=>'search'),
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
			'scientific_name' => 'Scientific Name',
			'japanese_name' => 'Japanese Name',
			'information_source_distributor' => 'Information Source Distributor',
			'information_source_name' => 'Information Source Name',
			'information_source_edition' => 'Information Source Edition',
			'ID' => 'ID',
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

		$criteria->compare('scientific_name',$this->scientific_name,true);
		$criteria->compare('japanese_name',$this->japanese_name,true);
		$criteria->compare('information_source_distributor',$this->information_source_distributor,true);
		$criteria->compare('information_source_name',$this->information_source_name,true);
		$criteria->compare('information_source_edition',$this->information_source_edition,true);
		$criteria->compare('ID',$this->ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}