<?php

/**
 * This is the model class for table "tbl_source_eti_databases".
 *
 * The followings are the available columns in table 'tbl_source_eti_databases':
 * @property string $Name
 * @property string $iso_639_6
 * @property string $Taxon
 * @property string $Source
 */
class SourceEtiDatabases extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SourceEtiDatabases the static model class
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
		return 'tbl_source_eti_databases';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, iso_639_6, Taxon, Source', 'required'),
			array('Name, Taxon', 'length', 'max'=>150),
			array('iso_639_6', 'length', 'max'=>6),
			array('Source', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Name, iso_639_6, Taxon, Source', 'safe', 'on'=>'search'),
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
			'Name' => 'Name',
			'iso_639_6' => 'Iso 639 6',
			'Taxon' => 'Taxon',
			'Source' => 'Source',
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

		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('iso_639_6',$this->iso_639_6,true);
		$criteria->compare('Taxon',$this->Taxon,true);
		$criteria->compare('Source',$this->Source,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}